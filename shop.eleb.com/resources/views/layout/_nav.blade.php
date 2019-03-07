<nav>
    <h3>欢迎您来到管理后台</h3>
    <style>
        img {
            margin: 15px;
        }

        td {
            text-align: center;
        }

    </style>
    @guest
    <p style="margin-top: 20px; padding-left: 20px;"><a href="{{route('login')}}"><strong>请登录...</strong></a></p>
    @endguest
    @auth
    <p style="margin-top: 20px; padding-left: 20px;">管理员:<strong>{{ auth()->user()->name }}</strong></p>
    @endauth
    <dl>
        <dt><span class="icon board"></span>商家</dt>
        <dd>
            <a href="{{route('shopUsers.create')}}">-&emsp;商家注册</a>
            <a href="{{route('activities.index')}}">-&emsp;活动列表</a>
        </dd>
        <dt><span class="icon board"></span>菜品分类管理</dt>
        <dd>
            <a href="{{route('menuCategories.index')}}">-&emsp;菜品分类列表</a>
            <a href="{{route('menuCategories.create')}}">-&emsp;添加菜品分类</a>
        </dd>
        <dt><span class="icon board"></span>菜品管理</dt>
        <dd>
            <a href="{{route('menus.index')}}">-&emsp;菜品列表</a>
            <a href="{{route('menus.create')}}">-&emsp;添加菜品</a>
        </dd>
        <dt><span class="icon board"></span>订单管理</dt>
        <dd>
            <a href="{{route('orders.index')}}">-&emsp;订单列表</a>
            <a href="{{route('tongji_week')}}">-&emsp;最近一周订单统计</a>
            <a href="{{route('tongji_month')}}">-&emsp;最三个月订单统计</a>
            <a href="{{route('menu_week')}}">-&emsp;最近一周菜品订单统计</a>
            <a href="{{route('menu_month')}}">-&emsp;最三个月菜品订单统计</a>
        </dd>
    </dl>
</nav>