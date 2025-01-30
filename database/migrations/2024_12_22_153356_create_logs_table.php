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
        Schema::create('logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // Relasi ke pengguna yang melakukan aksi
            $table->string('log_type'); // Jenis log (stock_mutation, purchase, return, dll)
            $table->text('log_description'); // Deskripsi peristiwa yang terjadi
            $table->uuid('reference_id')->nullable(); // ID referensi terkait log (misalnya transaksi atau purchase)
            $table->timestamps(); // Created_at dan updated_at

            // Relasi ke user
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
        Schema::dropIfExists('logs');
    }
};
