<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MotoBengkel') }}</title>

    <!-- Google Fonts - Instrument Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #dee2e6 100%);
            min-height: 100vh;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1 0 auto;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @if(Auth::user()->usertype == 'admin')
            @include('admin.sidebar_admin')
        @elseif(Auth::user()->usertype == 'bengkel')
            @if (Auth::user()->bengkel)
                @if (Auth::user()->bengkel->jenis_bengkel === 'service')
                    @include('bengkelService.sidebar_bengkelService')
                @elseif (Auth::user()->bengkel->jenis_bengkel === 'tambal_ban')
                    @include('tambalBan.sidebar_tambalBan')
                @endif
            @endif
        @endif

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.topbar') <!-- Topbar -->

                <main>
                    @yield('content')
                </main>
            </div>

            @include('layouts.footer') <!-- Footer -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SB Admin 2 Scripts -->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
    @yield('scripts')
</body>
</html>