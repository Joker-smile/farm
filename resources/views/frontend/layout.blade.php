<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{asset('js/flexible.debug.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-1.12.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/swiper.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}" />
    @stack('css')

</head>
<body>

	@yield('content')

</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@if(!app()->environment('production'))
    <script type="text/javascript" src="https://res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/vconsole/2.5.1/vconsole.min.js"></script>
@endif

@stack('js')
</html>