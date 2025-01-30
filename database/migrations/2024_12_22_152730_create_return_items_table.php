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
        Schema::create('returnsItem', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('item_id');
            $table->integer('quantity');
            $table->enum('return_type', ['supplier', 'warehouse']);
            $table->uuid('transaction_id')->nullable(); // Untuk transaksi yang terkait
            $table->uuid('purchase_id')->nullable(); // Untuk pembelian yang terkait, jika retur ke supplier
            $table->dateTime('return_date');
            $table->string('reason');
            $table->uuid('user_id');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Relasi ke item, transaksi, dan purchase
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('set null');
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
        Schema::dropIfExists('returns');
    }
};
