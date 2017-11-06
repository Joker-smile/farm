@extends('admin.dashboard')

@section('css')
    <link rel="stylesheet" id="css-main" href="{{asset('js/plugins/wangEditor/dist/css/wangEditor.min.css')}}">
    <link rel="stylesheet" id="css-main" href="{{asset('js/plugins/webuploader/webuploader.css?v1.0')}}">
@endsection

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">商品配置</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{route('admin.configs.store.product')}}" method="post" >
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">果实ID <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name" name="fruit" value="{{$fruit}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">果树ID <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name" name="tree" value="{{$tree}}" required>
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
