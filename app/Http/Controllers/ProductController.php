<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getAllProduct()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Shampoo',
                'sku' => 'SHMP001',
                'category' => 'Sabun',
                'price' => 200000,
                'stock' => 200,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 2,
                'name' => 'Sabun Mandi',
                'sku' => 'SBND002',
                'category' => 'Sabun',
                'price' => 15000,
                'stock' => 120,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 3,
                'name' => 'Pasta Gigi',
                'sku' => 'PG001',
                'category' => 'Perawatan',
                'price' => 18000,
                'stock' => 0,
                'status' => 'Habis',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 4,
                'name' => 'Sabun Cuci Piring',
                'sku' => 'SCP004',
                'category' => 'Sabun',
                'price' => 25000,
                'stock' => 50,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 5,
                'name' => 'Pembersih Lantai',
                'sku' => 'PL005',
                'category' => 'Pembersih',
                'price' => 30000,
                'stock' => 80,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 6,
                'name' => 'Pembersih Kaca',
                'sku' => 'PK006',
                'category' => 'Pembersih',
                'price' => 22000,
                'stock' => 60,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 7,
                'name' => 'Sabun Mandi Cair',
                'sku' => 'SMC007',
                'category' => 'Sabun',
                'price' => 35000,
                'stock' => 90,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 8,
                'name' => 'Pembersih Dapur',
                'sku' => 'PD008',
                'category' => 'Pembersih',
                'price' => 27000,
                'stock' => 40,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 9,
                'name' => 'Sabun Cuci Tangan',
                'sku' => 'SCT009',
                'category' => 'Sabun',
                'price' => 15000,
                'stock' => 100,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 10,
                'name' => 'Pembersih Toilet',
                'sku' => 'PT010',
                'category' => 'Pembersih',
                'price' => 40000,
                'stock' => 30,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],
            [
                'id' => 11,
                'name' => 'Pembersih Karpet',
                'sku' => 'PK011',
                'category' => 'Pembersih',
                'price' => 32000,
                'stock' => 70,
                'status' => 'Ada',
                'image' => asset('img/admin.jpeg'),
            ],

        ];

        return $products;
    }

    public function store(Request $request)
    {
        // Validate the request data
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:50',
                'sku' => 'required|string|max:50',
                'deskripsi' => 'nullable|string',
                'kategori' => 'required|string|max:35',
                'harga' => 'required|integer|min:0',
                'stok' => 'required|integer|min:0',
            ]);
            $product = Produk::create($validatedData);
            return redirect()->route('add-product')->with('success', 'Product saved successfully');
        } catch (\Exception $e) {
            return redirect()->route('add-product')->with('modal_error', $e->getMessage());
        }

    }
}
