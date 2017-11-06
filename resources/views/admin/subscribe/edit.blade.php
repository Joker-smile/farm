@extends('admin.dashboard')

@section('css')
    <link rel="stylesheet" id="css-main" href="{{asset('assets/js/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">

    <link rel="stylesheet" id="css-main" href="{{asset('assets/js/plugins/webuploader/webuploader.css?v1.0')}}">
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
                        <h3 class="block-title">每日认购修改</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{url('/admin/subscribe/update')}}" method="post" >
                            {{ csrf_field() }}
                            {{--<input type="hidden" name="thumb" id="thumb" value="{{$subscribe->thumb}}">--}}
                            <input type="hidden" name="id" value="{{$subscribe->id}}">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">认购名称 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name" name="name" value="{{$subscribe->name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="total">用户名称 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="total" name="" value="{{$subscribe->user->nickname}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="surplus_count">认购数量<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="surplus_count" name="count" value="{{$subscribe->count}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="unit">单价 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                            <input class="form-control" type="text" id="unit" name="unit" value="{{$subscribe->unit}}" disabled>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="unit">总价 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                            <input class="form-control" type="text" id="unit" name="total" value="{{$subscribe->total}}" disabled>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="subscribe_time">原始果 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="js-datepicker form-control" type="text" id="subscribe_time" name="origin" value="{{$subscribe->origin}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="end_time">增加果 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="js-datepicker form-control" type="text" id="end_time" name="augment" data-date-format="hh:ii" value="{{$subscribe->augment}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="content">总数果 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="gross" name="gross" value="{{$subscribe->gross}}" required>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label" for="content">到期时间<span class="text-danger">*</span></label>--}}
                                {{--<div class="col-md-8">--}}
                                    {{--<input class="form-control" type="text"  id="gross" name="expired_at" value="{{$subscribe->expired_at}}" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-2 control-label" for="content">状态<span class="text-danger">*</span></label>--}}
                                {{--<div class="col-md-8">--}}
                                    {{--<select name="status" id="status">--}}
                                        {{--<option value="unpaid" @if($subscribe->status=='unpaid') selected @endif>未付款</option>--}}
                                        {{--<option value="pending" @if($subscribe->status=='pending') selected @endif>未到期</option>--}}
                                        {{--<option value="expired" @if($subscribe->status=='expired') selected @endif>已到期</option>--}}
                                        {{--<option value="keeped" @if($subscribe->status=='keeped') selected @endif>已续存</option>--}}
                                        {{--<option value="continued" @if($subscribe->status=='continued') selected @endif>续存未到期</option>--}}
                                        {{--<option value="received" @if($subscribe->status=='received') selected @endif>已领取</option>--}}
                                        {{--//unpaid    未付款--}}
                                        {{--//pending   未到期--}}
                                        {{--//expired   已到期--}}
                                        {{--//keeped    已续存--}}
                                        {{--//continued 续存未到期--}}
                                        {{--//received 已领取--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
    <script src="{{asset('assets/js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.js-datepicker').datetimepicker({
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>

@endsection