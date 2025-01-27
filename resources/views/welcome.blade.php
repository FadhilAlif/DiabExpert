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
</head>

{{-- DiabExpert Landing Page --}}
<body>
    <div>
        <!-- Hero Section -->
        <div class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold">Selamat Datang di <span class="text-warning">DiabExpert</span></h1>
                <p class="lead mt-3">Sistem Pakar untuk Membantu Diagnosa Diabetes Mellitus secara Akurat dan Cepat</p>
                <a href="/login" class="btn btn-warning btn-lg mt-4 px-5">Mulai Sekarang</a>
            </div>
        </div>

        <!-- Features Section -->
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa Memilih DiabExpert?</h2>
                <p class="text-muted">Kami hadir untuk memberikan solusi kesehatan terbaik dalam diagnosa diabetes.</p>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 shadow rounded">
                        <i class="fas fa-stethoscope fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Akurat</h5>
                        <p class="text-muted">Analisis berbasis data terkini dengan tingkat akurasi tinggi.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 shadow rounded">
                        <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Cepat</h5>
                        <p class="text-muted">Hasil diagnosa dalam detik saja tanpa menunggu lama.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 shadow rounded">
                        <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Aman</h5>
                        <p class="text-muted">Privasi data Anda terjamin dengan sistem keamanan terbaik.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="/dist/img/Diabetes-1.jpg" alt="Tentang Kami" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-bold">Tentang DiabExpert</h3>
                        <p class="text-muted mt-4">
                            DiabExpert adalah platform berbasis sistem pakar untuk membantu diagnosa diabetes mellitus secara akurat dan efisien. Kami menggabungkan teknologi terkini dengan data medis terpercaya untuk memberikan pengalaman terbaik bagi pengguna.
                        </p>
                        <a href="/about" class="btn btn-outline-primary mt-3">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-primary text-white text-center py-5">
            <div class="container">
                <h2 class="fw-bold">Siap untuk Memulai?</h2>
                <p class="lead mt-3">Jangan tunda lagi, mulai perjalanan Anda menuju kesehatan yang lebih baik bersama DiabExpert.</p>
                <a href="/register" class="btn btn-warning btn-lg mt-4 px-5">Daftar Sekarang</a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-0">&copy; 2025 DiabExpert. Semua Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>