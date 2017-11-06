
<div class="footer">
    <a href="{{route('home')}}" class="home-page @if($tag == 'home') home-page-hover @endif">首页</a>
    <a href="{{route('subscribes')}}" class="purchase @if($tag == 'subscribes') purchase-hover @endif">认购</a>
    <a href="{{route('carts')}}" class="cart @if($tag == 'cart') cart-hover @endif">购物车</a>
    <a href="{{route('users.profile')}}" class="personal @if($tag == 'personal') personal-hover @endif">我的</a>
</div>
