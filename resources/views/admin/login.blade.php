<!DOCTYPE html>
<head>
    <meta charset="utf-8">

    <title>后台管理登录</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <link rel="stylesheet" id="css-main" href="{{asset('css/oneui.css')}}">
</head>
<body>

<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                    <h3 class="block-title">登录</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <h1 class="h2 font-w600 push-30-t push-5">后台管理</h1>

                    <form class="js-validation-login form-horizontal push-30-t push-50" action="{{ route('admin.login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" id="username" name="username" value="{{ old('username') }}" required>
                                    <label for="login-username">用户名</label>
                                    @if ($errors->has('username'))
                                        <div id="val-username-error" class="help-block text-right animated fadeInDown">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="password" id="password" name="password" required>
                                    <label for="login-password">密码</label>
                                    @if ($errors->has('password'))
                                        <div id="val-username-error" class="help-block text-right animated fadeInDown">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="remember" name="remember"><span></span>记住我
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <button class="btn btn-block btn-primary" type="submit"><i class="si si-login pull-right"></i>登录</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="push-10-t text-center animated fadeInUp">
    <small class="text-muted font-w600">2017 &copy; OneUI 1.0</small>
</div>
</body>
</html>