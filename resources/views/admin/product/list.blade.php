@extends('admin.dashboard')

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="block">
                    <div class="block-header">
                        <div class="block-options">
                            <a href="{{route('admin.product.add')}}" class="btn btn-primary">新增</a>
                        </div>
                        <h3 class="block-title">商品列表</h3>
                    </div>
                    <div class="block-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>价格</th>
                                <th>分类</th>
                                <th>状态</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>
                                        @if($product->status == 1)
                                            <span class="label label-success">已上架</span>
                                        @endif
                                        @if($product->status == 0)
                                            <span class="label label-warning">已下架</span>
                                        @endif
                                    </td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a href="{{url('/admin/product/edit',$product->id)}}" class="btn btn-xs btn-primary">修改</a>

                                        @if($product->status == 0)
                                        <a id="{{$product->id}}" class="btn btn-xs btn-success up">上架</a>
                                        @endif

                                        @if($product->status == 1)
                                        <a id="{{$product->id}}" class="btn btn-xs btn-warning down">下架</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$products->links()}}
                </div>
                <!-- END Default Table -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(function () {
            $('.up').on('click',function () {
                if (confirm('确定要上架吗?')){
                    var id = $(this).attr('id');
                    $.post('/index.php/admin/product/status',{
                        'id' : id,
                        'status' : 1,
                        '_token' : '{{ csrf_token() }}'
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

        $(function () {
            $('.down').on('click',function () {
                if (confirm('确定要下架吗?')){
                    var id = $(this).attr('id');
                    $.post('/index.php/admin/product/status',{
                        'id' : id,
                        'status' : 0,
                        '_token' : '{{ csrf_token() }}'
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