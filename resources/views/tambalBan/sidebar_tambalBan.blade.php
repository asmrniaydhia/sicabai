<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); background-size: cover; font-family: 'Instrument Sans', sans-serif;">
    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo MotoBengkel" style="height: 40px; border-radius: 10px;">
        </div>
        <div class="sidebar-brand-text mx-2">MotoBengkel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Dashboard Item -->
    <li class="nav-item {{ request()->is('tambalBan/dashboard') || request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('tambalBan.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt me-2" style="color: {{ request()->is('tambalBan/dashboard') || request()->is('dashboard') ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Sidebar Heading -->
    <div class="sidebar-heading text-light text-uppercase" style="font-size: 0.85rem; opacity: 0.8;">Data Master</div>

    <!-- Jasa Service Item -->
    <li class="nav-item {{ request()->is('tambalBan/jasa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('tambalBan.jasa') : route('jasa') }}">
            <i class="fas fa-fw fa-cogs me-2" style="color: {{ request()->is('tambalBan/jasa') ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Jasa Service</span>
        </a>
    </li>

    <!-- Rating dan Ulasan Item -->
    <li class="nav-item {{ request()->is('tambalBan/ratings') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tambalBan.ratings') }}">
            <i class="fas fa-fw fa-star me-2" style="color: {{ request()->is('tambalBan/ratings') ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Rating dan Ulasan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">
</ul>

<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        min-height: 100vh;
        transition: all 0.3s ease;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar Brand */
    .sidebar-brand {
        padding: 1.25rem 0;
        transition: all 0.3s ease;
    }

    .sidebar-brand:hover {
        transform: translateY(-2px);
    }

    .sidebar-brand-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    /* Nav Item */
    .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-item .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .nav-item.active .nav-link {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-item .nav-link i {
        transition: color 0.3s ease;
    }

    .nav-item .nav-link:hover i {
        color: #fff;
    }

    /* Sidebar Heading */
    .sidebar-heading {
        padding: 0.75rem 1.25rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
    }

    /* Divider */
    .sidebar-divider {
        margin: 0.5rem 1rem;
        border-width: 1px;
    }
</style>