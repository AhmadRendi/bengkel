<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function data(){

        $data = [];

        $user = new User();
        $produk = new Produk();
        $items = new Items();

        $data = [
            'total_user' => $user->countAllUser(),
            'total_produk' => $produk->countAllProduk(),
            'total_penjualan' => $items->getTotalPenjualan()->totalJumlah,
            'total_pendapatan' => $items->getTotalPendapatan()->totalPendapatan,
            'pesanan_terbaru' => $items->getPesananTerbaru(),
        ];

        // dd($data);

        return $data;
    }
}
