<?php
namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 15/09/17
 * Time: 下午 02:32
 */
interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function changeOrderStatus($orderId, $status);

    public function update($model, $ads = []);

    public function findByOrderId($orderId);
}