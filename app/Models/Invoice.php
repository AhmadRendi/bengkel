<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
       protected $fillable = [
        'namaPelanggan',
        'catatan',
        'alamat',
        'created_at',
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'invoices_id');
    }
}
