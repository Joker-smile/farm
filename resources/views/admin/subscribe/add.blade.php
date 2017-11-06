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
                        <h3 class="block-title">每日认购新增</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{url('/admin/subscribe/store')}}" method="post" >
                            {{ csrf_field() }}
                            <input type="hidden" name="thumb" id="thumb">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">果树名称 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name" name="name" value="无花果" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="total">总数 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="total" name="total" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="surplus_count">剩余 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="surplus_count" name="surplus_count" required>
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                            {{--<label class="col-md-2 control-label" for="unit">单价 <span class="text-danger">*</span></label>--}}
                            {{--<div class="col-md-8">--}}
                            {{--<input class="form-control" type="text" id="unit" name="unit" value="0" required>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="subscribe_time">认购日期 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="js-datepicker form-control" type="text" id="subscribe_time" name="subscribe_time" data-date-format="yyyy-mm-dd" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="end_time">结束时间 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="end_time" name="end_time" placeholder="18:00" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="content">简介 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="content" name="content" required></textarea>
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
    <script src="{{asset('assets/js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.js-datepicker').datetimepicker({
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection