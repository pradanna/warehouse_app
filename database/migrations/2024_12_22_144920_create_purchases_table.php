<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key
            $table->uuid('supplier_id'); // Foreign key ke supplier
            $table->date('purchase_date');
            $table->integer('total_amount'); // Total pembelian dalam satuan terkecil (sen)
            $table->enum('payment_status', ['unpaid', 'paid', 'partial']);
            $table->enum('status', ['pending', 'completed', 'canceled']);
            $table->string('receipt_image')->nullable();
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
