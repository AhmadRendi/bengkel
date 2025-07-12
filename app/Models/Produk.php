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
        "picture",
        "is_active",
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'produks_id');
    }

    public function countAllProduk()
    {
        return Produk::selectRaw('COUNT(*) as total_produk')
            ->where('is_active', true)
            ->first()
            ->total_produk;
    }

    public function hapusProduk($id){
        $produk = Produk::find($id);
        if ($produk) {
            $produk->update(['is_active' => false]);
            return true;
        }
        return false;
    }
}
