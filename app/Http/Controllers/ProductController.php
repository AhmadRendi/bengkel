<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getAllProduct()
    {
        $products = Produk::all()->where('is_active', true);
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
            return redirect()->route('dashboard')->with('success', 'Product saved successfully');
        } catch (\Exception $e) {
            return redirect()->route('add-product')->with('modal_error', $e->getMessage());
        }
    }

    public function findProductById($id)
    {
        $product = Produk::findOrFail($id);
        if (empty($product)) {
            return response()->json(['error' => 'Error'], 404);
        }
        return response()->json($product);
    }

    public function update(Request $request)
    {
        // Validate the request data
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer|exists:produks,id',
                'nama' => 'required|string|max:50',
                'sku' => 'required|string|max:50',
                'deskripsi' => 'nullable|string',
                'kategori' => 'required|string|max:35',
                'harga' => 'required|integer|min:0',
                'stok' => 'required|integer|min:0',
            ]);

            $product = Produk::findOrFail($validatedData['id']);
            $product->update($validatedData);

            return redirect()->route('products')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('products')->with('modal_error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Produk::find($id);
            $product->delete();
            return response()->json(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user'], 500);
        }
    }
}
