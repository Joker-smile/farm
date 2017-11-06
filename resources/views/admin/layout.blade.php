<!DOCTYPE html>
<head>
    <meta charset="utf-8">

    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" id="css-main" href="{{asset('css/oneui.css')}}">
    <style>
        .default-content {
            padding-top: 0px;
        }
        .btn-add {
            background: #fff !important;
            color: #3e4a59 !important;
            border-color: #fff;
            opacity: 1 !important;
        }
    </style>
    @yield('css')
</head>
<body>
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

    @include('admin.menu')

    <header id="header-navbar" class="content-mini content-mini-full">
        <ul class="nav-header pull-right">
            <li>
                <div class="btn-group">
                    <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button" style="padding-left: 10px;">
                        {{ $admin->nickname }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a tabindex="-1" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"><i class="si si-logout pull-right"></i>登出
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </header>


    <main id="main-container">
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @yield('title')
                    </h1>
                </div>
            </div>
        </div>
        @include('admin.messages')
        @yield('content')

    </main>

    <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
        <div class="pull-right">
            Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="javascript:void(0)" target="_blank">SunnyShift</a>
        </div>
        <div class="pull-left">
            <a class="font-w600" href="javascript:void(0)" target="_blank">OneUI 1.0</a> &copy; 2017
        </div>
    </footer>
</div>

<script src="{{asset('js/core/jquery.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/core/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('js/core/jquery.scrollLock.min.js')}}"></script>
<script src="{{asset('js/core/jquery.appear.min.js')}}"></script>
<script src="{{asset('js/core/jquery.countTo.min.js')}}"></script>
<script src="{{asset('js/core/jquery.placeholder.min.js')}}"></script>
<script src="{{asset('js/core/js.cookie.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('js')
</body>
</html>