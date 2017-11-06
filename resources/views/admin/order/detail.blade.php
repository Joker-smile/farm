@extends('admin.dashboard')

@section('css')
    <link rel="stylesheet" id="css-main" href="{{asset('assets/js/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/js/plugins/select2/select2-bootstrap.css')}}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background: #5c90d2;
            border: none;
        }
    </style>
@endsection

@section('content')
    @if (session('status'))
    <div class="content">
        <div class="block">
            <div class="block-content">
                <div class="row">
                    @if(session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <h3 class="font-w300 push-15">操作成功！</h3>
                        </div>
                    </div>
                    @endif

                    @if(!session('status'))
                    <div class="col-sm-6 col-lg-3">
                        <div class="alert alert-danger alert-dismissable">
                            <h3 class="font-w300 push-15">操作失败！</h3>
                        </div>
                    </div>
                    @endif

                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <p>{{ $error }}</p>
                                </div>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">订单详细</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <div class="row">
                            <div class="col-xs-6 text-right"><p>订单号：</p></div>
                            <div class="col-xs-6">
                                <p>{{$order->order_number}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 text-right"><p>类型：</p></div>
                            <div class="col-xs-6">
                                <p>
                                    @if($order->type =='common')
                                        常规订单
                                    @elseif($order->type =='gift')
                                        赠送订单
                                    @elseif($order->type =='tree')
                                        果树订单
                                    @elseif($order->type =='fruit')
                                        果子订单
                                    @endif
                                </p>
                            </div>
                        </div>
                        {{--//common常规  gift赠送  tree果树 fruit 果子--}}
                        <div class="row">
                            <div class="col-xs-6 text-right"><p>状态：</p></div>
                            <div class="col-xs-6">
                                <p>
                                    @if ($order->status=='deliver')
                                        完成订单
                                    @endif
                                    @if ($order->status=='pending')
                                        待发货
                                    @endif

                                    @if ($order->status=='shipping')
                                        已发货
                                    @endif
                                    @if ($order->status=='unpaid')
                                        未付款
                                    @endif
                                        {{--unpaid未付款 pending待发货 shipping已发货 deliver 完成订单--}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-right"><p>单价：</p></div>
                            <div class="col-xs-6">
                                <p>￥{{$order->items[0]->unit}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 text-right"><p>地址：</p></div>
                            <div class="col-xs-6">
                                <p>{{$order->address['address']}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 text-right"><p>快递：</p></div>
                            <div class="col-xs-6">
                                <p>{{$order->shipping_carrier}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-right"><p>快递号：</p></div>
                            <div class="col-xs-6">
                                <p>{{$order->shipping_number}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 text-right"><p>时间：</p></div>
                            <div class="col-xs-6">
                                <p>{{$order->created_at}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 text-right"><p>总计：</p></div>
                            <div class="col-xs-6">
                                <p>￥{{$order->total}}</p>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- END Default Table -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/js/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            App.initHelpers(['select2']);
        });
    </script>
@endsection