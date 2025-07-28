<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Items extends Model
{
    //
    protected $fillable = [
        'produks_id',
        'jumlah',
        'invoices_id',
    ];

    // App\Models\Items.php
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produks_id');
    }

    // public function getDataPenjuala()
    // {
    //     $startDate = Carbon::now()->startOfMonth();  // 2025-07-01 00:00:00
    //     $endDate = Carbon::now()->endOfMonth();      // 2025-07-31 23:59:59

    //     return Items::whereBetween('created_at', [$startDate, $endDate])
    //         ->select('produks_id', DB::raw('SUM(jumlah) as totalJumlah'))
    //         ->groupBy('produks_id')
    //         ->get();
    // }

    public function getDataPenjuala($bulan = null, $year = null)
    {

        if ($bulan) {
            $startDate = Carbon::createFromDate(now()->year, $bulan, 1)->startOfMonth();
            $endDate = Carbon::createFromDate(now()->year, $bulan, 1)->endOfMonth();
        } else if ($year) {
            $startDate = Carbon::createFromDate($year, now()->month, 1)->startOfYear();
            $endDate = Carbon::createFromDate($year, now()->month, 31)->endOfYear();
        } else {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }

        return Items::whereBetween('created_at', [$startDate, $endDate])
            ->select('produks_id', DB::raw('SUM(jumlah) as totalJumlah'))
            ->groupBy('produks_id')
            ->get();
    }

    public function getTotalPenjualan()
    {
        $startDate = Carbon::now()->startOfMonth();  // 2025-07-01 00:00:00
        $endDate = Carbon::now()->endOfMonth();      // 2025-07-31 23:59:59

        return Items::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('SUM(jumlah) as totalJumlah'))
            ->first();
    }

    public function getTotalPendapatan()
    {
        $startDate = Carbon::now()->startOfMonth();  // 2025-07-01 00:00:00
        $endDate = Carbon::now()->endOfMonth();      // 2025-07-31 23:59:59

        return Items::whereBetween('items.created_at', [$startDate, $endDate])
            ->join('produks', 'produks.id', '=', 'items.produks_id')
            ->select(DB::raw('SUM(items.jumlah * produks.harga) as totalPendapatan'))
            ->first();
    }

    public function getPesananTerbaru()
    {
        return Items::with('produk')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

}
