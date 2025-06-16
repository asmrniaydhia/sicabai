<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MotoBengkel - Solusi Servis Motor Anda</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #f8f9fa;
                padding-top: 70px; /* Menambahkan padding untuk navbar fixed-top */
            }
            /* Style baru untuk Hero Section */
            .hero-section {
                background-color: #ffffff;
                padding: 1rem 0;
            }
            .hero-section .display-4 {
                color: #212529;
            }
            .hero-image {
                max-width: 100%;
                height: auto;
            }
            .navbar-brand {
                font-weight: 700;
            }
            /* Menyesuaikan warna utama dengan warna merah pada logo */
            .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus {
                background-color: #d9534f;
                border-color: #d9534f;
            }
            .btn-outline-primary {
                color: #d9534f;
                border-color: #d9534f;
            }
            .btn-outline-primary:hover {
                background-color: #d9534f;
                color: white;
            }
            .card {
                border: none;
                background-color: #ffffff;
                border-radius: 10px;
                transition: transform 0.3s, box-shadow 0.3s;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            }
            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            }
            .card-icon {
                font-size: 2.5rem;
                color: #d9534f;
                margin-bottom: 1rem;
            }
            .features-section {
                background-color: #f8f9fa;
            }
            .footer {
                background-color: #212529;
                color: white;
            }
        </style>
    </head>
    <body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <!-- Menggunakan teks brand karena logo sudah menjadi hero -->
            <a class="navbar-brand" href="#">
                MotoBengkel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-link btn btn-outline-primary ms-lg-2 px-4 py-2">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-primary ms-lg-3 px-4 py-2">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Kolom untuk Teks -->
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Navigasi Cepat Menuju Bengkel Terpercaya</h1>
                    <p class="lead text-muted mb-4">MotoBengkel menyajikan data lokasi bengkel dalam satu platform. Dirancang untuk mempermudah Anda menemukan bantuan perbaikan kendaraan secara efisien, kapan pun dan di mana pun.</p>
                </div>
                <!-- Kolom untuk Gambar -->
                <div class="col-lg-6">
                    <!-- Pastikan file 'logo sicabai.png' ada di dalam folder 'public/images/' -->
                    <img src="{{ asset('images/motoBengkel.png') }}" alt="Ilustrasi MotoBengkel" class="hero-image d-block mx-auto">
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <main class="py-5 my-4 features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Utama Platform</h2>
                <p class="text-muted">Semua yang Anda butuhkan untuk menemukan bengkel terbaik.</p>
            </div>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body">
                            <div class="card-icon"><i class="fas fa-map-marked-alt"></i></div>
                            <h5 class="card-title fw-bold mb-3">Peta Lokasi Interaktif</h5>
                            <p class="card-text">Lihat sebaran lokasi bengkel dengan peta yang mudah digunakan dan responsif.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body">
                            <div class="card-icon"><i class="fas fa-info-circle"></i></div>
                            <h5 class="card-title fw-bold mb-3">Informasi Bengkel Lengkap</h5>
                            <p class="card-text">Dapatkan info penting seperti alamat, jam buka, dan jenis layanan yang ditawarkan.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4 text-center">
                        <div class="card-body">
                            <div class="card-icon"><i class="fas fa-phone-alt"></i></div>
                            <h5 class="card-title fw-bold mb-3">Hubungi Bengkel Langsung</h5>
                            <p class="card-text">Dapatkan detail kontak untuk bertanya dari platform kami sebelum Anda datang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} MotoBengkel. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
