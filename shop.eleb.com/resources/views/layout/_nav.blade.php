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
            <a href="">-&emsp;分类列表</a>
        </dd>

    </dl>
</nav>