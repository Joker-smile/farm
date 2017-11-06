<?php

namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AuthComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (str_contains($this->request->getRequestUri(), 'admin')){
            $view->with('admin', Auth::guard('admin')->user());
        }else {
            $view->with('user', Auth::guard('web')->user());
        }

    }
}