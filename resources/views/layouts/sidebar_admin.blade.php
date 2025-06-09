<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #67AE6E; background-image: linear-gradient(180deg, #67AE6E 10%, #328E6E 100%); background-size: cover;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/simbol-sicabai(1).png') }}" alt="Logo Sicabai" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">SiCabai</div>
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

    <!-- Add additional sidebar items as needed -->

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
