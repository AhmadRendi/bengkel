<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0 30px;
            color: #000;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            background: #3b28cc;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 22px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .invoice-header {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .company-info p {
            margin: 0;
            line-height: 1.5;
        }

        .section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .section .box {
            flex: 1;
            border-left: 3px solid #3b28cc;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
        }

        h6 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #3b28cc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            padding: 6px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f1f1f1;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .summary {
            margin-top: 20px;
            border-left: 3px solid #3b28cc;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
            float: right;
            width: 45%;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-value {
            font-weight: bold;
            color: #3b28cc;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="invoice-header">
        <!-- <div class="company-logo">YC</div> -->
        <div class="company-info">
            <h5 style="margin: 0;">BENGKEL SINAR MOTOR</h5>
            <p>Jl. Kemakmuran No. 24<br>
            Kec. Enrekang Kab. Enrekang<br>
            Phone: +62 21-1234-5678<br>
            </p>
            <p>Tanggal: {{ $invoice->created_at->format('d-m-Y') }}</p>
        </div>
    </div>

    <!-- Bill To and Ship To -->
    <div class="section">
        <div class="box">
            <h6>BILL TO:</h6>
            <p>{{ $invoice->namaPelanggan }}</p>
            <div style="margin-top: 15px;">
                <h6>ITEM PESANAN</h6>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h6>SHIP TO:</h6>
            <p><strong>ALAMAT</strong><br>{{ $invoice->alamat }}</p>
            <p style="margin-top: 20px;"><strong>CATATAN</strong><br>{{ $invoice->catatan }}</p>
        </div>
    </div>

    <!-- Summary -->
    <div class="summary">
        <div class="summary-row">
            <span>Subtotal:</span>
            <span class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span>Pajak (10%):</span>
            <span class="summary-value">Rp {{ number_format($tax, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row" style="border-top: 1px solid #3b28cc; padding-top: 5px;">
            <span>Total:</span>
            <span class="summary-value">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
    </div>
</body>
</html>
