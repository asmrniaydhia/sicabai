<?php

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
        Schema::create('jasa_services', function (Blueprint $table) {
        $table->id();
        // Kolom ini akan terhubung ke tabel 'jasas' (kategori)
        $table->foreignId('jasa_id')->constrained()->onDelete('cascade');
        $table->string('nama_jasa'); // Nama jasa spesifik, contoh: Ganti Oli
        $table->unsignedInteger('harga_jasa');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_services');
    }
};
