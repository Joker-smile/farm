@extends('frontend.layout')
<title>认购</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/swiper.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/subscription.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
    subscribes
@endslot
@endcomponent

@section('content')
	<div class="content">
		<p class="sub-infor">分享此页面,好友通过你的链接成功认购，您就可免费获得1斤精品无花果</p>

		<div class="con-img">
			<img class="rengou-img" src="{{asset('img/image/buy.jpg')}}" alt="" />
		</div>
		<a href="#" class="sub-now">立即认购</a>

		<div class="screen">
            <div class="back">
                <span class="alert-close"></span>
                <h2>认购成功</h2>
                <p>您可以到<a href="">我的</a>——><a href="">我的果子</a>领取果子哦</p>
                <div class="sub-back">
                    <a href="{{route('home')}}" class="_back-in">我要再逛逛</a><a class="_back-go" href="{{route('users.profile')}}">马上去领取</a>
                </div>
            </div>
			<div class="pro-cart">
				<h2>商品属性选择<span class="close"></span></h2>
				<div class="cart-con clearfix">
					<div class="cart-img">
						<img src="{{asset('img/image/328.png')}}" alt="" />
					</div>
					<div class="cart-property clearfix">
						<p class="pro-pri">单价<span id="price">￥{{$subscribe['cost']}}</span></p>
						<p class="pro-num">总量<span id="gross">{{$subscribe['give']}}斤装</span></p>
						<p class="item">运费<span id="freight">包邮</span></p>
						<p class="item">
							<span id="item_num">数量</span>
							<span class="add-num">
			                    <span id="sub">-</span>
			                    <input type="text" value="1" id="num" />
			                    <span id="add">+</span>
	                		</span>
						</p>
						<p class="item">总价<span id="total">￥{{$subscribe['cost']}}</span></p>
					</div>
				</div>
				<a class="add-cart" href="#">认购</a>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>
    $(function(){
        $('.sub-now').click(function(){
            $('.screen').show();
            $('.pro-cart').show();
            $('.address-c').hide();
        });

        $('.screen').click(function(event){
            var _con = $('.pro-cart');
            if (!_con.is(event.target) && _con.has(event.target).length === 0) {
                $(this).hide();
                $('.back').hide();
                $('.pro-cart').hide();
            }
        })

        $('.close').click(function(){
            $('.screen').hide();
            $('.back').hide();
            $('.pro-cart').hide();
        });
        $('#sub').click(function(){
            var num = $('#num').val();
            var n = parseInt(num) - 1;
            if (n == 0) {return;};
            $('#num').val(n);
            $('#total').text({{$subscribe['cost']}} * n);
        });

        $('#add').click(function(){
            var num = $('#num').val();
            var n = parseInt(num) + 1;
            if (n == 0) {return;};
            $('#num').val(n);
            $('#total').text({{$subscribe['cost']}} * n);
        });

        $('.add-cart').on('click', function () {
            $.ajax({
                type : 'POST',
                url : '{{route('pay.subscribes')}}',
                data : {
                    count : parseInt($('#num').val())
                },
                success : function (ret) {
                    if (ret.status){
                        var config = JSON.parse(ret.json);
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest', config,
                            function(res){
                                if(res.err_msg == "get_brand_wcpay_request:ok") {
                                    $('.screen').show();
                                    $('.pro-cart').hide();
                                    $('.back').show();
                                }else{
                                    alert('支付失败');
                                    $('.screen').hide();
                                    $('.pro-cart').hide();
                                    
                                }
                            }
                        );
                    }
                }
            });
        });

    })
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

