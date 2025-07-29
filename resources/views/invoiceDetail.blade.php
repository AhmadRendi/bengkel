@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Detail Invoice'])
    <div class="container-fluid px-4">
        <div class="invoice-detail-container">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Invoice #{{ $invoice->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Pelanggan:</h6>
                            <p><strong>Nama Pelanggan:</strong> {{ $invoice->namaPelanggan }}</p>
                            <p><strong>Alamat:</strong> {{ $invoice->alamat ?? 'Tidak Tersedia' }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6>Detail Invoice:</h6>
                            <p><strong>Tanggal Invoice:</strong> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</p>
                            <p><strong>Catatan:</strong> {{ $invoice->catatan ?? 'Tidak Ada' }}</p>
                        </div>
                    </div>

                    <h6 class="mt-4">Item Pesanan:</h6>
                    <table class="table table-bordered products-table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($invoice->items as $item)
                                @php
                                    $itemTotal = $item->produk->harga * $item->jumlah;
                                    $subtotal += $itemTotal;
                                @endphp
                                <tr>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Pajak (10%):</th>
                                    <td class="text-end">Rp {{ number_format($subtotal * 0.1, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="fw-bold">
                                    <th>Total:</th>
                                    <td class="text-end">Rp {{ number_format($subtotal * 1.1, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('invoices') }}" class="btn btn-secondary">Kembali ke Daftar Invoice</a>
                        <a href="{{ route('invoice.download.pdf', $invoice->id) }}" class="btn btn-info text-white" target="_blank">
                            <i class="fas fa-download"></i> Unduh PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')