<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key
            $table->uuid('transaction_id'); // Foreign key ke transaksi
            $table->integer('amount'); // Jumlah pembayaran menggunakan integer
            $table->enum('payment_status', ['paid', 'unpaid', 'partial']); // Status pembayaran (lunas, belum dibayar, sebagian)
            $table->string('payment_method'); // Metode pembayaran (misalnya: transfer, tunai, dll)
            $table->string('payment_proof')->nullable(); // Bukti pembayaran (foto atau file)
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
