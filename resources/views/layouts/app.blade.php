<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <style>
        /* Semua CSS dari kode asli Anda ditempatkan di sini */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .dashboard-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: #718096;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-card.healthy {
            --card-color: #10b981;
            --card-color-light: #34d399;
        }

        .stat-card.diseased {
            --card-color: #ef4444;
            --card-color-light: #f87171;
        }

        .stat-card.predicted {
            --card-color: #f59e0b;
            --card-color-light: #fbbf24;
        }

        .stat-card.accuracy {
            --card-color: #3b82f6;
            --card-color-light: #60a5fa;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
            color: white;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #10b981;
            font-weight: 600;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #1a202c;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #718096;
            font-size: 1rem;
            font-weight: 500;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-container {
            height: 350px;
            position: relative;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            border: 2px dashed #cbd5e0;
        }

        .chart-placeholder {
            text-align: center;
            color: #718096;
        }

        .recent-predictions {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .prediction-item {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            margin-bottom: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .prediction-item:hover {
            background: #edf2f7;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .prediction-item.latest {
            border-left: 4px solid #10b981;
            animation: pulse 2s infinite;
        }

        .prediction-image {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin-right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .prediction-details {
            flex: 1;
        }

        .prediction-disease {
            font-weight: 700;
            color: #2d3748;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .prediction-confidence {
            color: #4a5568;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .prediction-time {
            color: #a0aec0;
            font-size: 0.75rem;
        }

        .confidence-bar {
            width: 100%;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .confidence-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #34d399);
            border-radius: 2px;
            transition: width 1s ease;
        }

        .action-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 1.25rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .action-btn.secondary {
            background: linear-gradient(135deg, #10b981, #34d399);
        }

        .action-btn.secondary:hover {
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .action-btn.tertiary {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
        }

        .action-btn.tertiary:hover {
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .action-btn.quaternary {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }

        .action-btn.quaternary:hover {
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        .disease-info {
            background: linear-gradient(135deg, #fef7e0, #fef3c7);
            border: 1px solid #fbbf24;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .disease-info h3 {
            color: #92400e;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .disease-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .disease-item {
            background: rgba(255, 255, 255, 0.7);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #fbbf24;
        }

        .disease-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .disease-name {
            font-weight: 600;
            color: #92400e;
            margin-bottom: 0.25rem;
        }

        .disease-count {
            font-size: 0.875rem;
            color: #a16207;
        }

        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-content {
                padding: 1rem;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            .action-grid {
                grid-template-columns: 1fr;
            }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
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
        {{-- @include('layouts.sidebar') <!-- Sidebar --> --}}

        @if(Auth::user()->usertype == 'admin')
            @include('admin.sidebar_admin')
        @elseif(Auth::user()->usertype == 'user')
            @include('user.sidebar_user')
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
                    {{-- {{ $slot }} <!-- Main content here --> --}}
                    @yield('content')
                </main>
            </div>

            @include('layouts.footer') <!-- Footer -->
        </div>
    </div>

    @yield('scripts')
    <!-- Ensure the JS paths are correct -->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
