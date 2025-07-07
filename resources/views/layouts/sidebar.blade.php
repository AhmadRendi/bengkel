@include('layouts.header')
<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</h4>
    </div>
    <ul class="sidebar-nav nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#usersSubmenu" class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('pesanan.*') ? 'true' : 'false' }}"
                data-bs-target="#usersSubmenu" id="usersMenuToggle">
                <i class="fas fa-users"></i>
                Pengguna
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <ul class="collapse submenu list-group {{ request()->routeIs('pesanan.*') ? 'show' : '' }}"
                id="usersSubmenu">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        Semua Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        Tambah Pengguna
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#productSubmenu"
                aria-expanded="false">
                <i class="fas fa-box"></i>
                Produk
                <i class="fas fa-chevron-down float-end"></i>
            </a>
        </li>
        <div class="collapse submenu" id="productSubmenu">
            <a href="{{ route('dashboard') }}" class="list-group-item">
                <i class="fas fa-list"></i>
                Semua Produk
            </a>
            <a href="{{ route('dashboard') }}" class="list-group-item">
                <i class="fas fa-plus"></i>
                Tambah Produk
            </a>
        </div>
        <!-- <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{  request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                Pesanan
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="#analytics">
                <i class="fas fa-chart-bar"></i>
                <span>Analitik</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#reports">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#settings">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        <li class="nav-item" mt-4>
            <a href="{{ route('logout') }}" class="nav-link {{  request()->routeIs('logout') ? 'active' : '' }}">
                <i class="fas fa-sign-out-alt"></i>
                Keluar
            </a>
        </li>
    </ul>
</nav>