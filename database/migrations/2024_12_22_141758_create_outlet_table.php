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
        Schema::create('outlets', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->string('name'); // Nama outlet
            $table->enum('owner_type', ['own', 'investment']); // Jenis pemilik outlet
            $table->text('address')->nullable(); // Alamat outlet
            $table->string('contact')->nullable(); // Kontak outlet (opsional)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status outlet
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
        Schema::dropIfExists('outlets');
    }
};
