<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_id');
            $table->string('phone')->nullable();
            $table->float('balance')->default(0)->comment('钱包余额');
            $table->float('trees')->default(0)->comment('可领取果树');
            $table->integer('score')->default(0);
            $table->integer('harvests')->default(0)->comment('用户当前剩余可收成数');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
