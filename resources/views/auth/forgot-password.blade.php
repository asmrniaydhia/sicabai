<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .form-control:focus {
            border-color: #D2D0A0;
            box-shadow: 0 0 0 0.2rem rgba(198, 197, 164, 0.25);
        }
    </style>
</head>

<body style="background-color: #67AE6E; background-image: linear-gradient(180deg, #67AE6E 10%, #328E6E 100%); background-size: cover;">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Logo di kiri -->

                            <div class="col-lg-6 d-none d-lg-block bg-login-image text-center align-content-center">
                                <img src="{{ asset('images/logo-sicabai.png') }}" alt="Logo Sicabai" class="img-fluid" style="max-width: 400px; margin-left: 40px">
                            </div>
                            
                            <!-- Form di kanan -->
                            <div class="col-lg-6 align-content-center">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Lupa Kata Sandi?</h1>
                                    </div>

                                    <!-- Form Forgot Password -->
                                    <form method="POST" action="{{ route('password.email') }}" class="user">
                                        @csrf

                                        <!-- Input Email -->
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" 
                                                   id="email" name="email" value="{{ old('email') }}" 
                                                   placeholder="Masukkan Alamat Email" required autofocus>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Tombol Kirim Link Reset -->
                                        <button type="submit" class="btn btn-user btn-block" style="background-color: #328E6E; color:white">
                                            Kirim Link Reset Kata Sandi
                                        </button>
                                    </form>
                                    <!-- End of Form Forgot Password -->

                                    <hr>
                                    <div class="text-center">
                                        <p class="small">Ingat kata sandi Anda? <a href="{{ route('login') }}" style="color: #BF9264; font-weight: 700">Masuk</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
