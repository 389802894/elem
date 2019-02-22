<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>管理员后台管理系统</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <link href="{{\Illuminate\Support\Facades\URL::asset('css/index.css')}}" type="text/css" rel="stylesheet"/>
    <script src="{{\Illuminate\Support\Facades\URL::asset('css/jquery.js')}}"></script>
</head>
<body>
<header>
    <h1>管理员后台管理系统</h1>
    <p>
        <a href="{{route('admins.index')}}"><span class="icon home"></span>系统首页</a>
        @guest
        <a href="{{route('login')}}"></span>登录</a>
        @endguest
        @auth
        <a href="{{route('destroy')}}"><span class="icon quit"></span>注销</a>
        <a href=""><span class="icon quit"></span>修改密码</a>
        @endauth
    </p>

</header>