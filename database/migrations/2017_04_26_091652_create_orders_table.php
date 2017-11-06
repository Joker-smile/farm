<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number');
            $table->integer('user_id');
            $table->float('total')->comment('订单总价');
            $table->integer('address_id')->comment('地址id');
            $table->string('status')->default('pending')->comment('订单状态');     //unpaid未付款 pending待发货 shipping已发货 deliver完成订单
            $table->string('shipping_carrier')->nullable()->comment('物流名');
            $table->string('shipping_number')->nullable()->comment('物流单号');
            $table->string('type')->default('common')->comment('订单类型');
            //common常规  gift赠送  tree果树 fruit 果子
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }

}
