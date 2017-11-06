<?php

namespace App\Providers;

use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->validator();

        $this->observer();

        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        if ($user){
            Auth::login(User::where('open_id', $user->id)->first());
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function observer(){

    }

    public function validator(){
        //验证手机号
        Validator::extend('phone', function ($attribute, $value, $parameters) {
            return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7})$/', $value);
        },'手机号格式不正确!');

        //验证码
        Validator::extend('verify', function($attribute, $value, $parameters, $validator) {
            $code = reset($parameters);
            $verifyCode = Cache::get('PHONE::CODE::'.$value);

            return $verifyCode == $code;
        },'验证码无效');
    }
}
