<?php

namespace App\Presenters;
use Carbon\Carbon;
use Laracasts\Presenter\Presenter;
/**
 * Class OrderPresenter
 *
 * @package namespace App\Presenters;
 */
class SubscribePresenter extends Presenter
{
    public function humanStatus(){
        //unpaid    未付款
        //pending   未到期
        //expired   已到期
        //keeped    已续存
        switch ($this->status){
            case 'unpaid':
                return '未付款';
            case 'pending':
                return '未到期';
            case 'expired':
                return '已到期';
            case 'keeped':
                return '已续存';
            case 'continued':
                return '未到期';
        }
    }

    public function created(){
        $created = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return $created->year . '年' . $created->month . '月' . $created->day . '日';
    }

    public function expired(){
        $created = Carbon::createFromFormat('Y-m-d H:i:s', $this->expired_at);

        return $created->year . '年' . $created->month . '月' . $created->day . '日';
    }

    public function expires(){
        $expired = Carbon::createFromFormat('Y-m-d H:i:s', $this->expired_at);

        return $expired->diffInDays(Carbon::now());
    }

    public function process(){
        $days = $this->expires();

        return (1 - $days / 365) * 100;
    }
}
