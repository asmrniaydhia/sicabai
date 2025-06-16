<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%);">
    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('bengkelService.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo MotoBengkel" style="height: 45px;">
        </div>
        <div class="sidebar-brand-text mx-2" style="font-family: 'Instrument Sans', sans-serif; font-weight: 600;">MotoBengkel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('bengkelService/dashboard') || request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('bengkelService.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Sidebar Heading -->
    <div class="sidebar-heading text-white opacity-75" style="font-size: 0.9rem; font-weight: 500;">
        Menu Bengkel
    </div>

    <!-- Nav Item - Kelola Toko -->
    <li class="nav-item {{ request()->is('barang/create') || request()->is('barang/create*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('barang.create') : route('barang') }}">
            <i class="fas fa-fw fa-tools"></i>
            <span>Kelola Toko</span>
        </a>
    </li>
</ul>

<style>
    .sidebar {
        width: 250px;
        min-height: 100vh;
        font-family: 'Instrument Sans', sans-serif;
    }

    .sidebar-brand-text {
        color: white;
        font-size: 1.2rem;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        transition: all 0.3s ease;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin: 0 0.5rem;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: white !important;
        transform: translateX(5px);
    }

    .nav-link i {
        margin-right: 0.75rem;
    }

    .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.25);
        color: white !important;
        font-weight: 600;
    }

    .sidebar-divider {
        border-width: 1px;
    }

    .sidebar-heading {
        padding: 0.75rem 1.5rem;
        color: rgba(255, 255, 255, 0.7);
    }
</style>