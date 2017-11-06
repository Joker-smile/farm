/**
 * Created by PhpStorm.
 * User: joker
 * Date: 20/09/17
 * Time: 上午 09:12
 */
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
                            <a href="{{url('/admin/subscribe/add')}}" class="btn btn-primary" style="display: none">新增</a>
                        </div>
                        <h3 class="block-title">每日认购</h3>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>认购名称</th>
                                <th>用户名</th>
                                <th>认购数量</th>
                                <th>单价</th>
                                <th>总价</th>
                                <th>原始果</th>
                                <th>增加果</th>
                                <th>总数果</th>
                                <th>状态</th>
                                <th>到期时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($subscribes as $subscribe)
                                <tr>
                                    <td>{{$subscribe->id}}</td>
                                    <td>{{$subscribe->name}}</td>
                                    <td>{{$subscribe->user->nickname}}</td>
                                    <td>{{$subscribe->count}}</td>
                                    <td>{{$subscribe->unit}}</td>
                                    <td>{{$subscribe->total}}</td>
                                    <td>{{$subscribe->origin}}</td>
                                    <td>{{$subscribe->augment}}</td>
                                    <td>{{$subscribe->gross}}</td>

                                    <td>
                                            @if($subscribe->status=='unpaid')
                                                未付款
                                        @endif
                                            @if($subscribe->status=='pending')
                                                未到期
                                        @endif
                                            @if($subscribe->status=='expired')
                                                已到期
                                        @endif
                                            @if($subscribe->status=='keeped')
                                                已续存
                                        @endif
                                            @if($subscribe->status=='continued')
                                                续存未到期
                                        @endif
                                            @if($subscribe->status=='received')
                                                    已领取
                                        @endif
                                    </td>
                                    {{--//unpaid    未付款--}}
                                    {{--//pending   未到期--}}
                                    {{--//expired   已到期--}}
                                    {{--//keeped    已续存--}}
                                    {{--//continued 续存未到期--}}
                                    {{--//received 已领取--}}
                                    <td>{{$subscribe->expired_at}}</td>
                                    <td>
                                        <a href="{{url('/admin/subscribe/edit',$subscribe->id)}}" class="btn btn-xs btn-primary">修改</a>
                                        <a id="{{$subscribe->id}}" class="btn btn-xs btn-danger delete">删除</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$subscribes->links()}}
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
                    $.get('/index.php/admin/subscribe/delete/'+id,function (ret) {
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