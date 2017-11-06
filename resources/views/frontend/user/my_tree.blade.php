@extends('frontend.layout')
<title>我的果树</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/my-tree.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent

@section('content')
    <div class="content">
        <div class="my-tree clearfix">
            <p class="tree-s">果树总数</p>
            <a style="display: none" href="{{route('users.treerecord')}}">果树记录</a>
            <p class="tree"><span id="all_tree">{{$mytree+$user->trees}}</span>株</p>
        </div>
        <div class="get-tree">
            <p class="my_cost clearfix">可领取果树：<strong><span id="my_wd">{{$user->trees}}</span>株</strong>@if($user->trees!=0)<a href="{{route('users.amounttree')}}">我要领取</a>@endif</p>
            <div class="progress">
                <div class="pro-con"></div>
            </div>
        </div>
        <div class="un_get-tree">
            <p class="my_cost">未到期果树：<strong><span id="my_uwd">{{$mytree}}</span>株</strong></p>
            <div class="Un_progress">
                <div class="Un_pro-con"></div>
            </div>
        </div>
    </div>
    <script>
        var tree = $('#all_tree').html();
        var myWd = $('#my_wd').html();
        var UmyWd = $('#my_uwd').html();
        $('.pro-con').width(function(){
            return (myWd/tree) * 100 + '%';
        })
        $('.Un_pro-con').width(function(){
            return (UmyWd/tree) * 100 + '%';
        })

    </script>
@endsection
