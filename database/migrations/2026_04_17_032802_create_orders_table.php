<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // relasi ke user
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // total harga
            $table->integer('total_price');

            // status order
            $table->enum('status', ['pending', 'paid', 'canceled'])
                  ->default('pending');

            // batas waktu pembayaran
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
