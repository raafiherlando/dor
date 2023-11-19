<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('obat.index') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-mortar-pestle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem Informasi Apotek</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item @yield('obat')">
        <a class="nav-link" href="{{ route('obat.index') }}">
            <i class="fas fa-fw fa-solid fa-pills"></i>
            <span>Data Obat</span></a>
    </li>

    @if (Auth::user()->is_admin)
    <li class="nav-item @yield('user')">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-solid fa-user"></i>
            <span>Data User</span></a>
    </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
