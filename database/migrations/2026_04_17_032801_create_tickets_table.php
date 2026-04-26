<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // relasi ke events
            $table->foreignId('event_id')
                  ->constrained()
                  ->onDelete('cascade');

            // tipe tiket
            $table->enum('type', ['vip', 'regular']);

            // deskripsi tiket
            $table->text('description')->nullable();

            // harga tiket
            $table->integer('price');

            // stok tiket
            $table->integer('stock');

            // batas maksimal pembelian per user
            $table->integer('max_per_user')->default(5);

            // biar tidak ada tipe tiket ganda dalam 1 event
            $table->unique(['event_id', 'type']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
