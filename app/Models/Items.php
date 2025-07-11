<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
