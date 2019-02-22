<nav>
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
        <dt><span class="icon board"></span>管理员管理</dt>
        <dd>
            <a href="{{route('admins.create')}}">-&emsp;添加管理员</a>
            <a href="">-&emsp;管理员列表</a>
        </dd>
        <dt><span class="icon board"></span>分类管理</dt>
        <dd>
            <a href="{{route('shopCategories.create')}}">-&emsp;添加分类</a>
            <a href="{{route('shopCategories.index')}}">-&emsp;分类列表</a>
        </dd>
        <dt><span class="icon news"></span>商家管理</dt>
        <dd>
            <a href="{{route('shops.index')}}">-&emsp;商家列表</a>
            <a href="{{route('shops.create')}}">-&emsp;添加商家</a>
        </dd>
        <dt><span class="icon pro"></span>商家账户管理</dt>
        <dd>
            <a href="{{route('shopUsers.index')}}">-&emsp;商家账户列表</a>

        </dd>
        <dt><span class="icon book"></span>消费记录</dt>
        <dd>
            <a href="index.php?p=Admin&c=Histories&a=index">-&emsp;消费记录</a>
        </dd>
        <dt><span class="icon flink"></span>套餐管理</dt>
        <dd>
            <a href="index.php?p=Admin&c=Package&a=add">-&emsp;添加套餐</a>
            <a href="index.php?p=Admin&c=Package&a=index">-&emsp;套餐列表</a>
        </dd>
        <dt><span class="icon admin"></span>代金券</dt>
        <dd>
            <a href="index.php?p=Admin&c=Voucher&a=add">-&emsp;添加代金券</a>
            <a href="index.php?p=Admin&c=Voucher&a=index">-&emsp;代金券列表</a>
        </dd>
        <dt><span class="icon admin"></span>预约管理</dt>
        <dd>
            <a href="index.php?p=Admin&c=Order&a=index">-&emsp;预约列表</a>
            <!--<a href="index.php?p=Admin&c=Voucher&a=index">-&emsp;代金券列表</a>-->
        </dd>
        <dt><span class="icon admin"></span>活动管理</dt>
        <dd>
            <a href="index.php?p=Admin&c=Activity&a=add">-&emsp;添加活动</a>
            <a href="index.php?p=Admin&c=Activity&a=index">-&emsp;活动列表</a>
        </dd>
        <dt><span class="icon admin"></span>排行榜</dt>
        <dd>
            <a href="index.php?p=Admin&c=Ranking&a=add">-&emsp;充值排行榜</a>
            <a href="index.php?p=Admin&c=Ranking&a=service">-&emsp;消费排行榜</a>
            <a href="index.php?p=Admin&c=Ranking&a=Admin">-&emsp;服务排行榜</a>
        </dd>
        <dt><span class="icon admin"></span>充值规则</dt>
        <dd>
            <a href="index.php?p=Admin&c=Rules&a=add">-&emsp;添加充值规则</a>
            <a href="index.php?p=Admin&c=Rules&a=index">-&emsp;充值规则列表</a>
        </dd>
        <dt><span class="icon admin"></span>VIP等级</dt>
        <dd>
            <a href="index.php?p=Admin&c=Vip&a=add">-&emsp;添加VIP等级</a>
            <a href="index.php?p=Admin&c=Vip&a=index">-&emsp;VIP等级列表</a>
        </dd>

    </dl>
</nav>