<!DOCTYPE html>
<html>
<head>
    <title>Laporan Analitik Penjualan & Prediksi Stok</title>
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
            vertical-align: top;
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
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .text-center {
            text-align: center;
        }
        .unit {
            font-size: 8px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Analitik Penjualan & Prediksi Stok</h1>
        <p>Tahun: {{ $year }}</p>
    </div>

    <div class="section-title">Tabel Penjualan Bulanan</div>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Stok Saat Ini</th>
                <th>Harga</th>
                <th>Kategori</th>
                @for ($month = 1; $month <= 12; $month++)
                    <th>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @forelse ($productsData as $product)
                <tr>
                    <td>{{ $product['nama_produk'] }}</td>
                    <td>{{ $product['stok'] }}</td>
                    <td>Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                    <td>{{ $product['kategori'] }}</td>
                    @for ($month = 1; $month <= 12; $month++)
                        <td>{{ $product['monthly_sales'][$month]['penjualan_bulanan'] }}</td>
                    @endfor
                </tr>
            @empty
                <tr>
                    <td colspan="{{ 4 + 12 }}" class="text-center">Tidak ada data penjualan untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Tabel Prediksi Stok Bulanan</div>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Stok Saat Ini</th>
                <th>Harga</th>
                <th>Kategori</th>
                @for ($month = 1; $month <= 12; $month++)
                    <th>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</th>
                @endfor
                <th>Estimasi Stok Tahun Depan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productsData as $product)
                <tr>
                    <td>{{ $product['nama_produk'] }}</td>
                    <td>{{ $product['stok'] }}</td>
                    <td>Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                    <td>{{ $product['kategori'] }}</td>
                    @for ($month = 1; $month <= 12; $month++)
                        <td>{{ $product['monthly_sales'][$month]['estimasi_stok'] }} <span class="unit">unit</span></td>
                    @endfor
                    <td>{{ $product['estimasi_stok_tahunan_total'] }} <span class="unit">unit</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ 4 + 12 + 1 }}" class="text-center">Tidak ada data prediksi untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>