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
        <dt><span class="icon board"></span>导航菜单管理</dt>
        <dd>
            <a href="{{route('navs.create')}}">-&emsp;添加菜单</a>
            <a href="{{route('navs.index')}}">-&emsp;菜单列表</a>
        </dd>
        @foreach(\App\Models\Nav::where('pid',0)->get() as $nav)
            <dt><span class="icon board"></span>{{$nav->name}}</dt>
            <dd>
                @foreach(\App\Models\Nav::where('pid',$nav->id)->get() as $n)
                    @can($n->permission->name)
                        <a href="{{$n->url}}">-&emsp;{{$n->name}}</a>
                    @endcan
                @endforeach
            </dd>
        @endforeach
        {{--<dt><span class="icon board"></span>管理员管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('admins.create')}}">-&emsp;添加管理员</a>--}}
        {{--<a href="{{route('admins.index')}}">-&emsp;管理员列表</a>--}}
        {{--</dd>--}}
        {{--<dt><span class="icon board"></span>分类管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('shopCategories.create')}}">-&emsp;添加分类</a>--}}
        {{--<a href="{{route('shopCategories.index')}}">-&emsp;分类列表</a>--}}
        {{--</dd>--}}
        {{--<dt><span class="icon news"></span>商家管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('shops.index')}}">-&emsp;商家列表</a>--}}
        {{--<a href="{{route('shops.create')}}">-&emsp;添加商家</a>--}}
        {{--</dd>--}}
        {{--<dt><span class="icon pro"></span>商家账户管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('shopUsers.index')}}">-&emsp;商家账户列表</a>--}}

        {{--</dd>--}}
        {{--<dt><span class="icon book"></span>活动管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('activities.index')}}">-&emsp;活动列表</a>--}}
        {{--<a href="{{route('activities.create')}}">-&emsp;添加活动</a>--}}
        {{--</dd>--}}
        {{--<dt><span class="icon admin"></span>会员管理</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('members.index')}}">-&emsp;会员列表</a>--}}

        {{--</dd>--}}
        {{--<dt><span class="icon flink"></span>RBAC</dt>--}}
        {{--<dd>--}}
        {{--<a href="{{route('permissions.index')}}">-&emsp;权限列表</a>--}}
        {{--<a href="{{route('permissions.create')}}">-&emsp;添加权限</a>--}}
        {{--<a href="{{route('roles.index')}}">-&emsp;角色列表</a>--}}
        {{--<a href="{{route('roles.create')}}">-&emsp;添加角色</a>--}}
        {{--</dd>--}}


    </dl>
</nav>