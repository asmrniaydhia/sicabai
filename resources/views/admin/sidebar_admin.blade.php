<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ae8267; background-image: linear-gradient(180deg, #c68a35 10%, #cc3737 100%); background-size: cover;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo Sicabai" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-2">MotoBengkel</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('admin/dashboard') || request()->is('dashboard')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">IDENTIFIKASI</div>

    <li class="nav-item {{ (request()->is('admin/user') || request()->is('user')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.user') : route('user') }}">
            <i class="fas fa-fw fa-users"></i>
            <span> Data Akun </span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('admin/bengkel') || request()->is('bengkel')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.bengkel') : route('bengkel') }}">
            <i class="fas fa-tools"></i>
            <span> Data Bengkel </span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('admin/sparepart') || request()->is('sparepart')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.sparepart') : route('sparepart') }}">
            <i class="fas fa-boxes "></i>
            <span>Kategori Sparepart</span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('admin/jasa') || request()->is('sparepart')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'admin' ? route('admin.sparepart') : route('sparepart') }}">
            <i class="fas fa-boxes "></i>
            <span>Kategori Jasa</span>
        </a>
    </li>

    <!-- Add additional sidebar items as needed -->

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
