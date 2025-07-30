<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin#123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'rahmat',
            'email' => 'rahmat@gmail.com',
            'password' => Hash::make('rahmat'),
            'role' => 'karyawan',
        ]);

        // Produk Seeder
        $products = [
            // OLI
            ['nama' => 'Yamalube Matic', 'sku' => 'YMLBMTC', 'deskripsi' => 'Oli mesin matic Yamalube', 'kategori' => 'OLI', 'harga' => 45000, 'stok' => 500],
            ['nama' => 'Yamalube Silver', 'sku' => 'YMLBSLV', 'deskripsi' => 'Oli mesin Yamalube Silver', 'kategori' => 'OLI', 'harga' => 40000, 'stok' => 500],
            ['nama' => 'MPX1', 'sku' => 'MPX1', 'deskripsi' => 'Oli mesin MPX1', 'kategori' => 'OLI', 'harga' => 38000, 'stok' => 500],
            ['nama' => 'MPX2', 'sku' => 'MPX2', 'deskripsi' => 'Oli mesin MPX2', 'kategori' => 'OLI', 'harga' => 39000, 'stok' => 500],
            ['nama' => 'Extar', 'sku' => 'EXTAR', 'deskripsi' => 'Oli mesin Extar', 'kategori' => 'OLI', 'harga' => 42000, 'stok' => 500],

            // BAN
            ['nama' => 'Ban IRC 80/80-14', 'sku' => 'BIRC808014', 'deskripsi' => 'Ban motor IRC ukuran 80/80-14', 'kategori' => 'BAN', 'harga' => 150000, 'stok' => 200],
            ['nama' => 'Ban IRC 80/90-14', 'sku' => 'BIRC809014', 'deskripsi' => 'Ban motor IRC ukuran 80/90-14', 'kategori' => 'BAN', 'harga' => 160000, 'stok' => 200],
            ['nama' => 'Ban FDR 70/90-17', 'sku' => 'BFDR709017', 'deskripsi' => 'Ban motor FDR ukuran 70/90-17', 'kategori' => 'BAN', 'harga' => 180000, 'stok' => 200],
            ['nama' => 'Ban FDR 80/90-17', 'sku' => 'BFDR809017', 'deskripsi' => 'Ban motor FDR ukuran 80/90-17', 'kategori' => 'BAN', 'harga' => 190000, 'stok' => 200],
            ['nama' => 'Ban Michelin 120/70-13', 'sku' => 'BMCH1207013', 'deskripsi' => 'Ban motor Michelin ukuran 120/70-13', 'kategori' => 'BAN', 'harga' => 350000, 'stok' => 100],

            // SPAREPART (contoh)
            ['nama' => 'Busi NGK', 'sku' => 'BUSINGK', 'deskripsi' => 'Busi motor NGK', 'kategori' => 'SPAREPART', 'harga' => 25000, 'stok' => 300],
            ['nama' => 'Kampas Rem Depan', 'sku' => 'KRMDPN', 'deskripsi' => 'Kampas rem depan motor', 'kategori' => 'SPAREPART', 'harga' => 50000, 'stok' => 250],
            ['nama' => 'Filter Udara', 'sku' => 'FLTRUDR', 'deskripsi' => 'Filter udara motor', 'kategori' => 'SPAREPART', 'harga' => 30000, 'stok' => 200],
        ];

        foreach ($products as $productData) {
            Produk::create($productData);
        }
    }
}
