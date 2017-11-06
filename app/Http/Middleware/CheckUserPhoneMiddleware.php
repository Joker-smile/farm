<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserPhoneMiddleware
{
    private $except = [
        '/user/phone'
    ];

    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = session('wechat.oauth_user');
        //Log::info('中间件判断 用户是否绑定手机号:',['user' => $user]);
        $user = $this->userRepository->findWhere([
            ['open_id', '=', $user->id]
        ])->first();
        //$user = $this->userRepository->findUserByOpenId(session('wechat.oauth_user')->id);

        if ($this->inExceptArray($request)){    //排除的url
            return $next($request);
        }

        if ($user->phone){     //用户已经绑定手机号
            Log::info('用户已经绑定手机号,直接登录：',['user' => $user]);
            Auth::login($user);
            return $next($request);
        }

        return redirect()->to('/user/phone');
    }

    private function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
