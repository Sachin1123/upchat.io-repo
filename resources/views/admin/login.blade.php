<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upchat.io</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <div class="login-logo">
    <img src="{{URL::asset('dist/img/logo.png')}}" alt="Logo" class="brand-image" style="opacity: .8">

    </div>
      <p class="login-box-msg">Sign in to your account</p>
    
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="container btn-danger ">
        <div class="alert alert-solid-success" role="alert">
          <strong>Oh Snap!</strong> {{ $error }}
        </div>
      </div>

      @endforeach
      @endif
				<form method="POST" action="{{ route('login') }}" >
				@csrf	
        <div class="input-group mb-3">
				<input class="form-control" placeholder="Enter your email" type="text" name='email' id='email' required="required" autocomplete='email' autofocus='autofocus' >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
				<input class="form-control" placeholder="Enter your password"  type="password" name="password" id='password' autocomplete="current-password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
    
        <button class="btn btn-block btn-primary">Sign In</button>
          <!-- /.col -->
        
          <!-- /.col -->
        
      </form>

    
      <!-- /.social-auth-links -->

      <p class="mb-1">
       
      </p>
      <p class="mb-0">
        <a href="{{url('register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
