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
        Schema::create('bengkel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('whatsapp', 20); // Diperpanjang untuk keamanan
            $table->enum('jenis_bengkel', ['service', 'tambal_ban']);
            $table->string('foto_bengkel', 255);
            $table->text('alamat');
            $table->enum('jasa_penjemputan', ['ada', 'tidak']);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->json('hari_libur')->nullable();
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bengkel');
    }
};
