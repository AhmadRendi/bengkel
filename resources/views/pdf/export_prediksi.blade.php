<!DOCTYPE html>
<html>
<head>
    <title>Laporan Prediksi Stok</title>
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
        .info-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Prediksi Kebutuhan Stok</h2>
        @if ($selectedProduct)
            <h3>Produk: {{ $selectedProduct->nama }}</h3>
            <p>Menggunakan {{ $numPeriods }} bulan data historis</p>
        @else
            <p>Produk tidak dipilih atau data tidak tersedia.</p>
        @endif
    </div>

    @if ($selectedProduct && $predictionData)
        <div class="info-box">
            <h4>Informasi Produk</h4>
            <p><strong>Stok Saat Ini:</strong> {{ $selectedProduct->stok }} unit</p>
        </div>

        <h4>Data Historis Penjualan (Dasar Perhitungan)</h4>
        <table>
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Penjualan (Unit)</th>
                    <th>Bobot (Weight)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($predictionData['historical_data'] as $data)
                <tr>
                    <td>{{ $data['period'] }}</td>
                    <td>{{ $data['sales'] }}</td>
                    <td>{{ $data['weight'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert-success">
            <h4>Hasil Prediksi (Weighted Moving Average)</h4>
            <p><strong>Prediksi Kebutuhan Stok 1 Bulan ke Depan:</strong> {{ $predictionData['wma_prediction_1_month'] }} unit</p>
            <p>Perhitungan: <code>{{ $predictionData['calculation_summary'] }}</code></p>
        </div>

        <div class="info-box">
            <h4>Estimasi Jangka Panjang</h4>
            <p><strong>Estimasi Kebutuhan 6 Bulan:</strong> {{ $predictionData['estimate_6_months'] }} unit</p>
            <p><strong>Estimasi Kebutuhan 1 Tahun:</strong> {{ $predictionData['estimate_12_months'] }} unit</p>
            <small>*Estimasi jangka panjang adalah hasil perkalian dari prediksi 1 bulan dan bersifat kasar.</small>
        </div>
    @else
        <p>Tidak ada data prediksi yang tersedia untuk produk ini.</p>
    @endif
</body>
</html>
