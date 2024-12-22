<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_adjustments', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key
            $table->uuid('item_id'); // Foreign key ke item
            $table->integer('adjustment_qty'); // Jumlah perubahan stok
            $table->enum('adjustment_type', ['increase', 'decrease']); // Tipe penyesuaian (penambahan atau pengurangan)
            $table->string('reason'); // Alasan penyesuaian stok
            $table->uuid('user_id'); // ID user yang melakukan penyesuaian
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_adjustments');
    }
};
