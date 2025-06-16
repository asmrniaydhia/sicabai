<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #d9534f; background-image: linear-gradient(180deg, #d9534f 10%, #c73e3e 100%); background-size: cover; font-family: 'Instrument Sans', sans-serif;">
    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo MotoBengkel" style="height: 40px; border-radius: 10px;">
        </div>
        <div class="sidebar-brand-text mx-2" style="font-family: 'Instrument Sans', sans-serif; font-weight: 600; font-size: 1.25rem; color: #fff; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">MotoBengkel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/dashboard') || request()->is('dashboard')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt me-2" style="color: {{ (request()->is('admin/dashboard') || request()->is('dashboard')) ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Sidebar Heading -->
    <div class="sidebar-heading text-light text-uppercase" style="font-size: 0.85rem; opacity: 0.8; padding: 0.75rem 1.25rem; font-weight: 500;">
        IDENTIFIKASI
    </div>

    <!-- Nav Item - Data Akun -->
    <li class="nav-item {{ (request()->is('admin/user') || request()->is('user')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.user') : route('user') }}">
            <i class="fas fa-fw fa-users me-2" style="color: {{ (request()->is('admin/user') || request()->is('user')) ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Data Akun</span>
        </a>
    </li>

    <!-- Nav Item - Data Bengkel -->
    <li class="nav-item {{ (request()->is('admin/bengkel') || request()->is('bengkel')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.bengkel') : route('bengkel') }}">
            <i class="fas fa-fw fa-tools me-2" style="color: {{ (request()->is('admin/bengkel') || request()->is('bengkel')) ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Data Bengkel</span>
        </a>
    </li>

    <!-- Nav Item - Kategori Sparepart -->
    <li class="nav-item {{ (request()->is('admin/sparepart') || request()->is('sparepart')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.sparepart') : route('sparepart') }}">
            <i class="fas fa-fw fa-boxes me-2" style="color: {{ (request()->is('admin/sparepart') || request()->is('sparepart')) ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Kategori Sparepart</span>
        </a>
    </li>

    <!-- Nav Item - Kategori Jasa -->
    <li class="nav-item {{ (request()->is('admin/jasa') || request()->is('jasa')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.jasa') : route('jasa') }}">
            <i class="fas fa-fw fa-toolbox me-2" style="color: {{ (request()->is('admin/jasa') || request()->is('jasa')) ? '#d9534f' : 'rgba(255, 255, 255, 0.7)' }};"></i>
            <span>Kategori Jasa</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2 d-none d-md-block" style="border-color: rgba(255, 255, 255, 0.3);">

    <!-- Sidebar Toggle -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
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

    /* Sidebar Toggle Button */
    #sidebarToggle {
        width: 2.5rem;
        height: 2.5rem;
        background-color: rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    #sidebarToggle:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
</style>