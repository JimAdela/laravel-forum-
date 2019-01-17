<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/jquery.Jcrop.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.js"></script>
    {{-- <script src="/js/bootstrap.min.js"></script> --}}
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.Jcrop.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <meta id="token" name="token" value="{{csrf_token()}}">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Laravel App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">首页</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
              <li class="dropdown">
                <a aria-haspopup="true" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle" role="button" href="#" id="dLable">{{Auth::user()->name }}</a>
                <ul class="dropdown-menu" aria-labelledby="dLable">
                  <li><a href="/user/avatar"><i class="fa fa-user"></i> 更换头像</a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> 更换密码</a></li>
                  <li><a href="#"><i class="fa fa-heart"></i> 特别感谢</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/logout"><i class="fa fa-sign-out"></i> 退出登陆</a></li>
                </ul>
              </li>
              <li><img src="{{Auth::user()->avatar}}" class="img-object img-circle" style="width:64px;height:64px;"></li>
            @else
              <li><a href="user/login/">登陆</a></li>
              <li><a href="/user/register">注册</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    @yield('content')
    
</body>
</html>