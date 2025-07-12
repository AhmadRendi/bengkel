<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        "nama",
        "sku",
        "deskripsi",
        "kategori",
        "harga",
        "stok",
        "picture"
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'produks_id');
    }

    public function countAllProduk()
    {
        return Produk::selectRaw('COUNT(*) as total_produk')
            ->first()
            ->total_produk;
    }
}
