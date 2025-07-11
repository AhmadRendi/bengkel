@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Tambah Invoice'])

    <!-- Page Content -->
    <div class="container-fluid px-4">
        <!-- Invoice Container -->
        <div class="invoice-container">
            <form action="{{ route('add-invoice') }}" method="POST">
                @csrf
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
                            <input type="text" id="namaPelanggan" name="namaPelanggan" class="form-control" placeholder="Nama customer..."
                                autocomplete="off">
                            <div id="customerDropdown" class="customer-dropdown"></div>
                        </div>

                        <!-- Invoice Items -->
                        <div class="invoice-items mt-3">
                            <h6 class="mb-3">Select Pesanan</h6>
                            <div id="invoiceItems">
                                <select id="produkSelect" class="form-control" name="produk_id[]">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-nama="{{ $product->nama }}"
                                            data-harga="{{ $product->harga }}">
                                            {{ $product->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="billing-section">
                        <h6>Ship To:</h6>
                        <div class="billing-details">
                            <textarea class="form-control mt-2" rows="3" name="alamat" placeholder="Alamat pengiriman (opsional)"
                                id="alamat"></textarea>
                        </div>
                        <div class="billing-details mt-3">
                            <h6 class="mb-3">Item Pesanan</h6>
                            <table class="table products-table align-middle">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedItems">
                                    <!-- Baris produk akan di-generate via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Invoice Summary -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- Notes Section -->
                        <div class="invoice-notes">
                            <h6>Catatan</h6>
                            <textarea class="notes-textarea" id="catatan"name="catatan"
                                placeholder="Tambahkan catatan untuk customer (opsional)..."></textarea>
                        </div>
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

                <!-- Invoice Actions -->
                <div class="invoice-actions">
                    <!-- <button type="button" class="btn-invoice btn-cancel" onclick="cancelInvoice()">
                    <i class="fas fa-times"></i>
                    Batal
                </button> -->
                    <!-- <button type="button" class="btn-invoice btn-save" onclick="saveInvoice()">
                    <i class="fas fa-save"></i>
                    Simpan Draft
                </button> -->
                    <!-- <button type="button" class="btn-invoice btn-preview" onclick="previewInvoice()">
                    <i class="fas fa-eye"></i>
                    Preview
                </button> -->
                    <button type="submit" class="btn-invoice btn-send">
                        <i class="fas fa-paper-plane"></i>
                        Simpan
                    </button>
                </div>
        </div>
        </form>
    </div>
</main>

@include('layouts.footer')