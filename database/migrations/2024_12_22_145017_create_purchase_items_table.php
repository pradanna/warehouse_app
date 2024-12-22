<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key
            $table->uuid('purchase_id'); // Foreign key ke purchases
            $table->uuid('item_id'); // Foreign key ke items
            $table->integer('quantity'); // Jumlah yang dibeli
            $table->integer('price'); // Harga per item dalam satuan terkecil (misal: sen)
            $table->integer('total'); // Total harga (quantity * price)
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
