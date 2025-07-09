@include('layouts.header')
<!-- @include('layouts.sidebar') -->

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Dashboard'])
    <div class="container-fluid px-4">
        <!-- Products Header -->
        <div class="products-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Produk</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari produk..." id="productSearch">
                    <i class="fas fa-search"></i>
                </div>
                <select class="form-select" id="categoryFilter" style="width: auto;">
                    <option value="">Semua Kategori</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Home">Home & Living</option>
                    <option value="Sports">Sports</option>
                    <option value="Books">Books</option>
                </select>
                <select class="form-select" id="statusFilter" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <!-- Products Container -->
        <div id="productsContainer">
            <div class="products-table-container">
                <table class="table products-table" id="tableProducts">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <!-- <th>Status</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- <div class="me-3">
                                            <img class="product-table-image" src="{{ $product['image'] }}"
                                                alt="{{ $product['name'] }}">
                                        </div> -->
                                        <div>
                                            <div class="fw-semibold">{{ $product['nama'] }}</div>
                                            <small class="text-muted">SKU: {{ $product['sku'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product['kategori'] }}</td>
                                <td>{{ 'Rp ' . number_format($product['price'], 0, ',', '.') }}</td>
                                <td>{{ $product['stock'] }} unit</td>
                                <!-- <td>{{ $product['status'] }}</td> -->
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="viewProduct({{ $product['id'] }})" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </button>
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