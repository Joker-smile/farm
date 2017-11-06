@extends('frontend.layout')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/buy-success.css')}}" />
@endpush

@component('frontend.toolbar')
	@slot('tag')
		cart
	@endslot
@endcomponent

@section('content')
	<div class="content">
		<div class="success">
			<p>购买成功</p>
			<div class="suc-cho">
				<a href="{{route('home')}}" class="c-back">我要再逛逛</a>
				<a href="{{route('orders', ['type' => 'common'])}}" class="g-order">去查看订单</a>
			</div>
		</div>
	</div>

@endsection
