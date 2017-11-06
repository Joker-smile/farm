@extends('frontend.layout')
<title>订单详情</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/order-detail.css')}}" />
@endpush

@component('frontend.toolbar')
	@slot('tag')
		personal
	@endslot
@endcomponent

@section('content')
	<div class="content">
		<div class="order-detail-page">
			<div class="order-detail-head">
				<p>订单号<span id="order-detail_num">{{$order->order_number}}</span></p>
				<p class="order-detail-time">{{$order->created_at}}</p>
			</div>
			<div class="order-detail-body">
				@foreach($order->items as $item)
				<div class="o-body-con clearfix">
					<div class="order-detail-img">
						<img src="{{$item->product->thumb[1]}}" alt="" />
					</div>
					<div class="order-detail-infor">
						<p><span id="o_name">{{$item->product->name}}</span></p>
						<p>单价：<span id="o_price">￥{{$item->unit}}</span></p>
						<p>数量：<span id="o_count">{{$item->quantity}}</span></p>
						<p>快递：<span id="o_express">包邮</span></p>
						<p>总价：<span id="o_allprice">￥{{$order->total}}</span></p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="order-address">
			<h2>收货地址</h2>
			<div class="add-men-detail clearfix">
				<p>收货人：<span id="men-name">{{$order->address->receiver}}</span></p>
				<p>联系电话：<span id="men-num">{{$order->address->phone}}</span></p>
			</div>
			<p class="add_detail">{{$order->address->address}}</p>
		</div>
		<!-- 待付款 -->
		<div class="obligation hide">
			<h2>待付款</h2>
			<p>￥<span id="order_Cost">150.00</span></p>
			<a href="">取消订单</a>
			<div class="order-pay">
				<div class="click-me">点我点我</div>
				<a href="">付款</a>
			</div>
		</div>
		<!-- 已付款 -->
		@if($order->status == 'pending')
		<div class="order-paid">
			<h2>待发货</h2>
			<p>亲，别急哦，您的订单我们会打包好让快递哥哥送到您家门口~</p>
		</div>
		@endif

		@if($order->status == 'deliver' or $order->status == 'shipping')
		<!-- 已发货 -->
		<div class="shipments">
			<h2>已发货</h2>
			<p>{{$order->shipping_carrier}}: <span id="expressNum"></span>{{$order->shipping_number}}</p>
		</div>
		@endif
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