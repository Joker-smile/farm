<?php
namespace App\Services;


use App\Entities\Subscribe;
use App\Entities\User;
use App\Repositories\SubscribeRepository;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Support\Log;
use Illuminate\Support\Facades\App;

class SubscribeService
{
    private $subscribe;

    private $wechat;

    public function __construct(SubscribeRepository $orderRepository, Application $wechat)
    {
        $this->subscribe = $orderRepository;

        $this->wechat = $wechat;
    }

    /**
     * @param array $subscribe  认购数据
     * @param int $count 认购数量
     * @param int $continueYear 续购年份
     * @param User $user        用户
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $subscribe, int $count, int $continueYear, User $user){
        $origin = bcmul($subscribe['give'], $count);

        $augment = bcmul($continueYear, $count);

        $gross = bcadd($origin, $augment);

        $inviterId = session('inviter_id', null);
        \Illuminate\Support\Facades\Log::info('生成认购订单，推荐人: '.$inviterId);

        return $user->subscribes()->create([
            'name'  =>  $subscribe['name'],
            'count' =>  $count,
            'unit'  =>  $subscribe['cost'],
            'total' =>  bcmul($count, $subscribe['cost']),
            'origin'=>  $origin,
            'augment'=> $augment,
            'gross' =>  $gross,
            'status'=>  'unpaid',
            'expired_at' => Carbon::now()->addYear()->toDateString(),
            'subscribe_id' => $this->generateId(),
            'inviter_id'    =>  $inviterId
        ]);
    }

    public function createWechatOrder(Subscribe $subscribe){
        $total = 1;

        if (App::environment('production')) {
            $total = bcmul($subscribe->total, 100);
        }

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '郭老贼无花果',
            'detail'           => '郭老贼无花果',
            'out_trade_no'     => $subscribe->subscribe_id,
            'total_fee'        => $total, // 单位：分
            'notify_url'       => route('notify.subscribe'),
            'openid'           => $subscribe->user->open_id,
        ];
        $wechatOrder = new \EasyWeChat\Payment\Order($attributes);

        Log::info('认购统一下单：', $subscribe->toArray());
        $result = $this->wechat->payment->prepare($wechatOrder);   //生成预支付订单
        Log::info('生成预支付订单:'. json_encode($result));

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){

            $json = $this->wechat->payment->configForPayment($result->prepay_id);
            Log::info('微信支付预支付订单成功:'. json_encode($json));

            return $json;
        }

        return false;
    }

    private function generateId(){
        return date('Ymd').random_int(100000,999999);
    }

    public function find($id){
        return $this->subscribe->find($id);
    }
}