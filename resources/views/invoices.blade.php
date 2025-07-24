@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Semua Nota'])
    <div class="container-fluid px-4">

        <div class="products-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success btn-sm" onclick="exportNota()">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
        </div>

        <div id="usersContainer">
            <div class="users-table-container">
                <table class="table products-table align-middle text-center" id="tableUsers">
                    <thead class="bg-light text-center">
                        <tr>
                            <th style="width: 10%;">Id</th>
                            <th style="width: 25%;">Customer</th>
                            <th style="width: 25%;">Tanggal</th>
                            <th style="width: 40%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice['id'] }}</td>
                                <td>{{ $invoice['namaPelanggan'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice['created_at'])->format('d M Y') }}</td>
                                <td>
                                    <div class="invoice-card-actions">
                                        <button class="btn btn-sm btn-primary"
                                            onclick="openInvoiceModal({{ $invoice['id'] }})">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                        <a href="{{ route('invoice.download.pdf', $invoice->id) }}"
                                            class="btn btn-sm btn-info text-white" target="_blank">
                                            <i class="fas fa-download"></i> PDF
                                        </a>
                                        <!-- <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button> -->
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
@include('layouts.footer')