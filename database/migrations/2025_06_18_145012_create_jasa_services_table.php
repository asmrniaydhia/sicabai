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
        $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Merujuk ke tabel users
        $table->foreignId('id_bengkel')->constrained('bengkel')->onDelete('cascade'); // Merujuk ke tabel bengkel
        $table->foreignId('jasa_id')->constrained()->onDelete('cascade');
        $table->string('nama_jasa'); // Nama jasa spesifik, contoh: Ganti Oli
        $table->unsignedInteger('harga_jasa');
        $table->timestamps();

        $table->index('id_user');
        $table->index('id_bengkel');
        $table->index('jasa_id');
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
