<div class="content">
    @if(session('status'))
        @if(session('status'))
            <div class="alert alert-success alert-dismissable">
                <h3 class="font-w300 push-15">操作成功</h3>
            </div>
        @endif

        @if(!session('status'))
            <div class="alert alert-danger alert-dismissable">
                <h3 class="font-w300 push-15">操作失败</h3>
            </div>
        @endif
    @endif
    <div class="alert alert-success alert-dismissable hide" id="success-info">
        <h3 class="font-w300 push-15">操作成功</h3>
    </div>
    <div class="alert alert-danger alert-dismissable hide" id="error-info">
        <h3 class="font-w300 push-15">操作失败</h3>
    </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <h3 class="font-w300 push-15">错误信息</h3>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
</div>