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
                        <small class="text-success"><i class="fas fa-arrow-up"></i> 12% dari bulan lalu</small>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon bg-success">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3 class="mb-1">567</h3>
                        <p class="text-muted mb-0">Pesanan Hari Ini</p>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> 8% dari kemarin</small>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon bg-warning">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h3 class="mb-1">Rp 45.2M</h3>
                        <p class="text-muted mb-0">Pendapatan Bulan Ini</p>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> 15% dari bulan lalu</small>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon bg-info">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3 class="mb-1">89</h3>
                        <p class="text-muted mb-0">Produk Aktif</p>
                        <small class="text-danger"><i class="fas fa-arrow-down"></i> 3% dari bulan lalu</small>
                    </div>
                </div>
            </div>

            <!-- Charts and Recent Activity -->
            <div class="row">
                <div class="col-xl-8 mb-4">
                    <div class="chart-card">
                        <h5 class="mb-3">Grafik Penjualan</h5>
                        <div class="d-flex align-items-center justify-content-center h-75">
                            <div class="text-center text-muted">
                                <i class="fas fa-chart-line fa-3x mb-3"></i>
                                <p>Grafik penjualan akan ditampilkan di sini</p>
                                <small>Integrasi dengan Chart.js atau library grafik lainnya</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-4">
                    <div class="recent-activity">
                        <h5 class="mb-3">Aktivitas Terbaru</h5>
                        <div class="activity-item">
                            <div class="activity-icon bg-primary text-white">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <p class="mb-1">Pengguna baru mendaftar</p>
                                <small class="text-muted">2 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-success text-white">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p class="mb-1">Pesanan baru diterima</p>
                                <small class="text-muted">5 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <p class="mb-1">Stok produk menipis</p>
                                <small class="text-muted">10 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-info text-white">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div>
                                <p class="mb-1">Review baru dari pelanggan</p>
                                <small class="text-muted">15 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-secondary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div>
                                <p class="mb-1">Sistem diperbarui</p>
                                <small class="text-muted">1 jam yang lalu</small>
                            </div>
                        </div>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('layouts.footer')