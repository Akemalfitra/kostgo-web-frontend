<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_kosts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // Untuk URL yang SEO-friendly
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('type')->comment('putra, putri, campur'); // Jenis kos
            $table->decimal('price', 10, 0); // Harga per bulan
            $table->json('facilities')->nullable(); // Fasilitas (contoh: AC, WiFi, KM Dalam) dalam format JSON array
            $table->json('images')->nullable(); // Path gambar dalam format JSON array
            $table->double('latitude', 10, 7)->nullable(); // Koordinat peta
            $table->double('longitude', 10, 7)->nullable(); // Koordinat peta
            $table->string('owner_phone')->nullable();
            $table->string('owner_whatsapp')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};