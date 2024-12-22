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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key untuk supplier
            $table->string('name'); // Nama supplier
            $table->string('contact_person')->nullable(); // Nama kontak person (opsional)
            $table->string('phone')->nullable(); // Nomor telepon supplier (opsional)
            $table->text('address')->nullable(); // Alamat supplier (opsional)
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
        Schema::dropIfExists('suppliers');
    }
};
