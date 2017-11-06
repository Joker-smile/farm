@extends('frontend.layout')
<title>认购详情</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/order-subs.css')}}" />
{{--<link rel="stylesheet" type="text/css" href="{{asset('css/subscribe.css')}}" />--}}
@endpush
@section('content')
	<div class="content">
		<div class="subs-order">
			<p class="subs-day clearfix"><span class="begin-day">{{$subscribe->present()->created}}认购</span><span class="expire-day">{{$subscribe->present()->expired}}到期</span></p>
			<div class="subs-con clearfix">
				<div class="due-time">
					<div class="time">
						<p>到期天数</p>
						<span id="time_in">{{$subscribe->present()->expires}}</span>
						<div class="jindutiao"><div class="jindu" style="width: {{$subscribe->present()->process}}%;"></div></div>
					</div>
				</div>
				<div class="subs-infor">
					<ul>
						<li><p>认购套餐：<span id="combo">{{$subscribe->name}}</span></p></li>
						<li><p>认购单价：<span id="combo_price">￥{{$subscribe->unit}}</span></p></li>
						<li><p>认购数量：<span id="combo_num">{{$subscribe->count}}株</span></p></li>
						<li><p>认购总价：<span id="combo_total">￥{{$subscribe->total}}</span></p></li>
						<li><p>获得原始果：<span id="original">{{$subscribe->origin}}斤</span></p></li>
						<li><p>获得增加果：<span id="original">{{$subscribe->augment}}斤</span></p></li>
						<li><p>获得总果数：<span id="original">{{$subscribe->gross}}斤</span></p></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="order-footer">
			<a href="{{route('users.myfruits')}}">领取果子</a>
			<a href="{{route('users.mytree')}}">领取果树</a>
		</div>
	</div>
@endsection
