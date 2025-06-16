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
            Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Merujuk ke tabel users
            $table->foreignId('id_bengkel')->constrained('bengkel')->onDelete('cascade'); // Merujuk ke tabel bengkel
            $table->foreignId('sparepart_id')->constrained('spareparts')->onDelete('cascade'); // Eksplisitkan tabel spareparts
            $table->string('merk', 100); // Batasi panjang merk
            $table->decimal('harga_jual', 12, 2);
            $table->decimal('harga_jasa', 12, 2);
            $table->unsignedInteger('stok'); // Tambahkan unsigned untuk stok
            $table->timestamps();

            // Tambahkan indeks untuk performa
            $table->index('id_user');
            $table->index('id_bengkel');
            $table->index('sparepart_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
