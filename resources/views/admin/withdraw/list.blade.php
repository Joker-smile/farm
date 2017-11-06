/**
 * Created by PhpStorm.
 * User: joker
 * Date: 19/09/17
 * Time: 上午 09:04
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
                        <h3 class="block-title">提现申请</h3>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户</th>
                                <th>金额</th>
                                <th>银行卡</th>
                                <th>开户行</th>
                                <th>是否处理</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($withdraws as $withdraw)
                                <tr>
                                    <td>{{$withdraw->id}}</td>
                                    <td>{{$withdraw->cardholder}}</td>
                                    <td>{{$withdraw->balance}}</td>
                                    <td>{{$withdraw->bank_card}}</td>
                                    <td>{{$withdraw->open_bank}}</td>
                                    <td>
                                        @if($withdraw->is_handle == 1)
                                            <span class="label label-success">已处理</span>
                                        @else
                                            <span class="label label-warning">未处理</span>
                                        @endif
                                    </td>
                                    <td>{{$withdraw->created_at}}</td>
                                    <td>
                                        @if($withdraw->is_handle == 0)
                                            <a id="{{$withdraw->id}}" name="is_handle" class="btn btn-xs btn-primary check">设置为已处理</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$withdraws->links()}}
                </div>
                <!-- END Default Table -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.check').on('click',function () {
                if (confirm('确定要设置为已处理吗?')){
                    var id = $(this).attr('id');
                    console.log(id);
                    $.post('/index.php/admin/withdraw/status', {
                        'id'  : id,
                        'is_handle' : 1,
                        '_token' : '{{csrf_token()}}'
                    },function (ret) {
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