@extends('frontend.layout')
<title>认购订单</title>
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
                    <p>订单号：<span id="order_num">{{$order->subscribe_id}}</span></p>
                    <p class="order-state">{{$order->present()->humanStatus}}</p>
                </div>
                <div class="order-body">
                    <div class="o-body-con clearfix">
                        <div class="order-img">
                            <img src="../img/image/328.png" alt="" />
                        </div>
                        <div class="order-infor">
                            <p><span id="o_name">{{$order->name}}</span></p>
                            <p>单价：<span id="o_price">￥{{$order->unit}}</span></p>
                            <p>数量：<span id="o_count">{{$order->count}}</span></p>
                            <p>原始果：<span id="o_count">{{$order->origin}}斤</span></p>
                            <p>增加果：<span id="o_count">{{$order->augment}}斤</span></p>
                            <p>总共果：<span id="o_count">{{$order->gross}}斤</span></p>
                            <p>总价：<span id="o_allprice">￥{{$order->total}}</span></p>
                        </div>
                    </div>
                    <a href="{{route('subscribes.show', ['id' => $order->id])}}" class="o-detail">查看详情</a>
                </div>
                <div class="order-foot foot_in">
                    <a href="{{route('users.myfruits')}}" class="foot_getFluits">领取果子</a>

                    @if($order->status == 'expired')
                    <a href="{{route('users.mytree')}}" class="foot_getTree">领取果树</a>
                    @endif
                </div>
            </li>

            @empty
            <img class="order-back text-center" src="../img/image/noOrder.png" />
        @endforelse

    </ul>
</div>
@endsection
