<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produks_id');
            $table->unsignedInteger('jumlah');
            $table->unsignedBigInteger('invoices_id');
            $table->timestamps();

            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('produks_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
