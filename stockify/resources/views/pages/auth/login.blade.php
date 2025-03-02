<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stockify | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page ">
<div class="login-box">
  <div class="login-logo">
    <a href="https://www.instagram.com/cakwlive"><b>Surya Stockify</b>V1.0</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @if(session('success'))
        <div class="alert alert-success text-center">
          {{ session('success') }}
        </div>
      @endif
      <p class="login-box-msg">Sign in to start</p>

      <form action="/login" method="post">
        @csrf
        @method('POST')
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
          <span class="invalid-feedback"> Double check again, please...</span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            <p class="mt- text-center">
              Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Register</a>
            </p>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
     @if(session('error-unauthorized'))
     <script>
        Swal.fire({
            title: "Unauthorized Access",
            text: "{{ session('error-unauthorized') }}",
            icon: "error",
            backdrop: false,  // Prevents background blur and layout shift
            position: "mid",  // Moves alert to the top to avoid covering form
            allowOutsideClick: true,  // Allows clicking outside to close
            allowEscapeKey: true,  // Allows pressing "Esc" to close
            allowEnterKey: true  // Allows pressing "Enter" to close
        });
      </script>
    @endif
    
  </div>
</div>
<!-- /.login-box -->
 

<!-- jQuery -->
<script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
