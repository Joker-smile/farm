@extends('frontend.layout')
<title>果子领取</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/my-amount-fluits.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/my_address.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent

@section('content')
    <div class="content">
        <form action="" method="post">
            <div class="fluits-con">
                <p class="fluits-stress">亲爱的贼主子，您可以领取<span id="all_amount">{{$user->harvests}}斤</span>果子，请根据您自己的需求选择量：</p>
                <p class="amount-stress">温馨提示：因为无花果自身易坏易损不易保存的特性，建议贼主子根据自己的需求领取相应的量哦，且领且珍惜。</p>
                <div class="fluits-pack">
                    <div class="pack-con">
                        <p><span class="check active" style=""></span>2斤装</p>
                        {{--<p><span class="check"></span>3斤装</p>--}}
                        {{--<p><span class="check"></span>4斤装</p>--}}
                    </div>
                    <div class="pack-num">
                        <p><span id="pack_N">2斤装</span></p>
                        <div class="add-num">
                            <span id="sub">-</span>
                            <input type="text" value="1" id="num" />
                            <span id="add">+</span>
                        </div>
                        <span style="padding-left: 0.3rem">箱</span>
                    </div>
                    <a href="#" class="present">提交</a>
                </div>
            </div>
            <div class="prompt-box">
                <p class="hint-message">超过您可以领取的果子数量！</p>
            </div>

            <div class="screen">
                <div class="hint-box">
                    <div class="hint"><p>领取成功</p></div>
                    <p class="bottom-hint">果子在7-15个工作日内就可以收到啦</p>
                </div>
                <div class="hint-boxs">
                    <div class="hints"><p>添加成功</p></div>
                    <p class="bottom-hints">可以到地址选择查看啦！</p>
                </div>
                <div class="address-c">
                    <div class="address-head">
                        <p><span class="add-choose add-chace">地址选择</span><span class="add_address" >地址添加</span><span class="close"></span></p>
                    </div>
                    <ul>
                        @forelse($user->address as $key=>$value)
                                <li class="add0 clearfix">
                                    <div class="men-s">
                                        <input type="radio" class="ch-ad" name="address_id" id="address_id" value="{{$value->id}}">
                                        <p>收货人：<span id="men-name">{{$value->receiver}}</span></p>
                                        <p>手机号码：<span id="men-num" name="phone">{{$value->phone}}</span></p>
                                    </div>
                                    <p class="men-address">收货地址：{{$value->address}}</p>
                                </li>
                            @empty
                                    您还有地址，请您先添加地址！
                            <br/>
                            <br/>
                        @endforelse
                    <a href="javascript:;" class="affirm">确定</a>
                    </ul>
                    <ul class="new-address">
                        <li><p>收件人</p><input type="text" name="receiver" id="receiver" placeholder="请输入收件人的姓名" value="" required/></li>
                        <li><p>手机号码</p><input type="text" name="phone" id="phone" placeholder="请输入收件人的电话号码" value="" required/></li>
                        <li><p>详细地址</p><input type="text" name="address" id="address" placeholder="请输入收件人的详细地址"value="" required/></li>
                        <a href="javascript:;" class="affirms">确定</a>
                    </ul>
                </div>
            </div>
    </div>
    <script>
        $('.address-head p span').click(function(){
            $(this).addClass('add-choose').siblings().removeClass('add-choose');
            $('.address-c ul').hide().eq($('.address-head p span').index(this)).show();
        });
        $('.close').click(function(){
            $('.screen').hide();
            window.location.reload();
        });
    </script>
    <script>
        $('.address-c ul:first').show();
        $('.present').click(function(){
            var num = $.trim($("#num").val());
            $.ajax({
                type:"POST",
                url:'{{route('users.value')}}',
                data:{num:num},
                dataType:'json',
                success:function(msg){
                    if(msg==1){
                        $('.screen').show();
                    }else{
                        $('.prompt-box').show(400).delay(2000).hide(300);
                        $('.hint-message').show(400).siblings().hide();
                    }
                }
            });
        });
        $('.check').click(function() {
            $(this).addClass('active').parent('p').siblings().children('.check').removeClass('active');

            $("#pack_N").html($(this).parent('p').text());
        });

        $('#sub').click(function(){
            var num = $('#num').val();
            var n = parseInt(num) - 1;
            if (n == 0) {return;};
            $('#num').val(n);
        });

        $('#add').click(function(){
            var num = $('#num').val();
            var n = parseInt(num) + 1;
            if (n == 0) {return;};
            $('#num').val(n);
        });

        $(".affirm").click(function(){
            var id = $.trim($("input[name='address_id']:radio:checked").val());
            var num = $.trim($("#num").val());
            if (id==''){
                alert("您好像忘了选择地址或者没有地址la！");
            }else {
                $.ajax({
                    type:"POST",
                    url:'{{route('users.fruits')}}',
                    data:{address_id:id,num:num},
                    dataType:'json',
                    success:function(msg){
                        if(msg==1){
                            $('.address-c').hide();
                            $('.hint-box').show().delay(2000).hide(300);
                            $('.screen').show().delay(2000).hide(320);
                            setTimeout(function(){window.location.reload();},2000);
                        }
                    }
                });
            }
        });
        $(".affirms").click(function(){
            var receiver=$.trim($("#receiver").val());
            var phone=$.trim($("#phone").val());
            var address=$.trim($("#address").val());
            if(receiver==''){

                alert('收件人姓名不得为空(⊙o⊙)哦！');

            }else if(phone=='')
            {
                alert('收件人的电话号码不得为空(⊙o⊙)哦！');

            }else if(address=='')
            {
                alert('收件人的详细地址不得为空(⊙o⊙)哦！');

            }else{
                $.ajax({
                    type:"POST",
                    url:'{{route('users.address.add')}}',
                    data:{receiver,phone,address},
                    dataType:'json',
                    success:function(msg){
                        if(msg==1){
                            $('.address-c').hide();
                            $('.hint-boxs').show().delay(2000).hide(300);
                            $('.screen').show().delay(2000).hide(320);
                            setTimeout(function(){window.location.reload();},2000);
                        }
                    }
                });
            }
        });

    </script>
@endsection