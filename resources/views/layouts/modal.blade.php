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

<!-- Scrollable modal -->
<div class="modal modal-xl" id="previewModal" tabindex="-1" aria-labelledby="previewModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="container-fluid px-4">
            <!-- Invoice Container -->
            <div class="invoice-container">
                <!-- Invoice Header -->
                <div class="invoice-header">
                    <div class="company-info">
                        <div>
                            <div class="company-logo">YC</div>
                            <div class="mt-3">
                                <h5 class="mb-1">Your Company</h5>
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