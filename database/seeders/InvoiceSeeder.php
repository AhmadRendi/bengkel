<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Items;
use App\Models\Produk;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Produk::all(); // Get all available products
        if ($products->isEmpty()) {
            echo "No products found. Please seed products first.\n";
            return;
        }

        $startDate = Carbon::now()->subYear()->startOfMonth(); // Start from 1 year ago, beginning of the month

        for ($i = 0; $i < 12; $i++) { // Loop for 12 months
            $invoiceDate = $startDate->copy()->addMonths($i);

            // Create an invoice for the current month
            $invoice = Invoice::create([
                'namaPelanggan' => 'Pelanggan ' . $invoiceDate->format('M Y'),
                'alamat' => 'Alamat Pelanggan ' . $invoiceDate->format('M Y'),
                'catatan' => 'Invoice untuk bulan ' . $invoiceDate->format('F Y'),
                'tanggal' => $invoiceDate->toDateString(), // Set the invoice date
                'created_at' => $invoiceDate, // Also set created_at for consistency
                'updated_at' => $invoiceDate,
            ]);

            // Add random items to the invoice (2 to 5 items)
            $numberOfItems = rand(2, 5);
            for ($j = 0; $j < $numberOfItems; $j++) {
                $randomProduct = $products->random(); // Get a random product
                $quantity = rand(1, 10); // Random quantity

                Items::create([
                    'produks_id' => $randomProduct->id,
                    'invoices_id' => $invoice->id,
                    'jumlah' => $quantity,
                    'created_at' => $invoiceDate, // Set item created_at to invoice date
                    'updated_at' => $invoiceDate,
                ]);
            }
        }
    }
}
