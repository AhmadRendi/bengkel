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
                                <h5 class="mb-1">BENGKEL SINAR MOTOR</h5>
                                <p class="text-muted mb-0">
                                    Jl. Kemakmuran No. 24<br>
                                    Kec. Enrekang Kab. Enrekang<br>
                                    Phone: +62 21-1234-5678<br>
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
                            <h6 class="mt-3">Tanggal</h6>
                            <input type="date" name="tanggal" id="tanggal" class="form-control mt-2" placeholder="Tanggal Invoice">
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
                                <div class="input-group mt-2">
                                    <input type="number" id="jumlahInput" class="form-control" value="1" min="1">
                                    <button type="button" id="addItemButton" class="btn btn-primary">Tambah</button>
                                </div>
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
                    <input type="hidden" name="produk_ids" id="hiddenProdukIds">
                    <input type="hidden" name="jumlah" id="hiddenJumlah">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const produkSelect = document.getElementById('produkSelect');
        const jumlahInput = document.getElementById('jumlahInput');
        const addItemButton = document.getElementById('addItemButton');
        const selectedItemsTableBody = document.getElementById('selectedItems');
        const summarySubtotal = document.getElementById('summarySubtotal');
        const summaryTax = document.getElementById('summaryTax');
        const summaryTotal = document.getElementById('summaryTotal');
        const namaPelangganInput = document.getElementById('namaPelanggan');
        const customerDropdown = document.getElementById('customerDropdown');
        const tanggalInput = document.getElementById('tanggal');

        let invoiceItems = [];

        // Set current date for tanggal input
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start at 0!
        const dd = String(today.getDate()).padStart(2, '0');
        tanggalInput.value = `${yyyy}-${mm}-${dd}`;

        // Fetch customers for autocomplete
        namaPelangganInput.addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                fetch(`/api/customers?query=${query}`)
                    .then(response => response.json())
                    .then(customers => {
                        customerDropdown.innerHTML = '';
                        if (customers.length > 0) {
                            customerDropdown.style.display = 'block';
                            customers.forEach(customer => {
                                const div = document.createElement('div');
                                div.classList.add('customer-dropdown-item');
                                div.textContent = customer.nama;
                                div.addEventListener('click', function() {
                                    namaPelangganInput.value = customer.nama;
                                    customerDropdown.style.display = 'none';
                                });
                                customerDropdown.appendChild(div);
                            });
                        } else {
                            customerDropdown.style.display = 'none';
                        }
                    });
            } else {
                customerDropdown.style.display = 'none';
            }
        });

        addItemButton.addEventListener('click', function() {
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            if (!selectedOption.value) {
                alert('Pilih produk terlebih dahulu!');
                return;
            }

            const productId = selectedOption.value;
            const productName = selectedOption.dataset.nama;
            const productPrice = parseFloat(selectedOption.dataset.harga);
            const quantity = parseInt(jumlahInput.value);

            if (isNaN(quantity) || quantity <= 0) {
                alert('Jumlah harus angka positif!');
                return;
            }

            const existingItemIndex = invoiceItems.findIndex(item => item.id === productId);

            if (existingItemIndex > -1) {
                // Update quantity if item already exists
                invoiceItems[existingItemIndex].quantity += quantity;
                invoiceItems[existingItemIndex].total = invoiceItems[existingItemIndex].quantity * invoiceItems[existingItemIndex].price;
            } else {
                // Add new item
                invoiceItems.push({
                    id: productId,
                    nama: productName,
                    price: productPrice,
                    quantity: quantity,
                    total: productPrice * quantity
                });
            }

            renderInvoiceItems();
            updateGrandTotal();

            // Reset form for next item selection
            produkSelect.value = ""; // Reset selected product to default
            jumlahInput.value = "1"; // Reset quantity to 1
        });

        function renderInvoiceItems() {
            selectedItemsTableBody.innerHTML = '';
            invoiceItems.forEach((item, index) => {
                const row = selectedItemsTableBody.insertRow();
                row.innerHTML = `
                    <td>${item.nama}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td>
                        <input type="number" class="form-control item-quantity" value="${item.quantity}" min="1" data-index="${index}">
                        <input type="hidden" name="items[${index}][id]" value="${item.id}">
                        <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                        <input type="hidden" name="items[${index}][price]" value="${item.price}">
                    </td>
                    <td>Rp ${item.total.toLocaleString('id-ID')}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">Hapus</button>
                    </td>
                `;
            });

            // Add event listeners for quantity change and remove buttons
            document.querySelectorAll('.item-quantity').forEach(input => {
                input.addEventListener('change', function() {
                    const index = this.dataset.index;
                    const newQuantity = parseInt(this.value);
                    if (!isNaN(newQuantity) && newQuantity > 0) {
                        invoiceItems[index].quantity = newQuantity;
                        invoiceItems[index].total = invoiceItems[index].quantity * invoiceItems[index].price;
                        renderInvoiceItems(); // Re-render to update totals
                        updateGrandTotal();
                    } else {
                        this.value = invoiceItems[index].quantity; // Revert to old quantity if invalid
                    }
                });
            });

            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const index = this.dataset.index;
                    invoiceItems.splice(index, 1);
                    renderInvoiceItems();
                    updateGrandTotal();
                });
            });
        }

        function updateGrandTotal() {
            let subtotal = invoiceItems.reduce((sum, item) => sum + item.total, 0);
            let tax = subtotal * 0.10; // 10% tax
            let grandTotal = subtotal + tax;

            summarySubtotal.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            summaryTax.textContent = `Rp ${tax.toLocaleString('id-ID')}`;
            summaryTotal.textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;
        }

        // Handle form submission to include invoice items
        const invoiceForm = document.querySelector('form');
        invoiceForm.addEventListener('submit', function(event) {
            if (!namaPelangganInput.value.trim()) {
                alert('Nama pelanggan wajib diisi!');
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Clear previous hidden inputs for produk_ids and jumlah
            document.querySelectorAll('input[name="produk_ids[]"]').forEach(input => input.remove());
            document.querySelectorAll('input[name="jumlah[]"]').forEach(input => input.remove());

            invoiceItems.forEach(item => {
                const produkIdInput = document.createElement('input');
                produkIdInput.type = 'hidden';
                produkIdInput.name = 'produk_ids[]';
                produkIdInput.value = item.id;
                invoiceForm.appendChild(produkIdInput);

                const jumlahItemInput = document.createElement('input');
                jumlahItemInput.type = 'hidden';
                jumlahItemInput.name = 'jumlah[]';
                jumlahItemInput.value = item.quantity;
                invoiceForm.appendChild(jumlahItemInput);
            });
        });
    });
</script>