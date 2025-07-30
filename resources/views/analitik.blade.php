@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Analitik'])
    <div class="container-fluid px-4">
        <!-- Filter Controls -->
        <div class="products-header">
            <div class="filter-controls">
                <form action="{{ route('analitik') }}" method="GET" class="d-flex gap-2 align-items-center">
                    <label for="yearFilter" class="form-label mb-0">Pilih Tahun:</label>
                    <select class="form-select" id="yearFilter" name="year" style="width: auto;" onchange="this.form.submit()">
                        @php
                            $currentYear = date('Y');
                            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                echo '<option value="' . $i . '" ' . ($selectedYear == $i ? 'selected' : '') . '>' . $i . '</option>';
                            }
                        @endphp
                    </select>
                    <a href="{{ route('analitik.export.pdf', ['year' => $selectedYear]) }}" class="btn btn-outline-success btn-sm" target="_blank">
                        <i class="fas fa-download me-1"></i>Export
                    </a>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalRumus">
                        <i class="fas fa-calculator me-1"></i> Lihat Rumus
                    </button>
                </form>
            </div>
        </div>

        <div class="products-table-container" style="overflow-x: auto; margin-bottom: 2rem;">
            <h5 class="mb-3">Tabel Penjualan Bulanan</h5>
            <table class="table products-table" id="salesTable">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Stok Saat Ini</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        @for ($month = 1; $month <= 12; $month++)
                            <th>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productsData as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $product['nama_produk'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product['stok'] }}</td>
                            <td>Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                            <td>{{ $product['kategori'] }}</td>
                            @for ($month = 1; $month <= 12; $month++)
                                <td>{{ $product['monthly_sales'][$month]['penjualan_bulanan'] }}</td>
                            @endfor
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 4 + 12 }}" class="text-center">Tidak ada data penjualan untuk ditampilkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="products-table-container" style="overflow-x: auto;">
            <h5 class="mb-3">Tabel Prediksi Stok Bulanan</h5>
            <table class="table products-table" id="predictionTable">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Stok Saat Ini</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        @for ($month = 1; $month <= 12; $month++)
                            <th>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</th>
                        @endfor
                        <th>Estimasi Stok Tahun Depan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productsData as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $product['nama_produk'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product['stok'] }}</td>
                            <td>Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                            <td>{{ $product['kategori'] }}</td>
                            @for ($month = 1; $month <= 12; $month++)
                                <td>{{ $product['monthly_sales'][$month]['estimasi_stok'] }} unit</td>
                            @endfor
                            <td>{{ $product['estimasi_stok_tahunan_total'] }} unit</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 4 + 12 + 1 }}" class="text-center">Tidak ada data prediksi untuk ditampilkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal Rumus -->
<div class="modal fade" id="modalRumus" tabindex="-1" aria-labelledby="modalRumusLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRumusLabel">Rumus Prediksi Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. Penjualan Bulanan (Aktual)</h6>
                <p>Untuk bulan-bulan yang sudah berlalu atau bulan saat ini, data penjualan diambil langsung dari catatan transaksi (jumlah produk yang terjual pada bulan tersebut).</p>
                <p><strong>Rumus:</strong> Jumlah produk terjual pada bulan X</p>
                <p><strong>Contoh:</strong> Jika pada bulan Januari terjual 10 unit "Yamalube Matic", maka penjualan bulanan Januari adalah 10 unit.</p>

                <hr>

                <h6>2. Estimasi Stok Bulanan (Prediksi)</h6>
                <p>Untuk bulan-bulan yang akan datang, estimasi stok dihitung berdasarkan rata-rata penjualan bulanan dari bulan-bulan yang sudah berlalu di tahun yang sama.</p>
                <p><strong>Rumus:</strong> <code>CEIL (Total Penjualan Aktual Bulan Lalu / Jumlah Bulan dengan Penjualan Aktual)</code></p>
                <p><strong>Penjelasan:</strong>
                    <ul>
                        <li><code>Total Penjualan Aktual Bulan Lalu</code>: Jumlah total unit produk yang terjual dari awal tahun hingga bulan terakhir yang memiliki data penjualan.</li>
                        <li><code>Jumlah Bulan dengan Penjualan Aktual</code>: Jumlah bulan dari awal tahun hingga bulan terakhir yang memiliki data penjualan (tidak termasuk bulan dengan penjualan 0 jika tidak ada penjualan sama sekali).</li>
                        <li><code>CEIL</code>: Fungsi pembulatan ke atas, memastikan hasil prediksi adalah bilangan bulat (unit produk).</li>
                    </ul>
                </p>
                <p><strong>Contoh:</strong>
                    Misalkan sekarang bulan Juli 2025.
                    <br>Penjualan "Yamalube Matic" di tahun 2025:
                    <ul>
                        <li>Januari: 10 unit</li>
                        <li>Februari: 15 unit</li>
                        <li>Maret: 0 unit</li>
                        <li>April: 12 unit</li>
                        <li>Mei: 8 unit</li>
                        <li>Juni: 0 unit</li>
                    </ul>
                    Untuk memprediksi penjualan Juli 2025:
                    <br>Total Penjualan Aktual Bulan Lalu = 10 + 15 + 0 + 12 + 8 + 0 = 45 unit
                    <br>Jumlah Bulan dengan Penjualan Aktual = 6 bulan (Januari-Juni)
                    <br>Rata-rata Penjualan Bulanan = 45 / 6 = 7.5 unit
                    <br>Estimasi Stok Bulanan (Juli) = <code>CEIL(7.5)</code> = 8 unit
                </p>
                <p>Jika tidak ada data penjualan aktual sama sekali di tahun berjalan, maka prediksi untuk bulan-bulan mendatang akan menjadi 0.</p>

                <hr>

                <h6>3. Estimasi Stok Tahun Depan (Total)</h6>
                <p>Ini adalah total estimasi stok yang dibutuhkan untuk satu tahun penuh, dihitung dengan menjumlahkan semua estimasi stok bulanan (aktual untuk bulan lalu/saat ini, prediksi untuk bulan mendatang).</p>
                <p><strong>Rumus:</strong> <code>SUM (Estimasi Stok Bulanan untuk setiap bulan dalam 1 tahun)</code></p>
                <p><strong>Contoh:</strong> Jika estimasi stok bulanan untuk setiap bulan adalah 8 unit, maka Estimasi Stok Tahun Depan = 8 unit/bulan * 12 bulan = 96 unit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')