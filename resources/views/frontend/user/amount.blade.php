@extends('frontend.layout')
<title>我的记录</title>
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/amount.css')}}" />
@endpush

@section('content')
    <div class="content">
        <ul class="amount-record">
@for($i=0;$i<count($user->subscribes);$i++)
         @if(strtotime($user->subscribes[$i]->expired_at)>time()&&$user->subscribes[$i]->status!='unpaid')
             @if($user->subscribes[$i]->status=='keeped')
             <li>
                 <p id="amount-operate">{{date('Y年m月d日',strtotime($user->subscribes[$i]->created_at))}}续存{{$user->subscribes[$i]->total/$user->subscribes[$i]->unit}}株果树</p>
                 <p id="amount-sum">-￥{{$user->subscribes[$i]->total}}</p>
             </li>
            @else
            <li>
                 <p id="amount-operate">{{date('Y年m月d日',strtotime($user->subscribes[$i]->created_at))}}认购{{$user->subscribes[$i]->total/$user->subscribes[$i]->unit}}株果树</p>
                 <p id="amount-sum">-￥{{$user->subscribes[$i]->total}}</p>
            </li>
         @endif
         @endif
         @if(strtotime($user->subscribes[$i]->expired_at)<=time())
             @if($user->subscribes[$i]->status=='received')
            <li>
                <p id="amount-operate">{{date('Y年m月d日',strtotime($user->subscribes[$i]->created_at))}}领取{{$user->subscribes[$i]->total/$user->subscribes[$i]->unit}}株果树</p>
                <p id="amount-sum">-￥{{$user->subscribes[$i]->total}}</p>
            </li>
             @else
           <li>
               <p id="amount-operate">{{date('Y年m月d日',strtotime($user->subscribes[$i]->expired_at))}}认购到期</p>
               <p class="sum_add" id="amount-sum">+￥{{$user->subscribes[$i]->total}}</p>
           </li>
             @endif
         @endif
   @endfor
    @for($i=0;$i<count($user->withdraws);$i++)
        @if($user->withdraws[$i]->is_handle==1)
        <li>
            <p id="amount-operate">{{date('Y年m月d日',strtotime($user->withdraws[$i]->created_at))}}提现成功</p>
            <p id="amount-sum">-￥{{$user->withdraws[$i]->balance}}</p>
        </li>
        @else
            <li>
                <p id="amount-operate">{{date('Y年m月d日',strtotime($user->withdraws[$i]->created_at))}}申请提现￥{{$user->withdraws[$i]->balance}}</p>
                <p id="amount-sum">等待处理</p>
            </li>
        @endif
    @endfor
    @for($i=0;$i<count($user->orders);$i++)
        @if($user->orders[$i]->type=='tree')
        <li>
            <p id="amount-operate">{{date('Y年m月d日',strtotime($user->orders[$i]->created_at))}}领取{{$user->orders[$i]->total/328}}株果树</p>
            <p id="amount-sum">-￥{{$user->orders[$i]->total}}</p>
        </li>
        @endif
    @endfor
        </ul>
    </div>
@endsection
