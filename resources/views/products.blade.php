@include('layouts.header')
<!-- @include('layouts.sidebar') -->

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Dashboard'])

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
            <div class="view-toggle">
                <button class="view-btn active" data-view="grid">
                    <i class="fas fa-th"></i>
                </button>
                <button class="view-btn" data-view="table">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
    </div>
</main>


@include('layouts.footer');