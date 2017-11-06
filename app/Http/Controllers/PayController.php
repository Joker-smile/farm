<?php
/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-28
 * Time: 下午3:51
 */

namespace App\Http\Controllers;

use App\Repositories\Criterias\WithoutScopeCriteria;
use App\Repositories\OrderRepository;
use App\Repositories\SubscribeRepository;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function order(OrderRepository $repository){
        return $this->application->payment->handleNotify(function($notify, $successful) use ($repository){
            $repository->pushCriteria(new WithoutScopeCriteria());

            $order = $repository->findWhere([
                ['order_number', '=', $notify->out_trade_no]
            ])->first();
            if (!$order) {
                return 'Order not exist.';
            }

            if ($order->status == 'pending') {
                return true;
            }

            $order->status = $successful ? 'pending' : 'unpaid';

            $order->save();

            if ($successful){
                $user = $order->user;
                $user->score = bcadd($user->score, $order->total);
                $user->save();
            }

            return true;
        });
    }

    public function subscribe(SubscribeRepository $repository){
        return $this->application->payment->handleNotify(function($notify, $successful) use ($repository){
            Log::info('认购支付成功，微信回调！');
            Log::info('支付结果：'.$successful);
            Log::info('威信返回订单号：'.$notify->out_trade_no);
            $repository->pushCriteria(new WithoutScopeCriteria());

            $subscribe = $repository->findWhere([
                ['subscribe_id', '=', $notify->out_trade_no]
            ])->first();
            Log::info('认购订单：', $subscribe->toArray());


            if (!$subscribe) {
                return 'Order not exist.';
            }

            if ($subscribe->status == 'unpaid') {
                $subscribe->status = $successful == 1 ? 'pending' : 'unpaid';
                $subscribe->save();
            }

            if ($successful == 1){
                $user = $subscribe->user;
                Log::info('增加果子：'.$subscribe->gross);
                $user->harvests = bcadd($user->harvests, $subscribe->gross);
                $user->save();
            }

            if ($subscribe->inviter && $successful == 1){
                $inviter = $subscribe->inviter;
                Log::info('推荐人:', $inviter->toArray());
                if ($inviter->id != $subscribe->user_id){
                    Log::info('推荐增加果子,原有推荐人的果数：'.$inviter->harvests);
                    $inviter->harvests = $inviter->harvests + 1;
                    $inviter->save();
                }
            }

            return true;
        });
    }
}