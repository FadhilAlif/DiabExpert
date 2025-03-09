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

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand-logo {
            height: 32px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .navbar-brand-logo {
            transform: scale(1.05);
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.85)),
                        url('/dist/img/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            padding: 100px 0;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .cta-button {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary {
            background-color: #fff;
            color: #2563eb;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1e40af;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: transparent;
            border: 2px solid #fff;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #1e40af;
            border-color: #1e40af;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        /* Styling khusus untuk tombol di navbar */
        .navbar .btn-primary {
            background-color: #2563eb;
            color: #fff;
            padding: 10px 25px;
        }

        .navbar .btn-primary:hover {
            background-color: #1e40af;
            color: #fff;
            transform: translateY(-2px);
        }

        .features-section {
            padding: 100px 0;
            background-color: #f8fafc;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background-color: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
        }

        .feature-icon i {
            font-size: 2rem;
            color: #fff;
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

        .stats-section {
            padding: 80px 0;
            background-color: #2563eb;
            color: #fff;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        footer {
            background-color: #1e293b;
            color: #fff;
            padding: 30px 0;
        }

        footer a {
            color: #60a5fa;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #93c5fd;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .navbar-brand-logo {
                height: 32px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('dist/img/DiabExpert-Logo.png') }}" alt="DiabExpert Logo" class="navbar-brand-logo">
                <span>DiabExpert</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#stats">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/diagnosa">Mulai Diagnosa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center text-white" data-aos="fade-up">
                <h1 class="hero-title">Diagnosa Diabetes dengan <span class="text-warning">Cerdas & Akurat</span></h1>
                <p class="hero-subtitle">DiabExpert menggunakan kecerdasan buatan untuk membantu Anda mendiagnosa diabetes mellitus dengan cepat dan akurat.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="/diagnosa" class="btn btn-primary cta-button">Mulai Diagnosa</a>
                    <a href="/login" class="btn btn-secondary cta-button">Login Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Mengapa Memilih DiabExpert?</h2>
                <p class="section-subtitle">Aplikasi ini dirancang khusus untuk membantu Anda mendiagnosa diabetes mellitus dengan murah, cepat, dapat diakses dimanapun dan kapanpun.</p>
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

    <!-- Stats Section -->
    <section id="stats" class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Tingkat Akurasi</div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Pengguna Aktif</div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Dukungan Sistem</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">Copyright &copy; 2025 <a href="/">DiabExpert</a>. All rights reserved. Built by <a href="https://github.com/FadhilAlif" target="_blank">Fadhil Alif</a>.</p>
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
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
            } else {
                navbar.style.padding = '20px 0';
            }
        });
    </script>
</body>
</html>
