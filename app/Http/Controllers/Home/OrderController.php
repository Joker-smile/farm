<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Repositories\ProductRepository;
use App\Services\OrderService;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelShoppingCart\Cart;
use ShoppingCart;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private $order;

    private $product;

    private $address;

    private $cart;

    private $wechat;

    public function __construct(OrderService $orderService, ProductRepository $productRepository, AddressRepository $addressRepository, Cart $cart,Application $application)
    {
        $this->order = $orderService;

        $this->product = $productRepository;

        $this->address = $addressRepository;

        $this->cart = $cart;
        $this->wechat = $application;

        $this->middleware(function ($request, $next){
            $user = $request->user();

            $this->cart->name($user->open_id);

            return $next($request);
        });
    }

    /**
     * 统一下单
     * @param Request $request
     * @param Application $wechat
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request, Application $wechat){
        $data = $this->validate($request, [
            'selected'  =>  'sometimes|required|array',
            'address'   =>  'sometimes|required|array',
            'order_id'  =>  'sometimes|exists:orders,order_number'
        ]);

        if ($request->has('order_id')){
            $order = $this->order->findByOrderId($request->input('order_id'));
        }else{
            $items = $this->cart->all();
            Log::info('统一下单购物车商品：', $items->toArray());
            Log::info('选中商品：', $data['selected']);
            $products = [];
            foreach ($items as $key => $item){
                if (in_array($key, $data['selected'])){
                    $product = $this->product->find($item['id']);
                    $product == null ?: array_push($products, [
                        'product'   =>  $product,
                        'qty'   =>  $item['qty']
                    ]) ;
                }
            }

            $address = $this->address->find($data['address']['id']);

            if ($address == null){
                throw new NotFoundHttpException('地址不存在');
            }

            $order = $this->order->createCommon($products, $address);
        }

        if ($order === false){
            return response()->json([
                'status'    =>  false
            ]);
        }

        $json = $this->order->createWechatOrder($order);

        if ($json){
            return response()->json([
                'status'    =>  true,
                'json'      =>  $json
            ]);
        }

        return response()->json([
            'status'    =>  false
        ]);
    }

    public function success(){
        return view('frontend.cart.success');
    }

    public function orders(Request $request){
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('home');

        $type = $request->get('type', 'all');

        $orders = $this->order->get($type);

        if ($type == 'subscribe'){
            return view('frontend.subscribe.list')->with(compact('orders', 'type','json','url'));
        }

        $orders = $orders->reverse();

        return view('frontend.order.list')->with(compact('orders', 'type','json','url'));
    }

    public function show($id){
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('home');
        $order = $this->order->find($id);

        return view('frontend.order.show')->with(
            [
                'order'=> $order,
                'json'=> $json,
                'url'=> $url
            ]);
    }

}
