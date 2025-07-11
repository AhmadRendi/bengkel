@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Semua Nota'])
    <div class="container-fluid px-4">

        <!-- Users Container -->
        <div id="usersContainer">
            <!-- Users will be rendered here -->
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
                                    <button class="btn btn-sm btn-primary" onclick="openInvoiceModal({{ $invoice['id'] }})">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <!-- <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-download"></i> PDF
                                    </button> -->
                                    <a href="{{ route('invoice.download.pdf', $invoice->id) }}"
                                        class="btn btn-sm btn-info text-white" target="_blank">
                                        <i class="fas fa-download"></i> PDF
                                    </a>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</main>
@include('layouts.footer')