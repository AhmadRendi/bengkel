<?php

namespace App\Http\Controllers;

use App\Models\Invoice; // Import model Invoice
use App\Models\Items;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AnalitikController extends Controller
{
    public function analitik(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'product_id' => 'sometimes|integer|exists:produks,id',
            'periods' => 'sometimes|integer|min:2|max:12',
            'year' => 'sometimes|integer|min:2000|max:' . (Carbon::now()->year + 1),
            'product_filter_id' => 'sometimes|integer|exists:produks,id',
            'category_filter' => 'sometimes|string',
        ]);

        $selectedYear = $validated['year'] ?? Carbon::now()->year;

        // 2. Ambil semua produk untuk dropdown
        $allProducts = Produk::orderBy('nama');

        if ($request->filled('category_filter')) {
            $allProducts->where('kategori', $validated['category_filter']);
        }

        if ($request->filled('product_filter_id')) {
            $allProducts->where('id', $validated['product_filter_id']);
        }

        $allProducts = $allProducts->get();
        $selectedProduct = null;
        $predictionData = null;

        // 3. Ambil data penjualan aktual untuk semua produk (untuk tabel penjualan)
        $allProductsSalesData = [];
        foreach ($allProducts as $product) {
            $monthlySales = Items::select(
                DB::raw('MONTH(invoices.tanggal) as month'),
                DB::raw('SUM(items.jumlah) as total_quantity')
            )
                ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
                ->where('items.produks_id', $product->id)
                ->whereYear('invoices.tanggal', $selectedYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');

            $productSales = [
                'id' => $product->id,
                'nama' => $product->nama,
                'stok' => $product->stok,
                'monthly_sales' => [],
            ];

            for ($month = 1; $month <= 12; $month++) {
                $productSales['monthly_sales'][$month] = $monthlySales->has($month) ? $monthlySales[$month]->total_quantity : 0;
            }
            $allProductsSalesData[] = $productSales;
        }

        // 4. Jika produk dipilih, lakukan analisis WMA
        if ($request->has('product_id')) {
            $productId = $validated['product_id'];
            $numPeriods = $validated['periods'] ?? 3; // Default 3 bulan jika tidak diset

            $selectedProduct = Produk::find($productId);

            // Ambil data penjualan historis (kuantitas per bulan) untuk WMA
            $salesData = Items::select(
                DB::raw('YEAR(invoices.tanggal) as year'),
                DB::raw('MONTH(invoices.tanggal) as month'),
                DB::raw('SUM(items.jumlah) as total_quantity')
            )
                ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
                ->where('items.produks_id', $productId)
                ->where('invoices.tanggal', '>=', Carbon::now()->subMonths($numPeriods)->startOfMonth())
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->limit($numPeriods)
                ->get();

            // Hitung Weighted Moving Average (WMA)
            $weightedSum = 0;
            $totalWeights = 0;
            $historicalDataForView = [];

            if ($salesData->count() >= 2) { // Butuh minimal 2 data untuk prediksi
                $weights = range(1, $salesData->count()); // Bobot: data terlama = 1, terbaru = paling besar

                foreach ($salesData->reverse() as $index => $data) {
                    $currentWeight = $weights[$index];
                    $weightedSum += $data->total_quantity * $currentWeight;
                    $totalWeights += $currentWeight;

                    // Data untuk ditampilkan di view
                    $historicalDataForView[] = [
                        'period' => Carbon::create($data->year, $data->month)->format('F Y'),
                        'sales' => $data->total_quantity,
                        'weight' => $currentWeight,
                    ];
                }

                $wma_prediction = ($totalWeights > 0) ? round($weightedSum / $totalWeights) : 0;

                // Siapkan data untuk ditampilkan
                $predictionData = [
                    'historical_data' => array_reverse($historicalDataForView),
                    'wma_prediction_1_month' => $wma_prediction,
                    'estimate_6_months' => $wma_prediction * 6,
                    'estimate_12_months' => $wma_prediction * 12,
                    'calculation_summary' => "($weightedSum / $totalWeights)",
                ];
            }
        }

        // 5. Kirim data ke view
        return view('analitik', [
            'allProducts' => $allProducts,
            'selectedProduct' => $selectedProduct,
            'predictionData' => $predictionData,
            'allProductsSalesData' => $allProductsSalesData, // Data penjualan aktual semua produk
            'selectedYear' => $selectedYear, // Tahun yang dipilih untuk tabel penjualan
            'input' => $request->all() // Kirim input sebelumnya untuk mengisi ulang form
        ]);
    }

    public function exportAnalitikPdf(Request $request)
    {
        $validated = $request->validate([
            'year' => 'sometimes|integer|min:2000|max:' . (Carbon::now()->year + 1),
            'product_filter_id' => 'sometimes|integer|exists:produks,id',
            'category_filter' => 'sometimes|string',
        ]);

        $selectedYear = $validated['year'] ?? Carbon::now()->year;

        $allProductsQuery = Produk::orderBy('nama');

        if ($request->filled('category_filter')) {
            $allProductsQuery->where('kategori', $validated['category_filter']);
        }

        if ($request->filled('product_filter_id')) {
            $allProductsQuery->where('id', $validated['product_filter_id']);
        }

        $allProducts = $allProductsQuery->get();

        $allProductsSalesData = [];
        foreach ($allProducts as $product) {
            $monthlySales = Items::select(
                DB::raw('MONTH(invoices.tanggal) as month'),
                DB::raw('SUM(items.jumlah) as total_quantity')
            )
                ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
                ->where('items.produks_id', $product->id)
                ->whereYear('invoices.tanggal', $selectedYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');

            $productSales = [
                'id' => $product->id,
                'nama' => $product->nama,
                'stok' => $product->stok,
                'kategori' => $product->kategori, // Tambahkan kategori
                'harga' => $product->harga, // Tambahkan harga
                'monthly_sales' => [],
            ];

            for ($month = 1; $month <= 12; $month++) {
                $productSales['monthly_sales'][$month] = $monthlySales->has($month) ? $monthlySales[$month]->total_quantity : 0;
            }
            $allProductsSalesData[] = $productSales;
        }

        $pdf = Pdf::loadView('pdfAnalitik', compact('allProductsSalesData', 'selectedYear'));
        return $pdf->download('laporan-penjualan-' . $selectedYear . '.pdf');
    }

    public function exportPredictionPdf(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:produks,id',
            'periods' => 'required|integer|min:2|max:12',
        ]);

        $productId = $validated['product_id'];
        $numPeriods = $validated['periods'];

        $selectedProduct = Produk::find($productId);

        $salesData = Items::select(
            DB::raw('YEAR(invoices.tanggal) as year'),
            DB::raw('MONTH(invoices.tanggal) as month'),
            DB::raw('SUM(items.jumlah) as total_quantity')
        )
            ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
            ->where('items.produks_id', $productId)
            ->where('invoices.tanggal', '>=', Carbon::now()->subMonths($numPeriods)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit($numPeriods)
            ->get();

        $weightedSum = 0;
        $totalWeights = 0;
        $historicalDataForView = [];
        $predictionData = null;

        if ($salesData->count() >= 2) {
            $weights = range(1, $salesData->count());

            foreach ($salesData->reverse() as $index => $data) {
                $currentWeight = $weights[$index];
                $weightedSum += $data->total_quantity * $currentWeight;
                $totalWeights += $currentWeight;

                $historicalDataForView[] = [
                    'period' => Carbon::create($data->year, $data->month)->format('F Y'),
                    'sales' => $data->total_quantity,
                    'weight' => $currentWeight,
                ];
            }

            $wma_prediction = ($totalWeights > 0) ? round($weightedSum / $totalWeights) : 0;

            $predictionData = [
                'historical_data' => array_reverse($historicalDataForView),
                'wma_prediction_1_month' => $wma_prediction,
                'estimate_6_months' => $wma_prediction * 6,
                'estimate_12_months' => $wma_prediction * 12,
                'calculation_summary' => "($weightedSum / $totalWeights)",
            ];
        }

        $pdf = Pdf::loadView('pdfPredictionReport', compact('selectedProduct', 'predictionData', 'numPeriods'));
        return $pdf->download('laporan-prediksi-' . Str::slug($selectedProduct->nama) . '.pdf');
    }
}