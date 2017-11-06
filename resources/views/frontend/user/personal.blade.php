@extends('frontend.layout')
<title>个人首页</title>
	@push('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/peasonal.css')}}" />
	@endpush

	@component('frontend.toolbar')
		@slot('tag')
			personal
		@endslot
	@endcomponent

	@section('content')
	<div class="content">
		<div class="pea-header">
			<div class="pea-head">
				{{--<div class="pea-via"><img src="{{$wechat->avatar}}" /></div>--}}
				<div class="pea-via"><img src="{{$user->avatar}}" /></div>
				<p class="pea-name">{{$user->nickname}}</p>
			</div>
			<div class="pea-integral">积分：{{$user->score}}<span id="p_int"></span></div>
			<a  class="pea-gift" href="{{route('users.amount')}}">我的记录</a>
		</div>
		<div class="pea-con">
			<ul>
				<a href="{{route('orders', ['type' => 'common'])}}">
					<li class="my_order"><p>我的订单</p></li>
				</a>
				<a href="{{route('users.wallet')}}">
					<li class="my_wallet"><p>我的钱包</p></li>
				</a>
				<a href="{{route('users.subscribes')}}">
					<li class="my_sub"><p>我的认购</p></li>
				</a>
				<a href="{{route('users.myfruits')}}">
					<li class="my_fruits"><p>我的果子</p></li>
				</a>
				<a href="{{route('users.mytree')}}">
					<li class="my_tree"><p>我的果树</p></li>
				</a>
				<a href="{{route('users.share')}}">
					<li class="my_share"><p>分享得果</p></li>
				</a>
				<a style="display: none" href="{{route('users.option')}}">
					<li class="my_options"><p>资料设置</p></li>
				</a>
			</ul>
		</div>
	</div>
	@endsection
@push('js')
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