<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('328套餐')->comment('认购名称');
            $table->integer('user_id');
            $table->integer('count')->default(1)->comment('认购数量');
            $table->float('unit')->comment('单价');
            $table->float('total')->comment('总价');
            $table->integer('origin')->default(4)->comment('原始果');
            $table->integer('augment')->default(0)->comment('增加果');
            $table->integer('gross')->default(0)->comment('总数果');
            $table->string('status')->default('unpaid')->comment('状态');
            $table->integer('inviter_id')->comment('推荐人id');
            //unpaid    未付款
            //pending   未到期
            //expired   已到期
            //keeped    已续存
            //continued 续存未到期
            //received 已领取
            $table->timestamp('expired_at');
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
        Schema::dropIfExists('subscribes');
    }
}
