@extends('frontend.layout')
<title>我的钱包</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/my-wallet.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent

@section('content')
    <div class="content">
        <div class="my-sum clearfix">
            <p class="sum-s">总金额</p>
            <a style="display: none" href="{{route('users.amount')}}">金额记录</a>
            <p class="sum">￥<span id="all_sum">{{$subscribe+$user->balance}}</span></p>
        </div>
        <div class="withdraw">
            <p class="my_cost clearfix">可提现金额：<strong>￥<span id="my_wd">{{$user->balance}}</span></strong>@if($user->balance!=0)<a href="{{route('users.withdraw')}}">我要提现</a>@endif</p>
            <div class="progress">
                <div class="pro-con"></div>
            </div>
        </div>
        <div class="un_withd">
            <p class="my_cost">未到期金额：<strong>￥<span id="my_uwd">{{$subscribe}}</span></strong></p>
            <div class="Un_progress">
                <div class="Un_pro-con"></div>
            </div>
        </div>
    </div>
    <script>
        var sum = $('#all_sum').html();
        var myWd = $('#my_wd').html();
        var UmyWd = $('#my_uwd').html();
        $('.pro-con').width(function(){
            return (myWd/sum) * 100 + '%';
        })
        $('.Un_pro-con').width(function(){
            return (UmyWd/sum) * 100 + '%';
        })
    </script>
@endsection
