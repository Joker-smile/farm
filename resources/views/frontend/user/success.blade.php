@extends('frontend.layout')
<title>提现成功</title>
@push('css')
{{--<link rel="stylesheet" type="text/css" href="{{asset('css/success.css')}}" />--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('css/my-success.css')}}"/>--}}
<link rel="stylesheet" type="text/css" href="{{asset('css/buy-success.css')}}"/>
@endpush
@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent
@section('content')
    <div class="content">
        {{--<div class="screens">--}}
            {{--<div class="hint-boxs">--}}
                {{--<div class="hints"><p>提现成功</p></div>--}}
                {{--<p class="bottom-hints"><span id="totalSecond">6</span>秒后自动跳转...<br>--}}
                   {{--预计到账时间{{date('Y-m-d H:i:s',time()+7200)}}<br>--}}
                   {{--提现金额￥{{$withdraw}} <br>--}}
                {{--</p>--}}

            {{--</div>--}}
        {{--</div>--}}
        {{--<script language="javascript" type="text/javascript">--}}
            {{--var second = document.getElementById('totalSecond').textContent;--}}

            {{--if (navigator.appName.indexOf("Explorer") > -1)  {--}}
                {{--second = document.getElementById('totalSecond').innerText;--}}
            {{--} else {--}}
                {{--second = document.getElementById('totalSecond').textContent;--}}
            {{--}--}}

            {{--setInterval("redirect()", 1000);--}}
            {{--function redirect() {--}}
                {{--if (second < 0) {--}}
                    {{--location.href = '{{route('users.wallet')}}';--}}
                {{--} else {--}}
                    {{--if (navigator.appName.indexOf("Explorer") > -1) {--}}
                        {{--document.getElementById('totalSecond').innerText = second--;--}}
                    {{--} else {--}}
                        {{--document.getElementById('totalSecond').textContent = second--;--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--</script>--}}
        <div class="content">
            <div class="success">
                <p>提现成功</p>
                <div class="suc-cho">
                    <a href="{{route('users.wallet')}}" class="c-back">返回</a>
                    <a href="{{route('users.withdraw')}}" class="g-order">继续提现</a>
                </div>
            </div>
        </div>

    </div>

@endsection
