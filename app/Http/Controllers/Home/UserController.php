<?php
/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-5-3
 * Time: 上午9:05
 */

namespace App\Http\Controllers\Home;

use App\Entities\Address;
use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\Subscribe;
use App\Entities\User;
use App\Entities\Withdraw;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use EasyWeChat\Foundation\Application;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class UserController extends Controller
{
    private $user;

    private $wechat;

    public function __construct(UserRepository $repository,Application $application)
    {
        $this->wechat = $application;
        $this->user = $repository;

    }

    public function profile(){
        $wechat = session('wechat.oauth_user');
        $user = Auth::user();
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('home');
        return view('frontend.user.personal')->with(compact('wechat', 'user','json','url'));
    }


    public function option(){

        return view('frontend.user.options');
    }

   //我的钱包
    public function wallet(){
        $subscribe=0;
        $total=0;
        $user=Auth::user();
        $count=count($user->subscribes);
        for ($i=0; $i<$count; $i++) {
            $expired_time=strtotime($user->subscribes[$i]->expired_at);
            $time=time();
           if ($expired_time>=$time && $user->subscribes[$i]->status!='unpaid'){

               $value=$user->subscribes[$i]->total;
               $subscribe+=$value;
           }
        }
        return view('frontend.user.wallet')->with(compact('user','subscribe'));
    }
    //unpaid    未付款
    //pending   未到期
    //expired   已到期
    //keeped    已续存(未到期)
    //continued 续存未到期
    //received 已领取（已到期）


    public function withdraw(Request $request){

        $user=Auth::user();
        return view('frontend.user.withdraw')->with(compact('user'));
    }

   //提现逻辑
    public function withdrawhandle(Request $request){
        DB::beginTransaction();
        try {
        $user=Auth::user();
        $data=$request->input();
        $withdraw=new Withdraw();
        $this->validate($request, [
            'balance' =>  'required|numeric',
            'cardholder' =>  'required|string',
            'open_bank' =>  'required|string',
            'bank_card' =>  'required|numeric'

        ]);

       if ($data['balance']<=$user->balance) {
           $withdraw->user_id = $user->id;
           $withdraw->cardholder = $data['cardholder'];
           $withdraw->balance = $data['balance'];
           $withdraw->open_bank = $data['open_bank'];
           $withdraw->bank_card = $data['bank_card'];

           $balances = $data['balance'];
           $databalance = $user->balance - $balances;
           $user->balance = $databalance;
           $user->update();
           $withdraw->save();
       }
       }catch(QueryException $ex){
            DB::rollback();
            return redirect('/users/withdraw');
       }
        DB::commit();
        return redirect('/users/success');
    }
    //提现成功
    public function success(){

        $user=Auth::user();
        $withdraw=$user->withdraws->last()->balance;


        return view('frontend.user.success')->with('withdraw',$withdraw);
    }
    /*
     * 我的记录
     * @Para $expired_timing
     * return array
     * */
    public function amount(){
        $user=Auth::user();
        $count=count($user->subscribes);
        for ($i=0; $i<$count; $i++) {
            $expired_time=strtotime($user->subscribes[$i]->expired_at);
            $time=time();
            if ($expired_time>=$time){
                $expired_timing=$user->subscribes[$i];
            }

            }
        return view('frontend.user.amount')->with(compact('user','expired_timing'));
    }
    
    //我的果子
    public function myfruits(){
        $user=Auth::user();
        return view('frontend.user.my_fruits')->with(compact('user'));

    }

   //果子领取
    public function amountfruits(){
        $user=Auth::user();
        return view('frontend.user.my_amount_fruits')->with(compact('user'));
    }

//我的果子领取生成订单
    public function fruits(Request $request){
        $num=$request->input('num');
        $address_id=$request->input('address_id');
        if ($request->input('address_id')){
            $order=new Order();
            $user=Auth::user();
            $order->address_id=$address_id;
            $order->order_number=$this->generateOrderId();
            $order->user_id=$user->id;
            $order->total=0;
            $order->type='common';

            $productId = Redis::get('FRUIT');

            if ($order->save()){
                $order_items=new OrderItem();
                $order_items->order_id=$order->id;
                $order_items->product_id=$productId;
                $order_items->quantity=$num;
                $order_items->unit=0;
                $order_items->options='我的果子';
                if ($order_items->save()){
                    $harvests=$user->harvests-$num*2;
                    $user->harvests=$harvests;
                    $user->update();
                    return 1;
                }
            }else{
                return 0;
            }
        }
    }

   //判断用户领取的果子有没有超出可以领取的数量
    public function value(Request $request){
        $user=Auth::user();
        if ($user->harvests<$request->input('num')*2){
            return 0;
        }else{
            return 1;
        }
    }

    //果子领取记录
    public function fruitsrecord(){

    }

    //我的果树
    public function mytree(){
        $mytree=0;
        $trees=0;
        $user=Auth::user();
        $count=count($user->subscribes);
        for ($i=0; $i<$count; $i++) {
            $expired_time=strtotime($user->subscribes[$i]->expired_at);
            $time=time();
            if ($user->subscribes[$i]->status!='unpaid'){
            if ($expired_time>=$time){
                $value=$user->subscribes[$i]->count;
                $mytree+=$value;
            }
            }
        }
        return view('frontend.user.my_tree')->with(compact('mytree','user'));
    }
    //unpaid    未付款
    //pending   未到期
    //expired   已到期
    //keeped    已续存(未到期)
    //continued 续存未到期
    //received 已领取（已到期）
    public function amounttree(){
        $user=Auth::user();
        return view('frontend.user.my_amount_tree')->with(compact('user'));
    }
/*
 * 果树生成订单
 * */
    public function trees(Request $request){
        $num=$request->input('num');
        $productId = Redis::get('TREE');
        $user=Auth::user();
        $money=$user->subscribes[0]->unit*$num;
        $address_id=$request->input('address_id');
        if ($money>$user->balance){
            return 0;
        }else{
            if ($request->input('address_id')){
                $order=new Order();
                $order->address_id=$address_id;
                $order->order_number=$this->generateOrderId();
                $order->user_id=$user->id;
                $order->total=$money;
                $order->type='tree';
                if ($order->save()){
                    $order_items=new OrderItem();
                    $order_items->order_id=$order->id;
                    $order_items->product_id=$productId;
                    $order_items->quantity=$num;
                    $order_items->unit=328;
                    $order_items->options='我的果树';
                    if ($order_items->save()){
                        $trees=$user->trees-$num;
                        $user->trees=$trees;
                        $balance=$user->balance-$money;
                        $user->balance=$balance;
                        $user->update();
                        return 1;
                    }
                }
            }

        }

    }

/*
 * 地址增加*/
    public function addressadd(Request $request ){
        $user=Auth::user();
        $addresses=new Address();
        $receiver=$request->input('receiver');
        $phone=$request->input('phone');
        $address=$request->input('address');
        $this->validate($request, [
            'receiver' =>  'required|string',
            'phone' =>  'required|numeric',
            'address' =>  'required|string'
        ]);
        $addresses->user_id=$user->id;
        $addresses->receiver=$receiver;
        $addresses->phone=$phone;
        $addresses->address=$address;
        if ($addresses->save()){
            return 1;
        }
    }



    public function treerecord(){

        return view('frontend.user.tree_record');
    }

    //生成order_number
    private function generateOrderId(){

        return date('Ymd').random_int(100000,999999);
    }
   //分享到朋友圈
    public function share(){
        $user=Auth::user();
        $json = $this->wechat->js->config(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']);
        $url = route('subscribes', ['inviter_id' => $user->id]);

        $count = Subscribe::where([
            ['inviter_id', '=',$user->id],
            ['status', '!=','unpaid']
        ])->where('user_id','!=',$user->id)->count();

        return view('frontend.user.share')->with([
            'json'  =>  $json,
            'url'   =>  $url,
            'count' =>  $count
        ]);
    }

    //我的认购
    public function subscribes(){
        $user = Auth::guard('web')->user();

        $subscribes = $user->subscribes()->where('status', '!=', 'unpaid')->get();

        $subscribe = config('subscribe');

        return view('frontend.user.subscribe')->with(compact('subscribes', 'subscribe'));
    }

    /*
     * 认购续存
     * */
     public function keep(Request $request){
         $users=new User();
         $subscribes=new Subscribe();
         $subscribe_id=$request->input('id');
         $subscribe=$subscribes->find($subscribe_id);
         $users=$users->find($subscribe['user_id']);
         if ($users->balance>=$subscribe['total']){
             $users->balance=$users->balance-$subscribe['total'];
             $subscribes['status']='keeped';
             $subscribes['name']=$subscribe['name'];
             $subscribes['user_id']=$subscribe['user_id'];
             $subscribes['augment']=$subscribe['augment']+1;
             $subscribes['origin']=$subscribe['origin'];
             $subscribes['subscribe_id']=$this->generateOrderId();
             $subscribes['unit']=$subscribe['unit'];
             $subscribes['total']=$subscribe['total'];
             $subscribes['count']=$subscribe['count'];
             $subscribes['gross']=$subscribes['origin']+$subscribes['augment'];
             $subscribes['expired_at']= Carbon::now()->addYear()->toDateString();
//             $users->trees=$users->trees-$subscribes['count'];
             $users->harvests+=$subscribes['gross'];
             $users->update();
             $subscribes->save();
             return 1;
         }else{
             return 0;
         }
}
}
