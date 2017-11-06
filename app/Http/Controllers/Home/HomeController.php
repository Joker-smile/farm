<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use EasyWeChat\Foundation\Application;
class HomeController extends Controller
{
    private $product;
    private $wechat;

    public function __construct(ProductRepository $productRepository,Application $application)
    {
        $this->wechat = $application;
        $this->product = $productRepository;
    }

    public function farm(){
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('farm');
        return view('frontend.about')->with([
            'json'  =>  $json,
            'url'   =>  $url
        ]);
    }
    
    public function home()
    {
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('home');
        $banners = Redis::get('BANNER');

        $rets = [];
        if ($banners != null){
            foreach (json_decode($banners) as $banner){
                $rets[] = Storage::url($banner);
            }
        }
//        $test=new User();
//        Auth::login($test->find(1));
        $user = Auth::user();
        $key = sprintf('USER::%s::SIGN::%s', $user->id, date('Y-m-d'));

        if (Redis::set($key, str_random(), 'nx')){
            $score = $this->score();
            $user->score = $user->score + $score;
            $user->save();
        }

        $models = $this->product->findWhere([
            ['status', '=', 1]
        ]);
    
        return view('frontend.index')->with(compact('rets', 'models', 'score','json','url'));
    }

    /**
     * 获取随机签到分数
     * @return int
     */
    public function score(){
        $score = 0;

        $rand = mt_rand() / mt_getrandmax();

        switch ($rand){
            case $rand < 0.55:
                $score = rand(1,4);
                break;
            case 0.55 < $rand && $rand < 0.9:
                $score = rand(5,8);
                break;
            case $rand > 0.9:
                $score = rand(9,10);
                break;
        }

        return $score;
    }
}
