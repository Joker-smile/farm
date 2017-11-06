<?php

namespace App\Listeners;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;


class WeChatUserAuthorizedListener
{
    private $userRepository;

    /**
     * WeChatUserAuthorizedListener constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  WeChatUserAuthorized  $event
     * @return void
     */
    public function handle(WeChatUserAuthorized $event)
    {
        $user = $this->userRepository->findWhere([
            ['open_id', '=', $event->user->id]
        ])->first();
        if ($user == null){     //数据库没有当前用户
            $this->userRepository->create([
                'open_id' => $event->user->id,
                'phone'   => '',
                'nickname'=> $event->user->nickname,
                'avatar'=> $event->user->avatar,
            ]);
        }else{
            Auth::login($user, true);
        }
    }
}
