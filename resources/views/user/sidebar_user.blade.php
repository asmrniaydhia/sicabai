<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ae8267; background-image: linear-gradient(180deg, #c68a35 10%, #cc3737 100%); background-size: cover;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo Sicabai" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-2">MotoBengkel</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('/dashboard') || request()->is('dashboard')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'user' ? route('dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">IDENTIFIKASI</div>

    <!-- Add additional sidebar items as needed -->

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('/edukasi') || request()->is('edukasi')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'user' ? route('edukasi') : route('edukasi') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Edukasi</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('/diagnosa') || request()->is('diagnosa')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'user' ? route('diagnosa') : route('diagnosa') }}">
            <i class="fas fa-stethoscope"></i>
            <span>Diagnosa</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('/riwayat') || request()->is('riwayat')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'user' ? route('riwayat') : route('riwayat') }}">
            <i class="fas fa-book"></i>
            <span>Riwayat</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
