@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Tambah Produk'])
    <div class="container-fluid px-4">
        <div id="productFormContainer" class="product-form-container">
            <h5 class="mb-3">Tambah Produk Baru</h5>
            <form id="productForm">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-section">
                            <h6>Informasi Dasar</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="category" class="form-select" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Home">Home & Living</option>
                                        <option value="Sports">Sports</option>
                                        <option value="Books">Books</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga (Rp)</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h6>Detail Produk</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat (kg)</label>
                                    <input type="number" name="weight" step="0.1" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dimensi (PxLxT)</label>
                                    <input type="text" name="dimensions" class="form-control" placeholder="30x20x10 cm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Tidak Aktif</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-section">
                            <h6>Gambar Produk</h6>
                            <div class="image-upload-area">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="mb-2">Klik atau drag & drop gambar di sini</p>
                                <small class="text-muted">Format: JPG, PNG, GIF (Max: 5MB)</small>
                            </div>
                            <input type="file" id="productImage" accept="image/*" style="display: none;">
                            <img class="image-preview" style="display: none;">
                        </div>

                        <!-- <div class="form-section">
                                <h6>Tag Kategori</h6>
                                <input type="text" id="productCategories" class="form-control" placeholder="Tekan Enter untuk menambah tag">
                                <div class="category-tags mt-2"></div>
                            </div> -->
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <!-- <button type="button" class="btn btn-secondary" onclick="toggleProductForm()">Batal</button> -->
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.footer')