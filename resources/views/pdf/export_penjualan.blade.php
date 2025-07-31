<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Aktual Tahun {{ $selectedYear }}</title>
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
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .total-revenue {
            margin-top: 20px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Penjualan Aktual</h2>
        <h3>Tahun {{ $selectedYear }}</h3>
        
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                @for ($month = 1; $month <= 12; $month++)
                    <th>{{ Carbon\Carbon::create()->month($month)->translatedFormat('M') }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @forelse ($allProductsSalesData as $productSales)
            <tr>
                <td>{{ $productSales['nama'] }}</td>
                @for ($month = 1; $month <= 12; $month++)
                    <td>{{ $productSales['monthly_sales'][$month] }}</td>
                @endfor
            </tr>
            @empty
            <tr>
                <td colspan="13" class="text-center">Tidak ada data penjualan aktual untuk tahun ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-revenue">
        Total Penjualan Aktual (Periode Terpilih): Rp {{ number_format($totalSalesRevenue, 0, ',', '.') }}
    </div>
</body>
</html>
