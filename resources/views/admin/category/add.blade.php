@extends('admin.dashboard')

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
                        <h3 class="block-title">分类新增</h3>
                    </div>
                    <div class="block-content block-content-narrow">
                        <form class="js-validation-bootstrap form-horizontal" action="{{url('/admin/category/store')}}" method="post" >
                            {{ csrf_field() }}
                            <input type="hidden" name="parent_id" value="0">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">名称 <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name" name="name" required>
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