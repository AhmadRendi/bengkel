@include('layouts.header')
<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4><i class="fas fa-tachometer-alt me-2"></i>BENGKEL SINAR MOTOR</h4>
    </div>
    <ul class="sidebar-nav nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="#usersSubmenu" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('user.*') ? 'true' : 'false' }}"
                    data-bs-target="#usersSubmenu" id="usersMenuToggle">
                    <i class="fas fa-users"></i>
                    Pengguna
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <ul class="collapse submenu list-group {{ request()->routeIs('user.*') ? 'show' : '' }}" id="usersSubmenu">
                    <li>
                        <a href="{{ route('users') }}"
                            class="list-group-item {{ request()->routeIs('users') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            Semua Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="list-group-item {{ request()->routeIs('register') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            Tambah Pengguna
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="nav-item">
            <a href="#usersSubmenu" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('product.*') ? 'true' : 'false' }}"
                data-bs-target="#productSubMenu" id="produkMenuToggle">
                <i class="fas fa-box"></i>
                Produk
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <ul class="collapse submenu list-group {{ request()->routeIs('product.*') ? 'show' : '' }}"
                id="productSubMenu">
                <li>
                    <a href="{{ route('products') }}"
                        class="list-group-item {{ request()->routeIs('products') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        Semua Produk
                    </a>
                </li>
                @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('add-product') }}"
                            class="list-group-item {{ request()->routeIs('add-product') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            Tambah Produk
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item">
            <a href="#invoiceSubmenu" class="nav-link {{ request()->routeIs('invoice.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('invoice.*') ? 'true' : 'false' }}"
                data-bs-target="#invoiceSubmenu" id="invoiceMenuToggle">
                <i class="fas fa-file-invoice"></i>
                Nota
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <ul class="collapse submenu list-group {{ request()->routeIs('invoice.*') ? 'show' : '' }}"
                id="invoiceSubmenu">
                <li>
                    <a href="{{ route('invoices') }}"
                        class="list-group-item {{ request()->routeIs('invoices') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        Semua Nota
                    </a>
                </li>
                <li>
                    <a href="{{ route('add-invoice') }}"
                        class="list-group-item {{ request()->routeIs('add-invoice') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        Tambah Nota
                    </a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ route('analitik') }}" class="nav-link {{ request()->routeIs('analitik') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analitik</span>
                </a>
            </li>
        @endif
        <li class="nav-item" mt-4>
            <a href="{{ route('logout') }}" class="nav-link {{  request()->routeIs('logout') ? 'active' : '' }}">
                <i class="fas fa-sign-out-alt"></i>
                Keluar
            </a>
        </li>
    </ul>
</nav>