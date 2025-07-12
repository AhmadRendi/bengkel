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

    public function getDataPenjuala()
    {
        $startDate = Carbon::now()->startOfMonth();  // 2025-07-01 00:00:00
        $endDate = Carbon::now()->endOfMonth();      // 2025-07-31 23:59:59

        return Items::whereBetween('created_at', [$startDate, $endDate])
            ->select('produks_id', DB::raw('SUM(jumlah) as totalJumlah'))
            ->groupBy('produks_id')
            ->get();
    }

}
