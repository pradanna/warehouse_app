<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key untuk transaction item
            $table->uuid('transaction_id')->constrained('transactions')->onDelete('cascade'); // Relasi ke transaksi
            $table->uuid('item_id')->constrained('items')->onDelete('cascade'); // Relasi ke item
            $table->integer('quantity'); // Jumlah item yang terlibat dalam transaksi
            $table->decimal('price', 15, 2); // Harga per item
            $table->decimal('total', 15, 2); // Total harga (price * quantity)
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
        Schema::dropIfExists('transaction_items');
    }
};
