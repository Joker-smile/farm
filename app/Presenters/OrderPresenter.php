<?php

namespace App\Presenters;
use Laracasts\Presenter\Presenter;
/**
 * Class OrderPresenter
 *
 * @package namespace App\Presenters;
 */
class OrderPresenter extends Presenter
{
    public function humanStatus(){
        //unpaid未付款 pending待发货 deliver已发货
        switch ($this->status){
            case 'unpaid':
                return '未付款';
            case 'pending':
                return '待发货';
            case 'shipping':
                return '已发货';
            case 'deliver':
                return '完成订单';
        }
    }
}
