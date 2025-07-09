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
}
