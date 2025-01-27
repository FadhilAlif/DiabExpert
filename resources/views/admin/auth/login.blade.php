<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEM PAKAR | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition login-page bg-gradient-primary">
  @include('sweetalert::alert')
  
  <!-- Centered Login Box -->
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4 rounded shadow-lg login-box">
      <!-- Logo -->
      <div class="mb-4 text-center login-logo">
        <h1 class="text-primary"><b>Admin</b> Sistem Pakar</h1>
      </div>
      
      <div class="border-0 card">
        <div class="card-body">
          <p class="text-center login-box-msg text-primary">Sign in to start your session</p>

          <!-- Error Message -->
          @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
          </div>
          @endif

          <!-- Login Form -->
          <form action="/login" method="post">
            @csrf

            <!-- Email Input -->
            <div class="form-group">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Login Button -->
            <div class="text-center form-group">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
