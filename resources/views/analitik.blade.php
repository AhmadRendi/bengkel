@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Analitik'])
    <div class="container-fluid px-4">
        <!-- Filter Controls -->
        <div class="products-header">
            <div class="filter-controls">
                <select class="form-select" id="monthFilter" style="width: auto;" onclick="updateFilterMountAnalitik()">
                    <option value="">Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success btn-sm" onclick="exportTableToPDF()">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                    <!-- <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-calculator me-1"></i>Rumus
                    </button> -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalRumus">
                        <i class="fas fa-calculator me-1"></i> Lihat Rumus
                    </button>   
                </div>
            </div>
        </div>
        <div id="productsContainer">
            <div class="products-table-container">
                <table class="table products-table" id="tableProducts">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>stok</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Penjualan Bulan Ini</th>
                            <th>Estimasi Stok Bulan Depan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-semibold">{{ $item['nama_produk'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item['stok'] }}</td>
                                <td>{{ $item['harga'] }}</td>
                                <td>{{ $item['kategori'] }}</td>
                                <td>{{ $item['penjualan_bulanan'] }}</td>
                                <td>{{ $item['estimasi_stok'] }} unit</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')