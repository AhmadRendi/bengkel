@include('layouts.header')
@include('layouts.sidebar')

<main class="main-content" id="mainContent">
    @include('layouts.navbar', ['page' => 'Analitik Prediksi Stok (WMA)'])

    <div class="container-fluid px-4">
        {{-- Card untuk Tabel Penjualan Aktual --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Penjualan Aktual per Produk (Tahun {{ $selectedYear }})</h5>
                <form action="{{ route('analitik') }}" method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                    <label for="yearFilter" class="form-label mb-0">Pilih Tahun:</label>
                    <select class="form-select form-select-sm" id="yearFilter" name="year">
                        @php
                        $currentYear = Carbon\Carbon::now()->year;
                        for ($y = $currentYear; $y >= $currentYear - 5; $y--) {
                        echo '<option value="' . $y . '" ' . ($selectedYear == $y ? ' selected' : '' ) . '>' . $y . '</option>' ;
                            }
                            @endphp
                    </select>
                    
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    <a href="{{ route('analitik') }}" class="btn btn-secondary btn-sm" hidden>Reset Filter</a>
                    <a href="{{ route('export.penjualan.pdf', request()->query()) }}" class="btn btn-success btn-sm ms-auto">Export Penjualan ke PDF</a>
                </form>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-3">
                    Total Penjualan Aktual (Periode Terpilih): <strong>Rp {{ number_format($totalSalesRevenue, 0, ',', '.') }}</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped">
                        <thead class="table-light">
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
                </div>
            </div>
        </div>

        {{-- Card untuk Kontrol Form --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Kontrol Prediksi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('analitik') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="product_id" class="form-label">Pilih Produk untuk Dianalisis:</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="" disabled {{ !isset($input['product_id']) ? 'selected' : '' }}>-- Pilih Produk --</option>
                            @foreach ($allProducts as $product)
                            <option value="{{ $product->id }}" {{ (isset($input['product_id']) && $input['product_id'] == $product->id) ? 'selected' : '' }}>
                                {{ $product->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="periods" class="form-label">Gunakan Data (Bulan Terakhir):</label>
                        <input type="number" name="periods" id="periods" class="form-control" value="{{ $input['periods'] ?? 3 }}" min="2" max="12">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Buat Prediksi</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#wmaFormulaModal">
                            Lihat Rumus
                        </button>
                    </div>
                    <div class="col-md-2" hidden>
                        <a href="{{ route('analitik') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Container untuk Hasil Analisis --}}
        @if ($selectedProduct)
        <div class="card shadow-sm" id="predictionResultsCard">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Hasil Analisis untuk: <span class="text-primary">{{ $selectedProduct->nama }}</span></h5>
                <a href="{{ route('export.prediksi.pdf', ['product_id' => $selectedProduct->id, 'periods' => $input['periods'] ?? 3]) }}" class="btn btn-success btn-sm">Export Prediksi ke PDF</a>
            </div>
            <div class="card-body">
                @if ($predictionData)
                <div class="row">
                    {{-- Kolom Kiri: Data dan Hasil --}}
                    <div class="col-lg-6">
                        <h6 class="text-muted">Informasi Produk</h6>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                Stok Saat Ini
                                <span class="badge bg-info rounded-pill fs-6">{{ $selectedProduct->stok }} unit</span>
                            </li>
                        </ul>

                        <h6 class="text-muted">Data Historis Penjualan (Dasar Perhitungan)</h6>
                        <table class="table table-sm table-bordered table-striped mb-4">
                            <thead class="table-light">
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

                        <h6 class="text-muted">Hasil Prediksi (Weighted Moving Average)</h6>
                        <div class="alert alert-success">
                            <p class="fs-5 mb-1 fw-bold">Prediksi Kebutuhan Stok 1 Bulan ke Depan: <span class="text-danger">{{ $predictionData['wma_prediction_1_month'] }} unit</span></p>
                            <small class="text-muted">Perhitungan: <code>{{ $predictionData['calculation_summary'] }}</code></small>
                        </div>

                        <h6 class="text-muted">Estimasi Jangka Panjang</h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                Estimasi Kebutuhan 6 Bulan
                                <span class="fw-bold">{{ $predictionData['estimate_6_months'] }} unit</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                Estimasi Kebutuhan 1 Tahun
                                <span class="fw-bold">{{ $predictionData['estimate_12_months'] }} unit</span>
                            </li>
                        </ul>
                        <small class="form-text text-muted mt-2">*Estimasi jangka panjang adalah hasil perkalian dari prediksi 1 bulan dan bersifat kasar.</small>
                    </div>

                    {{-- Kolom Kanan: Grafik --}}
                    <div class="col-lg-6">
                        <h6 class="text-muted">Grafik Penjualan & Prediksi</h6>
                        <div style="height: 400px;">
                            <canvas id="predictionChart"></canvas>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-warning text-center">
                    <h5 class="alert-heading">Data Tidak Cukup</h5>
                    <p>Tidak cukup data penjualan historis (minimal 2 bulan) untuk produk "{{ $selectedProduct->nama }}" untuk membuat prediksi yang akurat.</p>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-info text-center">
            <h5 class="alert-heading">Mulai Analisis</h5>
            <p>Silakan pilih produk dan tentukan periode data untuk memulai prediksi kebutuhan stok.</p>
        </div>
        @endif
    </div>
</main>

<!-- Modal Rumus WMA -->
<div class="modal fade" id="wmaFormulaModal" tabindex="-1" aria-labelledby="wmaFormulaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wmaFormulaModalLabel">Metode Weighted Moving Average (WMA)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Metode Weighted Moving Average (WMA) memberikan bobot yang berbeda pada setiap data historis, dengan data terbaru diberikan bobot yang lebih besar. Ini membantu mencerminkan tren terkini dengan lebih baik.</p>
                <h6>Rumus WMA:</h6>
                <p class="text-center fs-4 fw-bold">WMA = (Σ (Xₜ × W)) / ΣW</p>
                <ul>
                    <li><strong>Xₜ</strong>: Nilai penjualan aktual pada periode waktu ke-t (misalnya, jumlah unit terjual pada bulan tertentu).</li>
                    <li><strong>W</strong>: Bobot yang diberikan pada periode waktu ke-t. Data terbaru memiliki bobot tertinggi.</li>
                    <li><strong>Σ (Xₜ × W)</strong>: Jumlah dari hasil perkalian penjualan aktual dengan bobotnya untuk setiap periode.</li>
                    <li><strong>ΣW</strong>: Jumlah total dari semua bobot.</li>
                </ul>

                <h6>Contoh Perhitungan:</h6>
                <p>Misalkan kita menggunakan 3 bulan data historis dengan bobot 3, 2, 1 (bulan terbaru bobot 3, bulan sebelumnya bobot 2, dst.).</p>
                <p>Data Penjualan:</p>
                <ul>
                    <li>Bulan 1 (Terlama): 100 unit (Bobot 1)</li>
                    <li>Bulan 2 (Tengah): 120 unit (Bobot 2)</li>
                    <li>Bulan 3 (Terbaru): 150 unit (Bobot 3)</li>
                </ul>
                <p>Perhitungan:</p>
                <p class="ms-4"><code>(100 × 1) + (120 × 2) + (150 × 3)</code></p>
                <p class="ms-4"><code>= 100 + 240 + 450</code></p>
                <p class="ms-4"><code>= 790</code></p>
                <p class="ms-4">Total Bobot (ΣW) = <code>1 + 2 + 3 = 6</code></p>
                <p class="ms-4">WMA = <code>790 / 6 = 131.67</code></p>
                <p>Jadi, prediksi penjualan untuk bulan berikutnya adalah sekitar <strong>132 unit</strong> (dibulatkan).</p>

                <h6>Penerapan di Sistem Ini:</h6>
                <p>Sistem ini menggunakan jumlah bulan historis yang Anda pilih untuk menentukan bobot secara otomatis (bulan terbaru memiliki bobot tertinggi). Hasil WMA akan memprediksi kebutuhan stok untuk 1 bulan ke depan. Estimasi untuk 6 bulan dan 1 tahun adalah hasil perkalian dari prediksi 1 bulan tersebut.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

{{-- Script untuk Chart.js --}}
@if ($selectedProduct && $predictionData)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('predictionChart').getContext('2d');

        const historicalLabels = @json(array_column($predictionData['historical_data'], 'period'));
        const historicalSales = @json(array_column($predictionData['historical_data'], 'sales'));
        const predictionLabel = 'Prediksi Bulan Depan';
        const predictionValue = @json($predictionData['wma_prediction_1_month']); // Corrected syntax

        console.log('Historical Labels:', historicalLabels);
        console.log('Historical Sales:', historicalSales);
        console.log('Prediction Value:', predictionValue);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [...historicalLabels, predictionLabel],
                datasets: [{
                    label: 'Jumlah Penjualan (Unit)',
                    data: [...historicalSales, predictionValue],
                    backgroundColor: [
                        ...historicalSales.map(() => 'rgba(54, 162, 235, 0.6)'),
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        ...historicalSales.map(() => 'rgba(54, 162, 235, 1)'),
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Unit Terjual'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw} unit`;
                            }
                        }
                    }
                }
            }
        });

        // Scroll to the bottom of the page
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    });
</script>
@endif


