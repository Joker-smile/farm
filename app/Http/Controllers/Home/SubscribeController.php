<?php
/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-9-18
 * Time: 上午10:31
 */

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Services\SubscribeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Foundation\Application;

class SubscribeController extends Controller
{
    private $subscribe;
    private $wechat;
    public function __construct(SubscribeService $service,Application $application)
    {
        $this->subscribe = $service;
        $this->wechat = $application;
    }

    public function index(Request $request){
        $subscribe = config('subscribe');
        $user=Auth::user();
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('subscribes', ['inviter_id' => $user->id]);

        if ($request->has('inviter_id')){
            $request->session()->put('inviter_id', $request->get('inviter_id'));
        }

        return view('frontend.subscribe.index')->with([
            'json'  =>  $json,
            'url'   =>  $url,
            'subscribe' =>  $subscribe
        ]);
    }

    public function show($id){
        $subscribe = $this->subscribe->find($id);

        return view('frontend.subscribe.show')->with('subscribe', $subscribe);
    }

    public function subscribes(Request $request){
        $data = $request->validate([
            'count' =>  'required|numeric'
        ]);

        if ($data['count'] <= 0){
            return response()->json([
                'status'    =>  false,
                'message'   =>  '认购数量不能为0'
            ]);
        }

        $subscribe = config('subscribe');
        $user = Auth::guard('web')->user();

        try{
            $subscribe = $this->subscribe->create($subscribe, $data['count'], 0, $user);

            Log::info('创建认购订单：', $subscribe->toArray());

            $json = $this->subscribe->createWechatOrder($subscribe);

            Log::info('创建认购订单结果:'.json_encode($json));

            if ($json){
                return response()->json([
                    'status'    =>  true,
                    'json'      =>  $json
                ]);
            }

        }catch (Exception $e){
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e->getMessage().$e->getFile().$e->getLine()
            ]);
        }

        return response()->json([
            'status'    =>  false
        ]);

    }
    
    public function expired(){
        
    }
}