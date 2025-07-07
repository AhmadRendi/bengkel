@include('layouts.sidebar')

<!-- Main Content -->
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Dashboard'])

    <!-- Dashboard Content -->
    <div class="container-fluid px-4">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="mb-1">1,234</h3>
                    <p class="text-muted mb-0">Total Pengguna</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon bg-success">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="mb-1">567</h3>
                    <p class="text-muted mb-0">Pesanan Hari Ini</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon bg-warning">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="mb-1">Rp 45.2M</h3>
                    <p class="text-muted mb-0">Pendapatan Bulan Ini</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="stats-icon bg-info">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="mb-1">89</h3>
                    <p class="text-muted mb-0">Produk Aktif</p>
                </div>
            </div>
        </div>
        <!-- Recent Orders Table -->
        <div class="row">
            <div class="col-12">
                <div class="stats-card">
                    <h5 class="mb-3">Pesanan Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-001</td>
                                    <td>Ahmad Wijaya</td>
                                    <td>Laptop Gaming</td>
                                    <td>Rp 15.000.000</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-002</td>
                                    <td>Siti Nurhaliza</td>
                                    <td>Smartphone</td>
                                    <td>Rp 8.500.000</td>
                                    <td><span class="badge bg-warning">Proses</span></td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Budi Santoso</td>
                                    <td>Headphone</td>
                                    <td>Rp 2.500.000</td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Budi Santoso</td>
                                    <td>Headphone</td>
                                    <td>Rp 2.500.000</td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Budi Santoso</td>
                                    <td>Headphone</td>
                                    <td>Rp 2.500.000</td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Budi Santoso</td>
                                    <td>Headphone</td>
                                    <td>Rp 2.500.000</td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Budi Santoso</td>
                                    <td>Headphone</td>
                                    <td>Rp 2.500.000</td>
                                    <td><span class="badge bg-info">Dikirim</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')