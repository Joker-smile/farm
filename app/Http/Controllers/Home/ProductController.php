<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use EasyWeChat\Foundation\Application;
class ProductController extends Controller
{
    private $product;
    private $wechat;
    public function __construct(ProductRepository $productRepository,Application $application)
    {
        $this->product = $productRepository;
        $this->wechat=$application;
    }

    public function show($id)
    {
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('products.show',['id'=>$id]);
        $product = $this->product->find($id);

        return view('frontend.product.show')->with(
            [
                'product'=>$product,
                'json'=>$json,
                'url'=>$url
            ]);
    }
}
