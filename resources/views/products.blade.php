@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Dashboard'])
    <div class="container-fluid px-4">
        <div id="productsContainer">
            <div class="products-table-container">
                <table class="table products-table" id="tableProducts">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-semibold">{{ $product['nama'] }}</div>
                                            <small class="text-muted">SKU: {{ $product['sku'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product['kategori'] }}</td>
                                <td>{{ 'Rp ' . number_format($product['harga'], 0, ',', '.') }}</td>
                                <td>{{ $product['stok'] }} unit</td>
                                <td>{{ \Carbon\Carbon::parse( $product['updated_at'] )->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- <button class="btn btn-sm btn-outline-primary"
                                            onclick="viewProduct({{ $product['id'] }})" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </button> -->
                                        <button class="btn btn-sm btn-outline-success"
                                            onclick="editProduct({{ $product['id'] }})" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="deleteProduct({{ $product['id'] }})" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</main>


@include('layouts.footer');