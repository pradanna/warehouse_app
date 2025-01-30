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
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('amount');
            $table->string('expense_type'); // Contoh: "Pembelian Barang", "Gaji", dll
            $table->string('description')->nullable(); // Keterangan tambahan
            $table->string('payment_method'); // Contoh: "Cash", "Bank Transfer"
            $table->date('date');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
