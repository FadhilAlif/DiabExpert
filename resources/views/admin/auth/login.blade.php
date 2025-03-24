<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('dist/img/DiabExpert-Logo.png') }}" type="image/x-icon">
    <title>DiabExpert | Login Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif; background: linear-gradient(45deg, rgba(37, 99, 235, 0.1), rgba(29, 78, 216, 0.05));">
    @include('sweetalert::alert')

    <!-- Back to Home Button -->
    <a href="/" class="position-absolute text-decoration-none d-flex align-items-center gap-2 m-4 text-dark">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <!-- Login Container -->
    <div class="min-vh-100 d-flex justify-content-center align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <!-- Login Card -->
                    <div class="bg-white rounded-4 shadow-lg p-4 p-md-5" style="backdrop-filter: blur(10px);">
                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <img src="/dist/img/DiabExpert-Logo.png" alt="DiabExpert Logo" 
                                 class="mb-4" 
                                 style="width: 80px; height: auto; transition: transform 0.3s ease;">
                            <h3 class="fw-bold text-primary mb-2">Admin DiabExpert</h3>
                            <p class="text-muted mb-0">Masuk untuk mengelola sistem</p>
                        </div>

                        <!-- Error Message -->
                        @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('loginError') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Login Form -->
                        <form action="/login" method="post">
                            @csrf
                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-dark fw-medium mb-2">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email
                                </label>
                                <div class="input-group">
                                    <input type="email" 
                                           id="email"
                                           name="email" 
                                           class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" 
                                           placeholder="Masukkan email Anda"
                                           style="border-radius: 12px;">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-dark fw-medium mb-2">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           id="password"
                                           name="password" 
                                           class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" 
                                           placeholder="Masukkan password Anda"
                                           style="border-radius: 12px;">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" 
                                        class="btn btn-primary btn-lg fw-medium"
                                        style="border-radius: 12px; background: linear-gradient(45deg, #2563eb, #1d4ed8); transition: all 0.3s ease;">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                </button>
                            </div>
                        </form>

                        <!-- Footer -->
                        <div class="text-center">
                            <p class="text-muted mb-0" style="font-size: 14px;">
                                &copy; 2025 DiabExpert. All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Hover effect untuk logo
        const logo = document.querySelector('img');
        logo.addEventListener('mouseover', () => {
            logo.style.transform = 'scale(1.1)';
        });
        logo.addEventListener('mouseout', () => {
            logo.style.transform = 'scale(1)';
        });

        // Hover effect untuk tombol login
        const loginBtn = document.querySelector('button[type="submit"]');
        loginBtn.addEventListener('mouseover', () => {
            loginBtn.style.transform = 'translateY(-2px)';
            loginBtn.style.boxShadow = '0 10px 20px rgba(37, 99, 235, 0.2)';
        });
        loginBtn.addEventListener('mouseout', () => {
            loginBtn.style.transform = 'translateY(0)';
            loginBtn.style.boxShadow = 'none';
        });
    </script>
</body>
</html>
