@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Analitik'])
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Analitik</h2>
                <p>Halaman ini akan menampilkan berbagai analitik terkait produk, penjualan, dan lainnya.</p>
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