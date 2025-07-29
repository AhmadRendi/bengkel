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
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalRumus">
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

@include('layouts.footer')