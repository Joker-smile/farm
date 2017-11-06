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

                        </div>
                        <h3 class="block-title">用户列表</h3>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>昵称</th>
                                {{--<th>手机号</th>--}}
                                <th>余额</th>
                                <th>积分</th>
                                <th>剩余可收成数</th>
                                <th>可领取的果树</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->nickname}}</td>
                                    {{--<td>{{$user->phone}}</td>--}}
                                    <td>{{$user->balance}}</td>
                                    <td>{{$user->score}}</td>
                                    <td>{{$user->harvests}}</td>
                                    <td>{{$user->trees}}</td>
                                    <td>
                                        <a href="{{url('/admin/user/edit',$user->id)}}" class="btn btn-xs btn-primary">修改</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
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
                    $.get('/index.php/admin/category/delete/'+id,function (ret) {
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