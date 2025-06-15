@extends('layouts.app')
@section('content')

<style>
    .dashboard-container {
        padding: 20px;
        background: #f8f9fc;
        min-height: 100vh;
    }

    .page-heading {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    }

    .page-heading h1 {
        font-size: 2.2rem;
        font-weight: bold;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .page-heading p {
        margin: 8px 0 0 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-color);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .stat-card.primary {
        --accent-color: #4e73df;
    }

    .stat-card.success {
        --accent-color: #1cc88a;
    }

    .stat-card.info {
        --accent-color: #36b9cc;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-info h3 {
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #5a5c69;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: bold;
        color: #2d3748;
        margin: 0;
    }

    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.3;
        color: var(--accent-color);
    }

    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .quick-actions h3 {
        color: #2d3748;
        margin-bottom: 20px;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        padding: 18px 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 1rem;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        text-decoration: none;
        color: white;
    }

    .action-btn i {
        margin-right: 12px;
        font-size: 1.3rem;
    }

    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }

    .recent-activity h3 {
        color: #2d3748;
        margin-bottom: 20px;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e3e6f0;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 18px;
        font-size: 1.2rem;
    }

    .activity-icon.success {
        background: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
    }

    .activity-icon.primary {
        background: rgba(78, 115, 223, 0.1);
        color: #4e73df;
    }

    .activity-icon.warning {
        background: rgba(246, 194, 62, 0.1);
        color: #f6c23e;
    }

    .activity-text {
        flex: 1;
    }

    .activity-text p {
        margin: 0;
        color: #5a5c69;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #858796;
        margin-top: 3px;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }
        
        .stats-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .actions-grid {
            grid-template-columns: 1fr;
        }
        
        .page-heading h1 {
            font-size: 1.8rem;
        }
    }

    /* Animation */
    .stat-card {
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        <!-- Total Admins -->
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>👥 Total Admin</h3>
                    <div class="stat-number" id="adminCount">{{ $totalAdmins }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>

        <!-- Regular Users -->
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>👤 Pengguna</h3>
                    <div class="stat-number" id="userCount">{{ $totalRegularUsers }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Total Spareparts -->
        <div class="stat-card info">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>🔧 Sparepart</h3>
                    <div class="stat-number" id="sparepartCount">{{ $totalSpareparts ?? 0 }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h3>🚀 Aksi Cepat</h3>
        <div class="actions-grid">
            <a href="{{ route('admin.user') }}" class="action-btn">
                <i class="fas fa-users"></i>
                <span>Kelola Akun</span>
            </a>
            <a href="{{ route('admin.bengkel') }}" class="action-btn">
                <i class="fas fa-tools"></i>
                <span>Kelola Bengkel</span>
            </a>
            <a href="{{ route('admin.sparepart') }}" class="action-btn">
                <i class="fas fa-boxes"></i>
                <span>Kelola Sparepart</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h3>📋 Aktivitas Terbaru</h3>
        <div class="activity-item">
            <div class="activity-icon success">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-text">
                <p><strong>User baru</strong> telah mendaftar</p>
                <span class="activity-time">2 menit yang lalu</span>
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon primary">
                <i class="fas fa-wrench"></i>
            </div>
            <div class="activity-text">
                <p><strong>Sparepart baru</strong> ditambahkan</p>
                <span class="activity-time">15 menit yang lalu</span>
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon warning">
                <i class="fas fa-tools"></i>
            </div>
            <div class="activity-text">
                <p><strong>Data bengkel</strong> diperbarui</p>
                <span class="activity-time">1 jam yang lalu</span>
            </div>
        </div>
    </div>
</div>

<script>
// Add some interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Animate stat numbers
    const adminCount = document.getElementById('adminCount');
    const userCount = document.getElementById('userCount');
    const sparepartCount = document.getElementById('sparepartCount');

    if (adminCount) {
        const adminTarget = parseInt(adminCount.textContent);
        animateValue(adminCount, 0, adminTarget, 1500);
    }

    if (userCount) {
        const userTarget = parseInt(userCount.textContent);
        animateValue(userCount, 0, userTarget, 2000);
    }

    if (sparepartCount) {
        const sparepartTarget = parseInt(sparepartCount.textContent);
        animateValue(sparepartCount, 0, sparepartTarget, 1800);
    }

    // Add hover effects to cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

@endsection