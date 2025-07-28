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
                $estimasiStokBulanan = ceil($rataHarian * 30);
                $estimasiStokTahunan = ceil($rataHarian * 365);

                $prediksiStok[$item->produks_id] = [
                    'penjualan_bulanan' => $item->totalJumlah,
                    'estimasi_stok' => $estimasiStokBulanan,
                    'estimasi_stok_tahunan' => $estimasiStokTahunan,
                    'nama_produk' => $produk->nama,
                    'stok' => $produk->stok,
                    'kategori' => $produk->kategori,
                    'harga' => $produk->harga,
                ];
            }
        }

        return $prediksiStok;
    }

    // public function analitik()
    // {

    //     $itemsObject = new Items();

    //     $data = $itemsObject->getDataPenjuala();

    //     return $this->kalkulasi($data);
    // }

    public function analitik($bulan = null, $year = null)
    {
        $itemsObject = new Items();
        $data = $itemsObject->getDataPenjuala($bulan, $year);

        // dd($data); // Debugging line to check the data  

        return $this->kalkulasi($data);
    }


}
