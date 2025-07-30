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
    private function kalkulasi($totalJumlah, $produk, $month, $year)
    {
        $penjualanBulanan = $totalJumlah ?? 0;

        $dateForMonth = Carbon::create($year, $month, 1);
        $daysInMonth = $dateForMonth->daysInMonth;

        $rataHarian = ($penjualanBulanan > 0) ? $penjualanBulanan / $daysInMonth : 0;

        $estimasiStokBulanan = ceil($rataHarian * $daysInMonth);
        $estimasiStokTahunan = ceil($rataHarian * 365);

        return [
            'penjualan_bulanan' => $penjualanBulanan,
            'estimasi_stok' => $estimasiStokBulanan,
            'estimasi_stok_tahunan' => $estimasiStokTahunan,
            'nama_produk' => $produk->nama,
            'stok' => $produk->stok,
            'kategori' => $produk->kategori,
            'harga' => $produk->harga,
        ];
    }

    public function analitik(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $allProducts = Produk::all();

        $productsData = [];

        foreach ($allProducts as $product) {
            $productMonthlyData = [
                'nama_produk' => $product->nama,
                'stok' => $product->stok,
                'kategori' => $product->kategori,
                'harga' => $product->harga,
                'monthly_sales' => [],
                'estimasi_stok_tahunan_total' => 0,
            ];

            $actualSales = [];
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            for ($month = 1; $month <= 12; $month++) {
                $totalJumlah = 0;
                $estimasiStok = 0;

                if ($year < $currentYear || ($year == $currentYear && $month <= $currentMonth)) {
                    // Use actual sales for past and current months
                    $salesDataForProduct = Items::select(DB::raw('SUM(jumlah) as totalJumlah'))
                        ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
                        ->where('items.produks_id', $product->id)
                        ->whereYear('invoices.tanggal', $year)
                        ->whereMonth('invoices.tanggal', $month)
                        ->first();

                    $totalJumlah = $salesDataForProduct->totalJumlah ?? 0;
                    $actualSales[$month] = $totalJumlah; // Store actual sales for prediction
                    $estimasiStok = $this->kalkulasi($totalJumlah, $product, $month, $year)['estimasi_stok'];
                } else {
                    // Predict for future months based on average of past actual sales in the current year
                    $averageMonthlySales = 0;
                    $monthsWithSales = 0;
                    foreach ($actualSales as $pastMonthSales) {
                        if ($pastMonthSales > 0) {
                            $averageMonthlySales += $pastMonthSales;
                            $monthsWithSales++;
                        }
                    }

                    if ($monthsWithSales > 0) {
                        $averageMonthlySales = $averageMonthlySales / $monthsWithSales;
                    }

                    $estimasiStok = ceil($averageMonthlySales); // Simple prediction: average of past sales
                }

                $productMonthlyData['monthly_sales'][$month] = [
                    'penjualan_bulanan' => $totalJumlah, // Actual sales for past/current, 0 for future
                    'estimasi_stok' => $estimasiStok,
                ];
                $productMonthlyData['estimasi_stok_tahunan_total'] += $estimasiStok;
            }
            $productsData[] = $productMonthlyData;
        }

        return view('analitik', ['productsData' => $productsData, 'selectedYear' => $year]);
    }

    public function exportAnalitikPdf(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $allProducts = Produk::all();

        $productsData = [];

        foreach ($allProducts as $product) {
            $productMonthlyData = [
                'nama_produk' => $product->nama,
                'stok' => $product->stok,
                'kategori' => $product->kategori,
                'harga' => $product->harga,
                'monthly_sales' => [],
                'estimasi_stok_tahunan_total' => 0,
            ];

            $actualSales = [];
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            for ($month = 1; $month <= 12; $month++) {
                $totalJumlah = 0;
                $estimasiStok = 0;

                if ($year < $currentYear || ($year == $currentYear && $month <= $currentMonth)) {
                    // Use actual sales for past and current months
                    $salesDataForProduct = Items::select(DB::raw('SUM(jumlah) as totalJumlah'))
                        ->join('invoices', 'items.invoices_id', '=', 'invoices.id')
                        ->where('items.produks_id', $product->id)
                        ->whereYear('invoices.tanggal', $year)
                        ->whereMonth('invoices.tanggal', $month)
                        ->first();

                    $totalJumlah = $salesDataForProduct->totalJumlah ?? 0;
                    $actualSales[$month] = $totalJumlah; // Store actual sales for prediction
                    $estimasiStok = $this->kalkulasi($totalJumlah, $product, $month, $year)['estimasi_stok'];
                } else {
                    // Predict for future months based on average of past actual sales in the current year
                    $averageMonthlySales = 0;
                    $monthsWithSales = 0;
                    foreach ($actualSales as $pastMonthSales) {
                        if ($pastMonthSales > 0) {
                            $averageMonthlySales += $pastMonthSales;
                            $monthsWithSales++;
                        }
                    }

                    if ($monthsWithSales > 0) {
                        $averageMonthlySales = $averageMonthlySales / $monthsWithSales;
                    }

                    $estimasiStok = ceil($averageMonthlySales); // Simple prediction: average of past sales
                }

                $productMonthlyData['monthly_sales'][$month] = [
                    'penjualan_bulanan' => $totalJumlah, // Actual sales for past/current, 0 for future
                    'estimasi_stok' => $estimasiStok,
                ];
                $productMonthlyData['estimasi_stok_tahunan_total'] += $estimasiStok;
            }
            $productsData[] = $productMonthlyData;
        }

        $pdf = Pdf::loadView('pdfAnalitik', compact('productsData', 'year'));
        return $pdf->download('laporan-analitik-' . $year . '.pdf');
    }
}
