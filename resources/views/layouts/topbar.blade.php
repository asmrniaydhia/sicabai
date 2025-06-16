<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white shadow-sm py-3" style="z-index: 1030;">
    <div class="container-fluid">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3" type="button">
            <i class="fa fa-bars text-dark"></i>
        </button>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ms-auto align-items-center">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="me-2 d-none d-lg-inline text-dark fw-medium">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle" src="{{ asset('images/undraw_profile.svg') }}" style="width: 30px; height: 30px;">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-end shadow" style="z-index: 1031;" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                        {{ __('Profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-start" style="background: none; border: none;">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- End of Topbar -->