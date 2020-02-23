<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/admin.css")}}" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="introduce-area">
    <div class="introduce" style="background-image:url({{asset('admin/images/admin.png')}});">
      <h1>Admin<span>Panel</span></h1>
      <h6>This session for customize your store!</h6>
    </div>
  </div>

<!-- /.login-logo -->
  <div class="login-box-body">
    <div class="logpadding-box">
      <p class="login-box-msg">Log In</p>
      <img src="{{asset('admin/images/man.png')}}" class="admin-image" alt="Admin Image">
      <form method="POST" action="{{ route('login') }}" aria-label="{{ __('login') }}">
        @csrf
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" min="6" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4 pull-right">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <h4 class="login-slogan">Login to start your session</h4>
  </div>
</div>
</body>
</html>



<?php /* ?>



