<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ae8267; background-image: linear-gradient(180deg, #c68a35 10%, #cc3737 100%); background-size: cover;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/lg_tanpanama.png') }}" alt="Logo MotoBengkel" style="height: 40px;">
        </div>
        <div class="sidebar-brand-text mx-2">MotoBengkel</div>
    </a>



    <hr class="sidebar-divider my-0">
    {{-- <li class="nav-item {{ (request()->is('tambalBan/dashboard') || request()->is('dashboard')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('tambalBan.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li> --}}

    <li class="nav-item {{ request()->is('tambalBan/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('tambalBan.dashboard') : route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Data Master</div>

    <!-- Add additional sidebar items as needed -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('tambalBan/jasa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ Auth::user()->usertype == 'bengkel' ? route('tambalBan.jasa') : route('jasa') }}">
            <i class="fas fa-stethoscope"></i>
            <span>Jasa</span>
        </a>
    </li>
</ul>
