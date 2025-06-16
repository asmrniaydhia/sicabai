<?php

namespace Database\Seeders;

use App\Models\Jasa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jasas')->insert([
            // Bengkel Ban Murah (id_bengkel: 14)
            [
                'id_user' => 6,
                'id_bengkel' => 14,
                'jenis_jasa' => 'Tambal Ban Tubeless',
                'harga' => 15000,
                'deskripsi' => 'Layanan tambal ban tubeless dengan kualitas terbaik dan harga terjangkau',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 6,
                'id_bengkel' => 14,
                'jenis_jasa' => 'Tambal Ban Dalam',
                'harga' => 12000,
                'deskripsi' => 'Tambal ban dalam untuk motor dan mobil dengan garansi kualitas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 6,
                'id_bengkel' => 14,
                'jenis_jasa' => 'Ganti Ban',
                'harga' => 25000,
                'deskripsi' => 'Layanan penggantian ban baru dengan berbagai merk terpercaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bengkel Ban Prima (id_bengkel: 19)
            [
                'id_user' => 11,
                'id_bengkel' => 19,
                'jenis_jasa' => 'Tambal Ban Motor',
                'harga' => 18000,
                'deskripsi' => 'Spesialis tambal ban motor dengan teknologi modern',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 11,
                'id_bengkel' => 19,
                'jenis_jasa' => 'Tambal Ban Mobil',
                'harga' => 35000,
                'deskripsi' => 'Layanan tambal ban mobil cepat dan berkualitas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 11,
                'id_bengkel' => 19,
                'jenis_jasa' => 'Balancing Roda',
                'harga' => 50000,
                'deskripsi' => 'Layanan balancing roda untuk kenyamanan berkendara',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bengkel Cepat Tambal (id_bengkel: 12)
            [
                'id_user' => 14,
                'id_bengkel' => 12,
                'jenis_jasa' => 'Tambal Ban Express',
                'harga' => 20000,
                'deskripsi' => 'Layanan tambal ban super cepat, selesai dalam 15 menit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 14,
                'id_bengkel' => 12,
                'jenis_jasa' => 'Tambal Ban Bocor Halus',
                'harga' => 25000,
                'deskripsi' => 'Khusus menangani ban bocor halus yang sulit dideteksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bengkel Ban Jaya (id_bengkel: 16)
            [
                'id_user' => 8,
                'id_bengkel' => 16,
                'jenis_jasa' => 'Tambal Ban Truk',
                'harga' => 16000, // Tambahkan harga
                'deskripsi' => 'Spesialis tambal ban kendaraan besar seperti truk dan bus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 8,
                'id_bengkel' => 16,
                'jenis_jasa' => 'Tambal Ban Sepeda Motor',
                'harga' => 16000, // Tambahkan harga
                'deskripsi' => 'Tambal ban sepeda motor dengan harga ekonomis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 8,
                'id_bengkel' => 16,
                'jenis_jasa' => 'Vulkanisir Ban',
                'harga' => 16000, // Tambahkan harga
                'deskripsi' => 'Layanan vulkanisir ban untuk memperpanjang umur ban',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
