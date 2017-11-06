@extends('admin.layout')



@section('content')
    <div class="content default-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header">
                        <h3>数据新增</h3>
                    </div>
                    <div class="block-content">
                        <form class="form-horizontal" action="{{route('admin.configs.store.banner')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">BANNER图片</label>
                                <div class="col-md-7">
                                    @foreach($banners as $banner)
                                        <img src="{{$banner}}" width="100px">
                                    @endforeach
                                    @uploader(['name' => 'thumb', 'max' => 10, 'accept' => 'jpg,png,jpeg'])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @uploader('assets')
@endsection
