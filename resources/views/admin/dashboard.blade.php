@extends('layouts.app')
@section('content')

<style>
    .dashboard-container {
        padding: 20px;
        background: #f8f9fc;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-heading {
        background: linear-gradient(135deg, #d9534f 0%, #c73e3e 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(217, 83, 79, 0.2);
    }

    .page-heading h1 {
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }

    .page-heading p {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 1rem;
    }

    .stats-row, .actions-grid {
        display: grid;
        gap: 15px;
        margin-bottom: 15px;
    }

    .stats-row {
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }

    .actions-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    }

    .stat-card, .quick-actions {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .stat-card {
        position: relative;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: var(--accent-color);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stat-card.primary { --accent-color: #d9534f; }
    .stat-card.success { --accent-color: #1cc88a; }
    .stat-card.info { --accent-color: #36b9cc; }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-info h3 {
        font-size: 0.8rem;
        font-weight: bold;
        color: #5a5c69;
        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 1.6rem;
        font-weight: bold;
        color: #2d3748;
    }

    .stat-icon {
        font-size: 1.8rem;
        opacity: 0.5;
        color: var(--accent-color);
    }

    .quick-actions h3 {
        color: #2d3748;
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        background: linear-gradient(135deg, #d9534f 0%, #c73e3e 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: transform 0.3s, box-shadow 0.3s;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(217, 83, 79, 0.2);
    }

    .action-btn i {
        margin-right: 6px;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .dashboard-container { padding: 10px; }
        .stats-row, .actions-grid { grid-template-columns: 1fr; }
        .page-heading h1 { font-size: 1.4rem; }
    }

    .stat-card, .action-btn {
        animation: slideInUp 0.5s ease-out both;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="dashboard-container">
    <!-- Page Heading -->
    <div class="page-heading">
        <h1>🏠 Dashboard Admin</h1>
        <p>Selamat datang di panel administrasi MotoBengkel</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-row">
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>👥 Total Admin</h3>
                    <div class="stat-number" id="adminCount">{{ $totalAdmins }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
            </div>
        </div>
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>👤 Pengguna</h3>
                    <div class="stat-number" id="userCount">{{ $totalRegularUsers }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="stat-card info">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>🏭 Total Bengkel</h3>
                    <div class="stat-number" id="bengkelCount">{{ $totalBengkels }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-tools"></i></div>
            </div>
        </div>
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>🔧 Sparepart</h3>
                    <div class="stat-number" id="sparepartCount">{{ $totalSpareparts ?? 0 }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-boxes"></i></div>
            </div>
        </div>
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>🛠️ Total Jasa</h3>
                    <div class="stat-number" id="jasaCount">{{ $totalJasa ?? 0 }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-toolbox"></i></div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h3>🚀 Aksi Cepat</h3>
        <div class="actions-grid">
            <a href="{{ route('admin.user') }}" class="action-btn">
                <i class="fas fa-users"></i> Kelola Akun
            </a>
            <a href="{{ route('admin.bengkel') }}" class="action-btn">
                <i class="fas fa-tools"></i> Kelola Bengkel
            </a>
            <a href="{{ route('admin.sparepart') }}" class="action-btn">
                <i class="fas fa-boxes"></i> Kelola Sparepart
            </a>
            <a href="{{ route('admin.jasa') }}" class="action-btn">
                <i class="fas fa-toolbox"></i> Kelola Jasa
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
    }

    const adminCount = document.getElementById('adminCount');
    const userCount = document.getElementById('userCount');
    const bengkelCount = document.getElementById('bengkelCount');
    const sparepartCount = document.getElementById('sparepartCount');
    const jasaCount = document.getElementById('jasaCount');

    if (adminCount) animateValue(adminCount, 0, parseInt(adminCount.textContent), 1000);
    if (userCount) animateValue(userCount, 0, parseInt(userCount.textContent), 1200);
    if (bengkelCount) animateValue(bengkelCount, 0, parseInt(bengkelCount.textContent), 1400);
    if (sparepartCount) animateValue(sparepartCount, 0, parseInt(sparepartCount.textContent), 1600);
    if (jasaCount) animateValue(jasaCount, 0, parseInt(jasaCount.textContent), 1800);

    document.querySelectorAll('.stat-card, .action-btn').forEach(card => {
        card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-5px)');
        card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
    });
});
</script>
@endsection