@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Tambah Produk'])
    <div class="container-fluid px-4">
        <div id="productFormContainer" class="product-form-container">
            <h5 class="mb-3">Tambah Produk Baru</h5>
            <form id="productForm" action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-section">
                            <h6>Informasi Dasar</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="kategori" class="form-select" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="OLI">OLI</option>
                                        <option value="BAN">BAN</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga (Rp)</label>
                                    <input type="number" name="harga" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Produk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.footer')