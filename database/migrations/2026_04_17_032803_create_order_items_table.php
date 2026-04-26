<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // relasi ke orders
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');

            // relasi ke tickets
            $table->foreignId('ticket_id')
                  ->constrained()
                  ->onDelete('cascade');

            // jumlah tiket
            $table->integer('quantity');

            // harga saat transaksi
            $table->integer('price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
