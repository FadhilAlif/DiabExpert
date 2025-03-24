<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('dist/img/DiabExpert-Logo.png') }}" type="image/x-icon">
    <title>DiabExpert - Sistem Pakar DM</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Animasi untuk Feature Cards */
        .feature-card {
            background-color: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background-color: #2563eb;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background-color: #1d4ed8;
        }

        .feature-icon i {
            font-size: 2rem;
            color: #fff;
        }

        .feature-card:hover .feature-icon i {
            animation: bounce 0.8s ease infinite;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 15px;
        }

        .feature-description {
            color: #64748b;
            line-height: 1.6;
        }

        /* Animasi untuk How It Works Cards */
        .step-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .step-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15) !important;
        }

        .step-card .step-icon {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-card:hover .step-icon {
            transform: scale(1.1);
            background-color: rgba(37, 99, 235, 0.2) !important;
        }

        .step-card:hover .step-number {
            animation: pulse 1s ease infinite;
        }

        .step-card:hover .step-icon i {
            animation: bounce 0.8s ease infinite;
        }

        /* Keyframes untuk animasi */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm" style="backdrop-filter: blur(10px); transition: all 0.3s ease;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-primary fw-bold" href="/">
                <img src="{{ asset('dist/img/DiabExpert-Logo.png') }}" alt="DiabExpert Logo" style="height: 32px; width: auto; transition: transform 0.3s ease;">
                <span>DiabExpert</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#stats">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 py-2" href="/diagnosa" style="transition: all 0.3s ease;">Mulai Diagnosa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.85)), url('/dist/img/hero-bg.jpg') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="text-center text-white mx-auto" style="max-width: 800px;" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-4">Diagnosa Diabetes dengan <span class="text-warning">Cerdas & Akurat</span></h1>
                <p class="fs-5 mb-5 opacity-90">DiabExpert menggunakan kecerdasan buatan untuk membantu Anda mendiagnosa diabetes mellitus dengan cepat dan akurat.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="/diagnosa" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-medium" style="transition: all 0.3s ease;">Mulai Diagnosa</a>
                    <a href="/login" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-medium" style="transition: all 0.3s ease;">Login Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-dark mb-3">Mengapa Memilih DiabExpert?</h2>
                <p class="fs-5 text-muted">Aplikasi ini dirancang khusus untuk membantu Anda mendiagnosa diabetes mellitus dengan murah, cepat, dapat diakses dimanapun dan kapanpun.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="feature-title">Sistem Pakar Cerdas</h3>
                        <p class="feature-description">Menggunakan metode Certainty Factor untuk memberikan hasil diagnosa yang akurat berdasarkan gejala yang Anda alami.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="feature-title">Diagnosa Cepat</h3>
                        <p class="feature-description">Dapatkan hasil diagnosa dalam hitungan menit, membantu Anda mengambil tindakan preventif lebih awal.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Privasi Terjamin</h3>
                        <p class="feature-description">Data Anda dilindungi dengan sistem keamanan tingkat tinggi dan enkripsi end-to-end.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-dark mb-3">Bagaimana Cara Kerjanya?</h2>
                <p class="fs-5 text-muted">Ikuti langkah-langkah sederhana berikut untuk mendapatkan hasil diagnosa diabetes yang akurat</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4 text-center position-relative step-card">
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold step-number" style="width: 30px; height: 30px;">1</div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3 mx-auto mb-4 step-icon">
                            <i class="fas fa-user-edit fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Input Data Diri</h4>
                        <p class="text-muted mb-0">Masukkan data diri Anda seperti umur dan jenis kelamin untuk analisis yang lebih akurat</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4 text-center position-relative step-card">
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold step-number" style="width: 30px; height: 30px;">2</div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3 mx-auto mb-4 step-icon">
                            <i class="fas fa-clipboard-list fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pilih Gejala</h4>
                        <p class="text-muted mb-0">Pilih gejala yang Anda alami dan tentukan tingkat keyakinan untuk setiap gejala</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4 text-center position-relative step-card">
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold step-number" style="width: 30px; height: 30px;">3</div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3 mx-auto mb-4 step-icon">
                            <i class="fas fa-calculator fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Proses Diagnosa</h4>
                        <p class="text-muted mb-0">Sistem akan menganalisis gejala menggunakan metode Certainty Factor</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4 text-center position-relative step-card">
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold step-number" style="width: 30px; height: 30px;">4</div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3 mx-auto mb-4 step-icon">
                            <i class="fas fa-file-medical-alt fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Hasil Diagnosa</h4>
                        <p class="text-muted mb-0">Dapatkan hasil diagnosa lengkap dengan persentase dan saran medis</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <a href="/diagnosa" class="btn btn-primary btn-lg rounded-pill px-5 py-3">
                    <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosa Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-5 bg-primary text-white">
        <div class="container py-4">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0" data-aos="fade-up">
                    <div class="display-4 fw-bold mb-2">98%</div>
                    <div class="fs-5 opacity-75">Tingkat Akurasi</div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="display-4 fw-bold mb-2">15+</div>
                    <div class="fs-5 opacity-75">Gejala Teridentifikasi</div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="display-4 fw-bold mb-2">2</div>
                    <div class="fs-5 opacity-75">Tipe Diabetes</div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="display-4 fw-bold mb-2">24/7</div>
                    <div class="fs-5 opacity-75">Dukungan Sistem</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p class="mb-0">Copyright &copy; 2025 <a href="/" class="text-primary text-decoration-none">DiabExpert</a>. All rights reserved. Built by <a href="https://github.com/FadhilAlif" target="_blank" class="text-primary text-decoration-none">Fadhil Alif</a>.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Smooth scrolling untuk navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.style.padding = window.scrollY > 50 ? '10px 0' : '20px 0';
            navbar.classList.toggle('shadow', window.scrollY > 50);
        });
    </script>
</body>
</html>
