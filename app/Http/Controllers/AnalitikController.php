<?php

namespace App\Http\Controllers;

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
                'estimasi_stok_tahunan_total' => 0, // Will be calculated later
            ];

            for ($month = 1; $month <= 12; $month++) {
                $salesDataForProduct = Items::select(DB::raw('SUM(jumlah) as totalJumlah'))
                    ->where('produks_id', $product->id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->first();

                $totalJumlah = $salesDataForProduct->totalJumlah ?? 0;

                $calculatedData = $this->kalkulasi($totalJumlah, $product, $month, $year);

                $productMonthlyData['monthly_sales'][$month] = [
                    'penjualan_bulanan' => $calculatedData['penjualan_bulanan'],
                    'estimasi_stok' => $calculatedData['estimasi_stok'],
                ];
                // Sum up yearly estimated stock for each product
                $productMonthlyData['estimasi_stok_tahunan_total'] += $calculatedData['estimasi_stok_tahunan'];
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

            for ($month = 1; $month <= 12; $month++) {
                $salesDataForProduct = Items::select(DB::raw('SUM(jumlah) as totalJumlah'))
                    ->where('produks_id', $product->id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->first();

                $totalJumlah = $salesDataForProduct->totalJumlah ?? 0;

                $calculatedData = $this->kalkulasi($totalJumlah, $product, $month, $year);

                $productMonthlyData['monthly_sales'][$month] = [
                    'penjualan_bulanan' => $calculatedData['penjualan_bulanan'],
                    'estimasi_stok' => $calculatedData['estimasi_stok'],
                ];
                $productMonthlyData['estimasi_stok_tahunan_total'] += $calculatedData['estimasi_stok_tahunan'];
            }
            $productsData[] = $productMonthlyData;
        }

        $pdf = Pdf::loadView('pdfAnalitik', compact('productsData', 'year'));
        return $pdf->download('laporan-analitik-' . $year . '.pdf');
    }
}
