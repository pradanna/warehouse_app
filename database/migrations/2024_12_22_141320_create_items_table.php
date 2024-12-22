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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->string('name'); // Nama barang
            $table->string('sku')->unique()->nullable(); // SKU barang (opsional)
            $table->text('description')->nullable(); // Deskripsi barang
            $table->string('unit'); // Satuan barang (pcs, kg, liter, dll)
            $table->uuid('category_id')->nullable(); // Foreign key untuk kategori
            $table->integer('price1'); // Harga untuk outlet pertama
            $table->integer('price2'); // Harga untuk outlet kedua
            $table->integer('purchase_price'); // Harga pembelian / harga kulakan
            $table->integer('current_stock')->default(0); // Stok saat ini
            $table->integer('min_stock')->nullable(); // Stok minimum (opsional)
            $table->integer('max_stock')->nullable(); // Stok maksimum (opsional)
            $table->enum('status', ['available', 'out of stock', 'discontinued'])->default('available'); // Status barang
            $table->timestamps(); // created_at dan updated_at

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
