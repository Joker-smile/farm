@extends('frontend.layout')
<title>提现</title>
@push('css')

<link rel="stylesheet" type="text/css" href="{{asset('css/my-amount-fluits.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/withdraw-form.css')}}" />
@endpush

@component('frontend.toolbar')
@slot('tag')
personal
@endslot
@endcomponent

@section('content')
    <div class="content">
        <form action="{{route('users.withdrawhandle')}}">
            <div class="item ">
                <p class="form-item">提现额度</p>
                <p><input id="all-sum" type="text" disabled="disabled" value="{{$user->balance}}元" required/></p>
            </div>
            <div class="item ">
                <p class="form-item">提现金额</p>
                <p><input id="withdraw-sum" placeholder="请输入提现金额" type="text" name="balance" required/></p>
            </div>
            <div class="item ">
                <p class="form-item">开户姓名</p>
                <p><input id="men-name" type="text" value="" placeholder="如：张三" name="cardholder" required/></p>
            </div>
            <div class="item ">
                <p class="form-item">银行卡号码</p>
                <p><input id="bank-card" type="text" name="bank_card" required/></p>
            </div>
            <div class="item ">
                <p class="form-item">开户行地址</p>
                <p><input id="bank-address" placeholder="如：中国农业银行" type="text" name="open_bank" required/></p>
            </div>
            <p class="amount-stress">温馨提示：请核对好信息后再提交！</p>
            <div class="sub">
                <button>提交申请</button>
            </div>
            <div class="screen">
                <div class="hint-box">
                    <div class="hint"><p>提现成功</p></div>
                </div>
            </div>
        </form>
        <div class="prompt-box">
            <p class="hint-message">超过您可以提现的额度！</p>
        </div>
    </div>
    <script>
        $('.sub').click(function(){
            var num = $.trim($("#withdraw-sum").val());
            if(num>{{$user->balance}}){
                $('.prompt-box').show(400).delay(2000).hide(300);
                $('.hint-message').show(400).siblings().hide();
            }
        });
    </script>
@endsection
