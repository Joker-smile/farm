@extends('frontend.layout')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/subscribe.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/my-amount-tree.css')}}" />
@endpush

@component('frontend.toolbar')
	@slot('tag')
		personal
	@endslot
@endcomponent

@section('content')
	<div class="content">
		<div class="con-show">
			<p>续存可获得比去年多<span>1斤</span>的精品无花果</p>
		</div>
		<div class="prompt-box">
			<p class="hint-message">续存成功</p>
		</div>
		<!-- 续存后订单 -->
		@foreach($subscribes as $s)
		<div class="subs-order">
			<p class="subs-day clearfix"><span class="begin-day">{{$s->present()->created}}认购</span><span class="expire-day">{{$s->present()->expired}}到期</span></p>
			<div class="subs-con clearfix">
				@if($s->status == 'continued')
				<span class="news">续存一年</span>
				@endif

				@if($s->status == 'pending' || $s->status == 'continued')
					<div class="due-time clearfix">
						<div class="time">
							<p>到期天数</p>
							<span id="time_in">{{$s->present()->expires}}</span>
							<div class="jindutiao"><div style="width: {{$s->present()->process}}%;" class="jindu"></div></div>
						</div>
					</div>
				@endif

				@if($s->status == 'expired')
					<div class="due-time">
						<div class="time">
							<a href="javascript:;" class="renew" id="{{$s->id}}">去续存</a>
						</div>
					</div>
				@endif

				@if($s->status == 'keeped')
					<div class="due-time">
						<div class="time">
							<img src="../img/icon/deta.png" alt="" />
						</div>
					</div>
				@endif
				<div class="subs-infor">
					<ul>
						<li><p>认购套餐：<span id="combo">{{$subscribe['name']}}</span></p></li>
						<li><p>认购单价：<span id="combo_price">￥{{$subscribe['cost']}}</span></p></li>
						<li><p>认购数量：<span id="combo_num">{{$s->count}}株</span></p></li>
						<li><p>认购总价：<span id="combo_total">￥{{$s->total}}</span></p></li>
						<li><p>原始果子：<span id="original">{{$s->origin}}斤</span></p></li>
						<li><p>增加果子：<span id="add_fluits">{{$s->augment}}斤</span></p></li>
						<li><p>最终得果：<span id="finish_fluits">{{$s->gross}}斤</span></p></li>
					</ul>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<script>
        $(".renew").click(function(){
            if (confirm('您确定要续存吗?')){
                var id =$(this).attr('id');
                $.ajax({
                    type:"POST",
                    url:'{{route('users.keep')}}',
                    data:{id:id},
                    dataType:'json',
                    success:function(msg){
                        if(msg==1){
                            $('.prompt-box').show(400).delay(2000).hide(300);
                            $('.hint-message').show(400).siblings().hide();
                            setTimeout(function(){window.location.reload();},2000);
                        }else{
                            alert("您的余额不足，请先冲值哦～");
                        }
                    }
                });
			}
        });
	</script>
@endsection

