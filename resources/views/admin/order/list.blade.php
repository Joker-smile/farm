@extends('admin.dashboard')

@section('content')
    <style>
        .mydate{
            width: 150px;
            height: 30px;
            border: 1px solid #CCC;
        }
        .status{
            width: 80px;
            height: 30px;
            border: 1px solid #CCC;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-lg-12 hide" id="success-info">
                <div class="alert alert-success alert-dismissable">
                    <h3 class="font-w300 push-15">操作成功！</h3>
                </div>
            </div>
            <div class="col-lg-12 hide" id="error-info">
                <div class="alert alert-danger alert-dismissable">
                    <h3 class="font-w300 push-15">操作失败！</h3>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="block">
                    {{--<div class="block-options">--}}
                        {{--<a href="{{url('/admin/order/add')}}" class="btn btn-primary">新增</a>--}}
                    {{--</div>--}}
                    <div class="block-header">
                        <h3 class="block-title">订单列表</h3>
                        <br>
                        <form method="get" action="{{url('admin/order/search')}}" name=”search”>
                        订单号：<input name="search" type="text" value="" class="mydate" size=”30″ required>
                        <input value="搜索" type="submit" class="btn btn-xs btn-primary">&nbsp&nbsp&nbsp&nbsp;
                        </form>
                        <br>
                        <form method="get" action="{{url('admin/order/search')}}" name=”search”>
                            订单状态：<select name="status" id="status" class="status">
                                <option value="all">全部</option>
                                <option value="pending">待发货</option>
                                <option value="shipping">已发货</option>
                                <option value="deliver">完成订单</option>
                            </select>

                            起始日期：<input name="begintime" type="date" class="mydate" placeholder="选择起始日期" size=”20″ />
                            结束日期：<input name="endtime" type="date" class="mydate" placeholder="选择结束日期" size=”20″ />
                            <input value="搜索" type="submit" class="btn btn-xs btn-primary">&nbsp&nbsp&nbsp&nbsp;

                        </form>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>用户</th>
                                <th>收货人</th>
                                <th>订单总价</th>
                                <th>地址</th>
                                <th>物流名称</th>
                                <th>物流单号</th>
                                <th>订单类型</th>
                                <th>订单状态</th>
                                <th>生成时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->order_number}}</td>
                                    <td>{{$order->user_id}}</td>
                                    <td>{{$order->address['receiver']}}</td>
                                    <td>￥{{$order->total}}</td>
                                    <td>{{$order->address['address']}}</td>
                                    <td>{{$order->shipping_carrier}}</td>
                                    <td>{{$order->shipping_number}}</td>
                                    <td>
                                        @if($order->type =='common')
                                            常规
                                        @elseif($order->type =='gift')
                                            赠送
                                        @elseif($order->type =='tree')
                                            果树
                                        @endif
                                    </td>
                                    {{--//common常规  gift赠送  tree果树 fruit 果子--}}
                                    <td>
                                        @if ($order->status=='unpaid')
                                            未付款
                                        @endif
                                        @if ($order->status=='pending')
                                             待发货
                                        @endif
                                        @if ($order->status=='shipping')
                                             已发货
                                        @endif
                                        @if($order->status=='deliver')
                                            完成订单
                                        @endif
                                    </td>
                                    {{--unpaid未付款 pending待发货 shipping已发货 deliver 完成订单--}}
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                            @if($order->status =='shipping')
                                            <a href="{{url('/admin/order/edit',['id'=>$order->id])}}" class="btn btn-xs btn-primary">修改</a>
                                            <a href="{{url('/admin/order/detail', $order->id)}}" class="btn btn-xs btn-success">详细</a>
                                            @endif

                                            @if($order->status == 'pending')
                                            <a href="{{url('/admin/order/logistic',$order->id)}}" data-toggle="popover" data-content="{{$order->logistic_num}}" data-original-title="{{$order->logistic_name}}" data-placement="bottom" class="btn btn-xs btn-warning">物流</a>
                                            <a href="{{url('/admin/order/detail', $order->id)}}" class="btn btn-xs btn-success">详细</a>
                                            @endif

                                            @if($order->status == 'deliver')
                                                <a href="{{url('/admin/order/detail', $order->id)}}" class="btn btn-xs btn-success">详细</a>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$orders->links()}}
                </div>
                {{--<!-- END Default Table -->--}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.close-order').on('click',function () {
                if (confirm('确定要关闭吗?')){
                    var id = $(this).attr('order-id');
                    console.log(id);
                    $.post('/index.php/admin/order/status', {
                        'order_id' : id,
                        'status'   : 6,
                        '_token'   : '{{csrf_token()}}'
                    },function (ret) {
                        if (ret.status){
                            $('#success-info').removeClass('hide');
                        }else {
                            $('#error-info').removeClass('hide');
                        }
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    });
                }
            });

            $('.send-order').on('click',function () {
                if (confirm('确定要发货吗?')){
                    var id = $(this).attr('order-id');
                    console.log(id);
                    $.post('/index.php/admin/order/status', {
                        'order_id' : id,
                        'status'   : 4,
                        '_token'   : '{{csrf_token()}}'
                    },function (ret) {
                        if (ret.status){
                            $('#success-info').removeClass('hide');
                        }else {
                            $('#error-info').removeClass('hide');
                        }
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    });
                }
            });

            $('.accept-order').on('click',function () {
                if (confirm('确定要接单吗?')){
                    var id = $(this).attr('order-id');
                    $.post('/index.php/admin/order/status', {
                        'order_id' : id,
                        'status'   : 3,
                        '_token'   : '{{csrf_token()}}'
                    },function (ret) {
                        if (ret.status){
                            $('#success-info').removeClass('hide');
                        }else {
                            $('#error-info').removeClass('hide');
                        }
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    });
                }
            });
        });

    </script>
@endsection