<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DiabExpert</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .hero-section {
            background: url('/dist/img/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 80px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            opacity: 0.8;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .hero-section p {
            font-size: 1.25rem;
        }
        .feature-card {
            border: none;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 18px rgba(0,0,0,0.1);
        }
        .feature-card .icon {
            font-size: 3rem;
            color: #007bff;
        }
        .cta-buttons .btn {
            font-size: 1.25rem;
            padding: 12px 25px;
            border-radius: 25px;
        }
        .cta-buttons .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .cta-buttons .btn-primary:hover {
            background-color: #0056b3;
        }
        .cta-buttons .btn-secondary {
            background-color: #28a745;
            border: none;
        }
        .cta-buttons .btn-secondary:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di <span class="text-warning">DiabExpert</span></h1>
            <p class="lead mt-3">Sistem Pakar untuk Membantu Diagnosa Diabetes Mellitus dengan Cepat dan Akurat</p>
            <div class="cta-buttons mt-4">
                <a href="/diagnosa" class="btn btn-primary btn-lg mx-3">Mulai Diagnosa</a>
                <a href="/login" class="btn btn-secondary btn-lg mx-3">Login Admin</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih DiabExpert?</h2>
            <p class="text-muted">Kami hadir untuk memberikan solusi kesehatan terbaik dalam diagnosa diabetes.</p>
        </div>
        <div class="row text-center">
            <!-- Feature 1 -->
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-laptop-medical icon"></i>
                    <h4 class="mt-3">Akurat & Cepat</h4>
                    <p>DiabExpert memberikan hasil diagnosa yang cepat dan akurat untuk membantu Anda mengambil langkah perawatan terbaik.</p>
                </div>
            </div>
            <!-- Feature 2 -->
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-users-cog icon"></i>
                    <h4 class="mt-3">Mudah Digunakan</h4>
                    <p>DiabExpert dirancang agar mudah digunakan oleh siapa saja, baik pengguna biasa maupun profesional medis.</p>
                </div>
            </div>
            <!-- Feature 3 -->
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-shield-alt icon"></i>
                    <h4 class="mt-3">Keamanan Terjamin</h4>
                    <p>Data pribadi Anda aman dengan sistem enkripsi dan perlindungan data yang ketat di setiap tahap diagnosa.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-3">
        <p>Copyright &copy; 2025 <a href="/diagnosa">DiabExpert</a>. All rights reserved. Built by <a href="https://github.com/FadhilAlif" target="_blank">Fadhil Alif</a>.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
