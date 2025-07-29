@include('layouts.header')
@include('layouts.sidebar')
<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Semua Nota'])
    <div class="container-fluid px-4">

        <div class="products-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <a href="{{ route('invoices.export.pdf.all') }}" class="btn btn-outline-success btn-sm" target="_blank">
                        <i class="fas fa-download me-1"></i>Export
                    </a>
                </div>
            </div>
        </div>

        <div id="usersContainer">
            <div class="users-table-container">
                <table class="table products-table align-middle text-center" id="tableUsers">
                    <thead class="bg-light text-center">
                        <tr>
                            <th style="width: 10%;">No.</th>
                            <th style="width: 25%;">Customer</th>
                            <th style="width: 25%;">Tanggal</th>
                            <th style="width: 40%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice['namaPelanggan'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice['created_at'])->format('d M Y') }}</td>
                                <td>
                                    <div class="invoice-card-actions">
                                        <a href="{{ route('invoices.show', $invoice['id']) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('invoice.download.pdf', $invoice->id) }}"
                                            class="btn btn-sm btn-info text-white" target="_blank">
                                            <i class="fas fa-download"></i> PDF
                                        </a>
                                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this invoice?');">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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