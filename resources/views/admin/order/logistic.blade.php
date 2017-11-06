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
                        <h3 class="block-title">填写订单的物流单号</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{url('/admin/order/logistic/update')}}" method="post" >
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$order->id}}">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="order_number">订单号 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="order_number" name="order_number" value="{{$order->order_number}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">订单状态 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select name="status" id="status">
                                        <option value="pending" @if($order->status=='pending') selected @endif>待发货</option>

                                        <option value="shipping" @if($order->status=='shipping') selected @endif>已发货</option>
                                    </select>
                                    {{--unpaid未付款 pending待发货 deliver已发货--}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="logistic_name">物流公司<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="logistic_name" name="shipping_carrier" value="{{$order->shipping_carrier}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="logistic_num">快递单号<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="logistic_num" name="shipping_number" value="{{$order->shipping_number}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
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