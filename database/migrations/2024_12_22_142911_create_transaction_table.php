<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->uuid('outlet_id')->nullable()->constrained('outlets')->onDelete('set null'); // Menghubungkan transaksi dengan outlet (opsional)
            $table->timestamp('date'); // Tanggal transaksi
            $table->integer('total_amount'); // Total jumlah transaksi
            $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('unpaid'); // Status pembayaran
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending'); // Status transaksi
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
