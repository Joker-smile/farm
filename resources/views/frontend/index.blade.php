@extends('frontend.layout')
<title>郭老贼商城首页</title>
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/swiper.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}" />
@endpush

@component('frontend.toolbar')
    @slot('tag')
        home
    @endslot
@endcomponent

@section('content')
	<div class="content">
		<div class="big-pic swiper-container">
            <div class="swiper-wrapper">
                @foreach($rets as $banner)
                <div class="swiper-slide"><img src="{{$banner}}" alt="" /></div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="module">
        	<ul>
                <a href="javascript:;" class="sign-in">
                    <li>
                        <img src="../img/icon/home_day.png" alt="" class="qiandao" />
                    </li>
                    <p id="qiandao">每日签到</p>
                </a>
                <a href="{{route('subscribes')}}" class="rush-purchase">
                    <li>
                        <img src="../img/icon/home_buy.png" alt="" />
                    </li>
                    <p>我要认购</p>
                </a>
                <a href="javascript:;" class="exclusive">
                    <li>
                        <img src="../img/icon/home_fruit.png" alt="" />
                    </li>
                    <p>干果专享</p>
                </a>
                <a href="{{route('farm')}}" class="orchard-worker">
                    <li>
                        <img  src="../img/icon/home_farmer.png" alt="" />
                    </li>
                    <p>果农专区</p>
                </a>
            </ul>     
        </div>
        <div class="explosions">
        	<h1>无花果专区</h1>
        	<ul class="ex-content clearfix">
                @foreach($models as $model)
                    <li class="ex-type">
                        <a href="{{route('products.show', ['id' => $model->id])}}" class="ex-item"><img src="{{$model->thumb[0]}}" alt="" /></a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="prompt-box">
        	<p class="integral">欢迎登陆，签到成功，获得积分：<span>{{$score or 0}}</span>分</p>
        	<p class="hint-message">新品即将上线，尽情期待！</p>
            <p class="message">您今日已签到</p>
        </div>

        {{--<div class="screen">--}}
        	{{--<div class="phone-case">--}}
        		{{--<p>您还未绑定手机号，点击确定绑定手机号</p>--}}
        		{{--<a href="">确定</a>--}}
        	{{--</div>--}}
        {{--</div>--}}
	</div>
@endsection

@push('js')
	<script>
		var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true
        });
    	@if(isset($score))
    		$('.prompt-box').show(400).delay(2000).hide(300);
    		$('.integral').show(400).siblings().hide();
    	@endif
    	$('.exclusive').click(function(){
    		$('.prompt-box').show(400).delay(2000).hide(300);
    		$('.hint-message').show(400).siblings().hide();
    	});



	</script>
    <script>
        $(".qiandao").click(function(){
            $('.prompt-box').show(400).delay(2000).hide(300);
            $('.message').show(400).siblings().hide();
        });
    </script>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript" charset="utf-8">
            wx.config({!! $json !!});
            wx.ready(function(){
                wx.onMenuShareTimeline({
                    title: '郭老贼-分享免费吃无花果', // 分享标题
                    desc:'郭老贼-打造新一代健康、高品质农业+互联网弄潮儿。分享链接免费得1斤无花果。认购果树，免费得4斤无花果。',//分享描述
                    link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('img/image/glzlogo.png')}}', // 分享图标
                    success: function () {
                        console.log('share succeed');
                    },
                    cancel: function () {
                        console.log('share canceled');
                    }
                });
            });
            wx.ready(function(){
                wx.onMenuShareAppMessage({
                    title: '郭老贼-分享免费吃无花果', // 分享标题
                    desc:'郭老贼-打造新一代健康、高品质农业+互联网弄潮儿。分享链接免费得1斤无花果。认购果树，免费得4斤无花果。',//分享描述
                    link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('img/image/glzlogo.png')}}', // 分享图标
                    success: function () {
                        console.log('share succeed');
                    },
                    cancel: function () {
                        console.log('share canceled');
                    }
                });
            });
            wx.ready(function(){
                wx.onMenuShareQQ({
                    title: '郭老贼-分享免费吃无花果', // 分享标题
                    desc:'郭老贼-打造新一代健康、高品质农业+互联网弄潮儿。分享链接免费得1斤无花果。认购果树，免费得4斤无花果。',//分享描述
                    link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('img/image/glzlogo.png')}}', // 分享图标
                    success: function () {
                        console.log('share succeed');
                    },
                    cancel: function () {
                        console.log('share canceled');
                    }
                });
            });
            wx.ready(function(){
                wx.onMenuShareWeibo({
                    title: '郭老贼-分享免费吃无花果', // 分享标题
                    desc:'郭老贼-打造新一代健康、高品质农业+互联网弄潮儿。分享链接免费得1斤无花果。认购果树，免费得4斤无花果。',//分享描述
                    link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('img/image/glzlogo.png')}}', // 分享图标
                    success: function () {
                        console.log('share succeed');
                    },
                    cancel: function () {
                        console.log('share canceled');
                    }
                });
            });
            wx.ready(function(){
                wx.onMenuShareQZone({
                    title: '郭老贼-分享免费吃无花果', // 分享标题
                    desc:'郭老贼-打造新一代健康、高品质农业+互联网弄潮儿。分享链接免费得1斤无花果。认购果树，免费得4斤无花果。',//分享描述
                    link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('img/image/glzlogo.png')}}', // 分享图标
                    success: function () {
                        console.log('share succeed');
                    },
                    cancel: function () {
                        console.log('share canceled');
                    }
                });
            });
        </script>
@endpush
