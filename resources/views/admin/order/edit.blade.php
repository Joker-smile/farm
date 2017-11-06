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
                        <h3 class="block-title">修改订单状态</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{ url('admin/order/update')}}" method="post" >
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$orders->id}}">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="order_id">订单号 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="order_number" name="order_number" value="{{$orders->order_number}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="order_id">用户id<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="user_id" name="user_id" value="{{$orders->user_id}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="product_name">订单总价<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="total" name="total" value="{{$orders->total}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="user_phone">地址id <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="address" name="address" value="{{$orders->address['address']}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">订单状态 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select name="status" id="status">
                                            <option value="deliver" @if($orders->status=='deliver') selected @endif>完成订单</option>
                                            <option value="shipping" @if($orders->status=='shipping') selected @endif>已发货</option>
                                    </select>
                                    {{--unpaid未付款 pending待发货 deliver完成订单--}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="freight">订单类型 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select name="type" id="type" disabled >
                                        <option value="common" @if($orders->type=='common') selected @endif>普通订单</option>
                                        <option value="gift" @if($orders->type=='gift') selected @endif>赠送订单</option>
                                        <option value="tree" @if($orders->type=='tree') selected @endif>果树订单</option>
                                        <option value="fruit" @if($orders->type=='fruit') selected @endif>果子订单</option>
                                        {{--//common常规  gift赠送  tree果树 fruit 果子--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="count">物流公司<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="countshipping_carrier" name="shipping_carrier" value="{{$orders->shipping_carrier}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="freight">物流单号 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="shipping_number" name="shipping_number" value="{{$orders->shipping_number}}">
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