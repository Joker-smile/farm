@extends('frontend.layout')
<title>商品详情</title>
@push('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/swiper.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/product-detail.css')}}" />
@endpush

    @section('content')
	<div class="content"> 
		<div class="pro-photo swiper-container">
			 <div class="swiper-wrapper">
                 @foreach($product->thumb as $thumb)
					 @if (!$loop->first)
						 <div class="swiper-slide"><img src="{{$thumb}}" alt="" /></div>
					 @endif
                 @endforeach
            </div>
            <div class="swiper-pagination"></div>
		</div>
		<div class="pro-con">
			<p id="product">
			<span id="pro_name">{{$product->name}}</span>
			<span id="pro_cost">￥{{$product->price}}</span>
			</p>
		</div>
		<div class="pro-link">
			<a href="{{route('subscribes')}}">328元认购一株无花树就免费吃4斤精品无花果</a>
		</div>
		<div class="pro-detail">
			<h2>商品详情</h2>
			<div class="pro-metter">
                {!! $product->content !!}
			</div>
		</div>
		<div class="cost-cart">
			<a href="{{route('cart.add', ['product_id' => $product->id])}}" class="add-to-cart" id="addCart">加入购物车</a>
		</div>
	</div>
    @endsection


@push('js')
	<script>
		var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true
        });

		{{--$('.add-to-cart').on('click', function () {--}}
            {{--$.ajax({--}}
                {{--type : 'POST',--}}
                {{--url : '{{route('cart.add')}}',--}}
                {{--data : {--}}
                    {{--product_id : {{$product->id}},--}}
                {{--},--}}
                {{--success : function (ret) {--}}
                    {{--console.log(ret);--}}
                    {{--if (ret.status){--}}
                        {{--window.location.href = '{{route('carts')}}'--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
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