<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidebar-content">
            <div class="side-header side-content bg-white-op">
                <a class="h5 text-white" href="#">
                    <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">管理后台</span>
                </a>
            </div>

            <div class="side-content">
                <ul class="nav-main">
                    <li>
                        <a href="{{route('admin.product.list')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">商品列表</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.category.list')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">分类列表</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.orders.index')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">订单管理</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.withdraws.index')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">提现申请</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.users.index')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">用户管理</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.subscribes.index')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">认购管理</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.configs.banner')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">BANNER图</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.show.list')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">管理员管理</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.configs.product')}}"><i class="si si-rocket"></i><span class="sidebar-mini-hide">商品配置</span></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>