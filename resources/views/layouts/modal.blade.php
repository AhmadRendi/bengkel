<input type="hidden" id="hasModalError" value="{{ session('modal_error') }}">
<input type="hidden" id="hasModalSuccess" value="{{ session('success') }}">

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger animate__animated animate__shakeX">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="fas fa-times-circle me-2 text-white animate__animated animate__bounceIn"></i>
                    Terjadi Kesalahan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Tutup"></button>
            </div>
            <div class="modal-body fw-semibold text-danger text-center">
                {{ session('modal_error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger animate__animated animate__shakeX">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="fas fa-times-circle me-2 text-white animate__animated animate__bounceIn"></i>
                    Sukses
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Tutup"></button>
            </div>
            <div class="modal-body fw-semibold text-danger text-center">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Invoice -->
<div class="modal modal-xl" id="previewModal" tabindex="-1" aria-labelledby="previewModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="container-fluid px-4">
            <!-- Invoice Container -->
            <div class="invoice-container">
                <!-- Invoice Header -->
                <div class="invoice-header">
                    <div class="company-info">
                        <div>
                            <!-- <div class="company-logo">YC</div> -->
                            <div class="mt-3">
                                <h5 class="mb-1">BENGKEL SINAR MOTOR</h5>
                                <p class="text-muted mb-0">
                                    Jl. Contoh No. 123<br>
                                    Jakarta, Indonesia 12345<br>
                                    Phone: +62 21-1234-5678<br>
                                    Email: info@yourcompany.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Information -->
                <div class="billing-info">
                    <div class="billing-section">
                        <h6>Bill To:</h6>
                        <div class="customer-select">
                            <input type="text" id="namaPelanggan" name="namaPelanggan" class="form-control"
                                placeholder="Nama customer..." autocomplete="off">
                            <div id="customerDropdown" class="customer-dropdown"></div>
                        </div>

                        <!-- Invoice Items -->
                        <div class="invoice-items mt-3">
                            <div class="billing-details mt-3">
                                <h6 class="mb-3">Item Pesanan</h6>
                                <table class="table products-table align-middle">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selectedItems">
                                        <!-- Baris produk akan di-generate via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="billing-section">
                        <h6>Ship To:</h6>
                        <div class="billing-details">
                            <h6>Alamat</h6>
                            <textarea class="notes-textarea mt-2" rows="3" name="alamat"
                                placeholder="Alamat pengiriman (opsional)" id="alamat"></textarea>
                        </div>

                        <div class="billing-details mt-3">
                            <h6>Catatan</h6>
                            <textarea class="notes-textarea" id="catatan" name="catatan"
                                placeholder="Tambahkan catatan untuk customer (opsional)..."></textarea>
                        </div>
                    </div>
                </div>


                <!-- Invoice Summary -->
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="invoice-summary">
                            <div class="summary-row">
                                <span class="summary-label">Subtotal:</span>
                                <span class="summary-value" id="summarySubtotal">Rp 0</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Pajak (10%):</span>
                                <span class="summary-value" id="summaryTax">Rp 0</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total:</span>
                                <span class="summary-value" id="summaryTotal">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" aria-hidden="true" aria-labelledby="editUserModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.user') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="editUserId" arial-hidden="true">
                    <label for="editUserName" class="form-label">Nama Pengguna</label>
                    <input type="text" name="name" id="editUserName" class="form-control mb-3"
                        placeholder="Nama Pengguna">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="editUserEmail" class="form-control mb-3"
                        placeholder="Email Pengguna">
                    <!-- <label for="role" class="form-label"> Role</label> -->
                    <!-- <select name="role" id="editUserRole" class="form-control mb-3">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select> -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Produk -->
<div class="modal modal-lg" id="editProdukModal" aria-hidden="true" aria-labelledby="editProdukModalLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdukModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.product') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-section">
                                <h6>Informasi Dasar</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" name="id" id="editProdukId" arial-hidden="true">
                                        <label class="form-label">Nama Produk</label>
                                        <input type="text" name="nama" id="editNamaProduk" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" name="sku" id="editSKUProduk" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="editDeskripsiProduk" class="form-control"
                                        rows="4"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" id="editKategoriProduk" class="form-control" required>
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
                                        <input type="number" name="harga" id="editHargaProduk" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Stok</label>
                                        <input type="number" name="stok" id="editStokProduk" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('products') }}" class="btn btn-secondary">
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
    </div>
</div>

<!-- Modal Rumus Perhitungan Estimasi Stok -->
<div class="modal fade" id="modalRumus" tabindex="-1" aria-labelledby="modalRumusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalRumusLabel">
                    Rumus Perhitungan Estimasi Stok
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Rumus untuk menghitung estimasi stok selama 30 hari ke depan:</p>
                <div class="border p-3 rounded bg-light">
                    <p><strong>Rata-rata Harian (R):</strong></p>
                    <p class="text-center">
                        <math>
                            <mi>R</mi> = <mfrac>
                                <mi>T</mi>
                                <mi>H</mi>
                            </mfrac>
                        </math><br>
                        <small><em>dimana T = total jumlah terjual, H = hari berjalan bulan ini</em></small>
                    </p>

                    <hr>

                    <p><strong>Estimasi Stok (E):</strong></p>
                    <p class="text-center">
                        <math>
                            <mi>E</mi> = ⌈ R × 30 ⌉
                        </math><br>
                        <small><em>(dibulatkan ke atas)</em></small>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>