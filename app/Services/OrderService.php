<?php
namespace App\Services;
use App\Entities\Address;
use App\Entities\Order;
use App\Repositories\Criterias\UserCriteria;
use App\Repositories\OrderRepository;
use App\Repositories\SubscribeRepository;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-9-21
 * Time: 下午2:48
 */
class OrderService
{
    private $order;

    private $wechat;

    private $subscribe;

    public function __construct(OrderRepository $repository, SubscribeRepository $subscribeRepository, Application $application)
    {
        $this->order = $repository;

        $this->wechat = $application;

        $this->subscribe = $subscribeRepository;
    }

    public function createTree(array $items, Address $address){
        return $this->create($items, $address, Order::TREE, 'pending');
    }

    public function createGift(array $items, Address $address){
        return $this->create($items, $address, Order::GIFT, 'pending');
    }

    public function createCommon(array $items, Address $address){
        return $this->create($items, $address, Order::COMMON, 'unpaid');

    }
    
    public function createFruits(array $items, Address $address){
        return $this->create($items, $address, Order::FRUIT, 'pending');
    }
    public function create(array $items, Address $address, string $type, string $status){
        DB::beginTransaction();
        $user = request()->user();
        Log::info('order service:'.json_encode($user));
        try{
            $order = $this->order->create([
                'order_number' => $this->generateOrderId(),
                'user_id'      => $user->id,
                'total'        => $this->calcPrice($items),
                'address_id'   => $address->id,
                'status'       => $status,
                'type'         => $type
            ]);
            foreach ($items as $item){
                $product = $item['product'];
                $order->items()->create([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item['qty'],
                    'unit'          =>  $product->price,
                    'options'       =>  $product->setHidden(['content'])->toJson()
                ]);
            }

        }catch (Exception $e){
            Log::error('生成订单异常:'.$e->getFile());
            Log::error('生成订单异常:'.$e->getLine());
            Log::error('生成订单异常:'.$e->getMessage());

            DB::rollBack();
            return false;
        }

        DB::commit();

        return $order;
    }

    public function calcPrice($items){
        return array_reduce($items, function ($carry, $item){
            $product = $item['product'];
            return bcadd($carry, $product->price * $item['qty']);
        }, 0);
    }

    public function createWechatOrder(Order $order){
        $total = 1;
        $user = request()->user();
        if (App::environment('production')) {
            $total = bcmul($order->total, 100);
        }

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '郭老贼无花果',
            'detail'           => '郭老贼无花果',
            'out_trade_no'     => $order->order_number,
            'total_fee'        => $total, // 单位：分
            'notify_url'       => route('notify.order'),
            'openid'           => $user->open_id,
        ];
        $wechatOrder = new \EasyWeChat\Payment\Order($attributes);

        Log::info('统一下单：', $order->toArray());
        $result = $this->wechat->payment->prepare($wechatOrder);   //生成预支付订单
        Log::info('生成预支付订单:'. json_encode($result));

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){

            $json = $this->wechat->payment->configForPayment($result->prepay_id);
            Log::info('微信支付预支付订单成功:'. json_encode($json));

            return $json;
        }

        return false;
    }

    private function generateOrderId(){
        return date('Ymd').random_int(100000,999999);
    }

    public function get($type = 'all'){
        $types = ['all', 'subscribe', 'common', 'gift', 'tree'];

        if (!in_array($type, $types)){
            return false;
        }

        $this->order->pushCriteria(new UserCriteria());

        $this->subscribe->pushCriteria(new UserCriteria());

        //all   subscribe认购   common常规  gift赠送  tree果树

        if ($type == 'subscribe'){
            $orders = $this->subscribe->findWhere([
                ['status', '!=', 'unpaid']
            ]);
        }else{
            $orders = $this->order->findWhere([
                ['type', '=', $type]
            ]);
        }

        return $orders;

    }

    public function find($id){
        return $this->order->find($id);
    }

    public function findByOrderId($orderId){
        return $this->order->findWhere([
            ['order_number', '=', $orderId]
        ])->first();
    }
}