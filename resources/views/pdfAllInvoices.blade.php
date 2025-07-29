<!DOCTYPE html>
<html>
<head>
    <title>Laporan Semua Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Semua Invoice</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->namaPelanggan }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</td>
                    <td>
                        @php
                            $subtotal = 0;
                            foreach ($invoice->items as $item) {
                                $subtotal += $item->produk->harga * $item->jumlah;
                            }
                            $tax = $subtotal * 0.1;
                            $total = $subtotal + $tax;
                        @endphp
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada invoice untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>