@extends('frontend.layout')
<title>分享得果</title>
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/my_share.css')}}" />
@endpush
@component('frontend.toolbar')
    @slot('tag')
        personal
    @endslot
@endcomponent
@section('content')
    <div class="content">
        <div class="share-photo">
            <img src="../img/image/bg_share.jpg" alt="" />
        </div>
        <div class="mask clearfix">
            <div class="mask-hint"></div>
            <p class="mask-text">好友通过您分享的链接认购成功后，您可免费获得<span>1斤</span>无花果</p>
            <div class="mask-box">
                <p>分享得果总数</p>
                <p class="mask-num"><span id="mask_count">{{$count}}</span>斤</p>
                <a class="record" href="" style="display: none">分享得果记录</a>
                
            </div>
            <div class="statement">
                <p>声明：</p>
                <p>1.果子至少要累积到2斤才能包邮哦！</p>
                <p>2.好友必须通过你的链接认购成功后，您才可以获得无花果哦！</p>
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
