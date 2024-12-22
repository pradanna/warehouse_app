<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_mutations', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key
            $table->uuid('item_id'); // Foreign key ke items
            $table->integer('quantity_change'); // Perubahan jumlah stok
            $table->enum('mutation_type', ['purchase', 'sale', 'adjustment', 'return']); // Jenis perubahan stok
            $table->timestamp('mutation_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Waktu perubahan
            $table->uuid('user_id'); // Pengguna yang melakukan perubahan stok
            $table->text('notes')->nullable(); // Catatan terkait perubahan stok
            $table->uuid('related_transaction_id')->nullable(); // ID transaksi terkait (jika ada)

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_mutations');
    }
};
