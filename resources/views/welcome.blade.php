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
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Hero Section */
        .hero {
            background: url('data:image/jpeg;base64,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') no-repeat center center;
            background-size: cover;
            padding: 100px 0;
            text-align: center;
            color: white;
            height: 100vh;
        }
        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.5rem;
            margin-top: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 30px;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        /* Features Section */
        .feature-icon {
            font-size: 4rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .feature-description {
            color: #777;
        }

        /* Footer Section */
        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Card Image */
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <!-- Landing Page Section -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1>Welcome to DiabExpert</h1>
                    <p>Your trusted tool to diagnose and manage diabetes.</p>
                    <a href="#features" class="btn btn-primary btn-lg mt-4">Start Diagnosis</a>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="container py-5">
                <h2 class="text-center mb-5">Our Features</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <div class="feature-icon">
                            <img src="https://via.placeholder.com/100?text=Icon1" alt="Icon 1">
                        </div>
                        <h3 class="feature-title">Accurate Diagnosis</h3>
                        <p class="feature-description">Get accurate health assessments based on your symptoms and history.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-icon">
                            <img src="https://via.placeholder.com/100?text=Icon2" alt="Icon 2">
                        </div>
                        <h3 class="feature-title">Comprehensive Data</h3>
                        <p class="feature-description">Track your health data and improve your lifestyle for better management.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-icon">
                            <img src="https://via.placeholder.com/100?text=Icon3" alt="Icon 3">
                        </div>
                        <h3 class="feature-title">Health Insights</h3>
                        <p class="feature-description">Understand your health better and receive tailored tips for better outcomes.</p>
                    </div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <section id="cta" class="bg-light py-5">
                <div class="container text-center">
                    <h2>Ready to take control of your health?</h2>
                    <p class="lead">Start diagnosing and managing your health with DiabExpert.</p>
                    <a href="/diagnosa" class="btn btn-primary btn-lg">Start Diagnosis Now</a>
                </div>
            </section>

            <!-- Card Section with Dummy Images -->
            <section class="container py-5">
                <h2 class="text-center mb-5">How It Works</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/400x250?text=Step+1" class="card-img-top" alt="Step 1">
                            <div class="card-body">
                                <h5 class="card-title">Step 1: Input Symptoms</h5>
                                <p class="card-text">Enter your symptoms and medical history to begin your diagnosis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/400x250?text=Step+2" class="card-img-top" alt="Step 2">
                            <div class="card-body">
                                <h5 class="card-title">Step 2: Diagnosis Results</h5>
                                <p class="card-text">Get your diagnosis results and understand your health condition.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/400x250?text=Step+3" class="card-img-top" alt="Step 3">
                            <div class="card-body">
                                <h5 class="card-title">Step 3: Tailored Tips</h5>
                                <p class="card-text">Receive personalized tips to manage and improve your health.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer Section -->
            <section class="footer">
                <p>&copy; 2023 DiabExpert. All rights reserved.</p>
            </section>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
