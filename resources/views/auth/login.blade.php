<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Google Fonts - Menggunakan Instrument Sans untuk konsistensi -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:200,300,400,500,600,700,800,900" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
            min-height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            background: white;
        }

        .logo-section {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .logo-section img {
            max-width: 280px;
            filter: brightness(1.1);
        }

        .form-section {
            padding: 3rem 2.5rem;
            background: linear-gradient(135deg, #d9534f 0%, #c73e3e 100%);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Instrument Sans', sans-serif;
        }

        .form-control:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
            outline: none;
        }

        .btn-login {
            background: white;
            border: none;
            border-radius: 10px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: #d9534f;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            color: #c73e3e;
        }

        .form-check-input:checked {
            background-color: #ffffff; 
            border-color: #ffffff; 
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e"); /* Warna centang hitam */
        }

        .form-check-input:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }

        .brand-title {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-text {
            color: #f8f9fa;
            font-weight: 400;
            margin-bottom: 2rem;
        }

        .register-link {
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }

        .form-label {
            font-weight: 500;
            color: #f8f9fa;
            margin-bottom: 0.5rem;
        }

        .error-message {
            color: #ffffff;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 py-4">
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-10">
                <div class="login-card">
                    <div class="row g-0">
                        <!-- Logo Section -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="logo-section h-100">
                                <div class="text-center">
                                    <img src="{{ asset('images/lg_tanpanama.png') }}" alt="MotoBengkel Logo" class="img-fluid">
                                    <h3 class="text-dark mt-3 fw-bold">MotoBengkel</h3>
                                    <p class="text-dark-50">Solusi Bengkel Motor Anda</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Section -->
                        <div class="col-lg-6">
                            <div class="form-section">
                                <div class="text-center mb-4">
                                    <h2 class="brand-title">Selamat Datang Kembali!</h2>
                                    <p class="welcome-text">Silakan masuk ke akun Anda</p>
                                </div>

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="Masukkan email Anda"
                                               required 
                                               autofocus>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Masukkan kata sandi"
                                               required>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me Checkbox -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   name="remember" 
                                                   id="remember_me">
                                            <label class="form-check-label" for="remember_me">
                                                Ingat Saya
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Login Button -->
                                    <button type="submit" class="btn btn-login w-100 mb-3">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </button>

                                </form>

                                <hr class="my-4" style="background-color: #ffffff;">
                                
                                <!-- Register Link -->
                                <div class="text-center">
                                    <p class="mb-0">Tidak punya akun? 
                                        <a href="{{ route('register') }}" class="register-link">Daftar Sekarang</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>