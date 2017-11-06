<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelShoppingCart\Cart;
use ShoppingCart;
use JavaScript;
use EasyWeChat\Foundation\Application;
class CartController extends Controller
{
    private $product;

    private $cart;

    private $wechat;

    public function __construct(ProductRepository $productRepository, Cart $cart,Application $application)
    {
        $this->product = $productRepository;

        $this->cart = $cart;

        $this->wechat = $application;

        $this->middleware(function ($request, $next){
            $user = $request->user();

            $this->cart->name($user->open_id);

            return $next($request);
        });
    }

    public function carts(){
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('home');
        $items = $this->cart->all();
        $rets = [];

        foreach ($items as $item){
            array_push($rets, $item->toArray());
        }
        Log::info('获取所有购物车商品:', $rets);
        JavaScript::put([
            'items' => $rets
        ]);
 
        return view('frontend.cart.cart')->with(
            [
            'items'=> $rets,
            'json'=>$json,
            'url'=>$url
            ]);
    }

    public function items(){
        $items = $this->cart->all();

        $rets = [];

        foreach ($items as $item){
            array_push($rets, $item->toArray());
        }
        Log::info('AJAX获取所有购物车商品:', $rets);
        return response()->json($rets);
    }

    public function add(Request $request){
        $product_id = $request->get('product_id');

        $product = $this->product->find($product_id);

        $row = $this->cart->add($product->id, $product->name, 1, $product->price, [
            'options'   =>  ['thumb' => $product->thumb]
        ]);

        Log::info('加入购物车商品：', $row->toArray());

        return redirect()->route('carts');
    }

    public function delete($rawId){
        $ret = $this->cart->remove($rawId);

        return response()->json([
            'status'    =>  $ret
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'raw_id'    =>  'required|string',
            'qty'     =>  'required|numeric'
        ]);
        $ret = $this->cart->update($data['raw_id'], $data['qty']);

        return response()->json([
            'status'    =>  $ret
        ]);
    }
}