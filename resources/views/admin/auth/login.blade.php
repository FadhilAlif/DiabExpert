<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('dist/img/DiabExpert-Logo.png') }}" type="image/x-icon">
  <title>DiabExpert | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition login-page bg-light">
  @include('sweetalert::alert')

  <!-- Centered Login Box -->
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4 rounded shadow-lg login-box" style="width: 400px; background: white;">
      <!-- Logo -->
      <div class="mb-4 text-center login-logo">
        <img src="/dist/img/DiabExpert-Logo.png" alt="DiabExpert Logo" class="mb-3" style="width: 64px; height: 64px; object-fit: cover;">
        <h2 class="text-primary">Admin <b>DiabExpert</b></h2>
      </div>
      
      <div class="border-0 card">
        <div class="card-body">
          <p class="text-center login-box-msg text-dark" style="font-size: 16px;">Sign in to start your session</p>

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
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" style="font-size: 14px;">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" style="font-size: 14px;">
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Login Button -->
            <div class="text-center form-group">
              <button type="submit" class="btn btn-primary btn-block" style="font-size: 16px; padding: 10px;">Sign In</button>
            </div>
          </form>

          <!-- Footer -->
          <div class="text-center mt-3" style="font-size: 14px; color: #888;">
            <p>&copy; 2025 DiabExpert. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
