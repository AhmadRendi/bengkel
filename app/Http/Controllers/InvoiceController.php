<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Invoice;
use App\Models\Items;

class InvoiceController extends Controller
{

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'namaPelanggan' => 'required|string|max:255',
                'catatan' => 'nullable|string|max:1000',
                'alamat' => 'nullable|string|max:500',
                'produk_ids' => 'required|array',
                'jumlah' => 'required|array',
            ]);

            // Simpan data invoice
            $invoice = new Invoice();
            $invoice->namaPelanggan = $request->namaPelanggan;
            $invoice->catatan = $request->catatan ?? "Tidak Tersedia";
            $invoice->alamat = $request->alamat ?? "Tidak Tersedia";
            $invoice->save();

            // // Simpan item terkait dengan invoice
            foreach ($request->produk_ids as $productId) {
                $item = new Items();
                $item->produks_id = $productId;
                $item->jumlah = $request->jumlah[$productId];
                ;
                $item->invoices_id = $invoice->id;
                $item->save();
            }

            return redirect()->route('add-invoice')->with('success', 'Invoice berhasil dibuat!');
        } catch (\Exception $e) {
            Log::info('Tidak ada');
            return redirect()->route('add-invoice')->with('modal_error', 'Gagal menyimpan invoice: ' . $e->getMessage());
        }
    }

    public function findAllInvoices()
    {
        try {
            $invoices = Invoice::all();
            return $invoices;
        } catch (\Exception $e) {
            return redirect()->route('invoices')->with('modal_error', 'Gagal mengambil data invoice: ' . $e->getMessage());
        }
    }

    public function findInvoiceById($id)
    {
        try {
            $invoice = Invoice::with('items.produk')->findOrFail($id);

            return response()->json([
                'invoice' => $invoice,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('invoices')->with('modal_error', 'Gagal mengambil data invoice: ' . $e->getMessage());
        }
    }
}
