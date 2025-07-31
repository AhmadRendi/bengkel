<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Invoice;
use App\Models\Items;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DummyTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting dummy transaction seeder...');

        $products = Produk::all();

        if ($products->isEmpty()) {
            $this->command->error('Please seed products first!');
            return;
        }

        DB::beginTransaction();
        try {
            for ($i = 4; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $this->command->info("Generating data for: " . $date->format('F Y'));

                $numberOfInvoices = rand(15, 40);

                for ($j = 0; $j < $numberOfInvoices; $j++) {
                    $invoiceDate = $date->copy()->day(rand(1, $date->daysInMonth))->addHours(rand(8, 17));

                    // Create a very basic invoice
                    $invoice = Invoice::create([
                        'namaPelanggan' => 'Pelanggan Acak ' . rand(1, 100),
                        'tanggal' => $invoiceDate,
                        'created_at' => $invoiceDate,
                        'updated_at' => $invoiceDate,
                    ]);

                    // Add items to the invoice
                    $numberOfItems = rand(1, 5);
                    $productsToSample = min($numberOfItems, $products->count());
                    $selectedProducts = $products->random($productsToSample);

                    foreach ($selectedProducts as $product) {
                        $quantity = rand(1, 5);
                        Items::create([
                            'invoices_id' => $invoice->id,
                            'produks_id' => $product->id,
                            'jumlah' => $quantity,
                        ]);
                    }
                }
            }

            DB::commit();
            $this->command->info('Dummy transaction seeder finished successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('An error occurred: ' . $e->getMessage());
        }
    }
}