<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PTTME RCM Software</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/css/ionicons.min.css') }}">
  <link href="{{ asset('public/dist/css/AdminLTE.css') }}" rel="stylesheet">
  <link href="{{ asset('public/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/login/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/login/assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('public/fonts/stylesheet.css') }}">
  <!--[if lt IE 9]>
  <script type="text/javascript" src="{{ asset('public/js/html5shiv.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/js/respond.min.js') }}"></script>
  <![endif]-->
  <style type="text/css">
    .navbar-inverse.navbar{
      background-color:#03A9F4;
    }
    .profile-img
    {
      height: 96px;
      margin: 0 auto 10px;
      display: block;
      -moz-border-radius: 50%;
      -webkit-border-radius: 50%;
      border-radius: 50%;
    }
    .error {
      color: #ff0000;
      position:block;
    }

    html, body {
      height: 100%;
      font-size:16px;
    }
    .navbar-inverse .navbar-nav>li>a {
      color:#fff;
    }
    .navbar-inverse .navbar-brand {
      color:#fff;
    }
  </style>

</head>
<body class="image-background">
<div class="navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./" >PTTME RCM Software</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="guideline">Guideline</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
<div class="login-box">
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="section">
    <div class="box">
      <div class="box-logo animated flash">
        <img src="{{ asset('public/login/assets/img/pttme.png') }}" alt="" class="profile-img" />
      </div>
      <hr>
      <div class="login-box-body">
        @yield('content')
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>