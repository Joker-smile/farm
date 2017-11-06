@extends('frontend.layout')
<title>我的订单</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/order.css')}}" />
@endpush

@component('frontend.toolbar')
    @slot('tag')
        personal
    @endslot
@endcomponent

@section('content')
<div class="nav">
    <div class="order-classify">
        <div class="classify-wrapper clearfix">
            {{--<span class="all-order Inactive">全部订单</span>--}}
            <a href="{{route('orders', ['type' => 'subscribe'])}}"><span class="sub-order @if($type == 'subscribe') Inactive @endif">认购订单</span></a>
            <a href="{{route('orders', ['type' => 'common'])}}"><span class="sub-order @if($type == 'common') Inactive @endif">普通订单</span></a>
            <a href="{{route('orders', ['type' => 'tree'])}}"><span class="sub-order @if($type == 'tree') Inactive @endif">果树订单</span></a>
            <a style="display: none" href="{{route('orders', ['type' => 'gift'])}}"><span class="sub-order @if($type == 'gift') Inactive @endif">积分订单</span></a>
        </div>
    </div>
</div>
<div class="content clearfix">
    <ul class="order-con">
        @forelse($orders as $order)
            <li class="order-page">
                <div class="order-head">
                    <p>订单号：<span id="order_num">{{$order->order_number or $order->subscribe_id}}</span></p>
                    <p class="order-state">{{$order->present()->humanStatus}}</p>
                </div>
                <div class="order-body">
                    @foreach($order->items as $item)
                    <div class="o-body-con clearfix @if (!$loop->first) o-next @endif">
                        <div class="order-img">
                            <img src="{{$item->product->thumb[1]}}" alt="" />
                        </div>
                        <div class="order-infor">
                            <p><span id="o_name">{{$item->product->name}}</span></p>
                            <p>单价：<span id="o_price">￥{{$item->unit}}</span></p>
                            <p>数量：<span id="o_count">{{$item->quantity}}</span></p>
                            <p>总价：<span id="o_allprice">￥{{$order->total}}</span></p>
                        </div>
                    </div>
                    @endforeach

                    @if($order->status != 'unpaid')
                    <a href="{{route('orders.show', ['id' => $order->id])}}" class="o-detail">查看详情</a>
                    @endif
                </div>
                @if($order->status == 'unpaid' || count($order->items) > 1)
                    <div class="order-foot foot_in">
                        @if(count($order->items) > 1)
                        <span class="foot-click">点击查看其它商品</span>
                        @endif

                        @if($order->status == 'unpaid')
                        <a href="#" class="foot_pay" data-order-id="{{$order->order_number}}">付款</a>
                        @endif
                    </div>
                @endif
            </li>
            @empty
            <!-- <p class="text-center">没有订单</p> -->
            <img class="order-back text-center" src="../img/image/noOrder.png" />
        @endforelse

    </ul>
</div>
@endsection

@push('js')
<script>
    $(function(){
        $('.foot-click').on('click',function(){
            var _this = $(this);

            var orderPage = _this.parents('.order-page');

            if (orderPage.find('.o-body-con').slice(1, ).hasClass('o-next')) {

                orderPage.find('.o-body-con').slice(1, ).removeClass('o-next');

                _this.text('收起列表').addClass('foot-click-up');
            } else {

                orderPage.find('.o-body-con').slice(1, ).addClass('o-next');

                _this.text('点击查看其它商品').removeClass('foot-click-up');
            }
        });

        $('.foot_pay').on('click', function(){
            var orderId = $(this).attr('data-order-id');

            $.ajax({
                type : 'POST',
                url : '{{route('unified.orders')}}',
                data : {
                    order_id : orderId
                },
                success : function (ret) {
                    if (ret.status){
                        var config = JSON.parse(ret.json);
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest', config,
                            function(res){
                                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                    setTimeout(function () {
                                        window.location.href = '/orders/success';
                                    }, 1500);
                                }else{
                                    alert('支付失败');
                                }
                            }
                        );
                    }else{
                        alert('未知错误，稍后再试');
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