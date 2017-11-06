@extends('frontend.layout')
<title>我的果子</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/my-fluits.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent

@section('content')
    <div class="content">
        <div class="content">
            <div class="my-fluits clearfix">
                <p class="fluits-s">果子总数</p>

                <a style="display: none" href="{{route('users.fruitsrecord')}}">果子记录</a>
                <p class="fluits"><span id="all_fluits">{{$user->harvests}}</span>斤</p>
            </div>
            <div class="draw"><a href="{{route('users.amountfruits')}}" class="my_draw">我要领取</a></div>
        </div>
    </div>
@endsection
