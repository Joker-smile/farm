@extends('frontend.layout')
<title>果农专区</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/aboutUs.css')}}" />
@endpush


@component('frontend.toolbar')
    @slot('tag')
        home
    @endslot
@endcomponent

@section('content')
	<div class="content">
        <img src="{{asset('img/image/farmers.jpg')}}" alt="" />
        <div class="people-tv">
            <h3>中央7套农业节目采访</h3>
            <div class="people-con">
                <iframe src="https://v.qq.com/iframe/player.html?vid=x05599yga37&tiny=0&auto=0" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
@push('js')
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