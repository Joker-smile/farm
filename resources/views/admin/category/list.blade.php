@extends('admin.dashboard')

@section('content')
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
                    <div class="block-header">
                        <div class="block-options">
                            <a href="{{url('/admin/category/add')}}" class="btn btn-primary">新增</a>
                        </div>
                        <h3 class="block-title">商品分类列表</h3>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                {{--<th>描述</th>--}}
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    {{--<td>{{$category->description}}</td>--}}
                                    <td>{{$category->created_at}}</td>
                                    <td>
                                        <a href="{{url('/admin/category/edit',$category->id)}}" class="btn btn-xs btn-primary">修改</a>
                                        {{--<a id="{{$category->id}}" class="btn btn-xs btn-danger delete">删除</a>--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$categories->links()}}
                </div>
                <!-- END Default Table -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.delete').on('click',function () {
                if (confirm('确定要删除吗?')){
                    var id = $(this).attr('id');
                    console.log(id);
                    $.get('/index.blade.php/admin/category/delete/'+id,function (ret) {
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