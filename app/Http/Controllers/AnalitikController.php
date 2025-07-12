<?php

namespace App\Http\Controllers;

use App\Models\Items;


use App\Models\Produk;
use Illuminate\Http\Request;

class AnalitikController extends Controller
{


    private function kalkulasi($data)
    {
        $prediksiStok = [];

        foreach ($data as $item) {
            $produk = Produk::find($item->produks_id);

            if ($produk) {
                $jumlahHariBerjalan = now()->day;
                $rataHarian = $item->totalJumlah / $jumlahHariBerjalan;
                $estimasiStok = ceil($rataHarian * 30);

                $prediksiStok[$item->produks_id] = [
                    'penjualan_bulanan' => $item->totalJumlah,
                    'estimasi_stok' => $estimasiStok,
                    'nama_produk' => $produk->nama,
                    'stok' => $produk->stok,
                    'kategori' => $produk->kategori,
                    'harga' => $produk->harga,
                ];
            }
        }

        return $prediksiStok;
    }

    public function analitik()
    {

        $itemsObject = new Items();

        $data = $itemsObject->getDataPenjuala();

        return $this->kalkulasi($data);
    }

}
