<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
                [
                    'id_user' => 2, // Regular User (from users table, ID 2)
                    'id_bengkel' => 11, // Bengkel Maju Jaya
                    'rating' => 5,
                    'ulasan' => 'Pelayanan sangat baik, mekanik ramah, dan cepat selesai.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 12, // Bengkel Cepat Tambal
                    'rating' => 3,
                    'ulasan' => 'Tambal ban cepat, tapi tempat agak kotor.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 13, // Bengkel Motor Sejahtera
                    'rating' => 4,
                    'ulasan' => 'Servis motor oke, harga terjangkau, ada jasa penjemputan.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 14, // Bengkel Ban Murah
                    'rating' => 2,
                    'ulasan' => 'Harga murah tapi antri lama.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 15, // Bengkel Servis Cepat
                    'rating' => 4,
                    'ulasan' => 'Pelayanan cepat dan ramah, recommended!',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 16, // Bengkel Ban Jaya
                    'rating' => 3,
                    'ulasan' => 'Hasil tambal ban cukup baik, tapi tidak ada jasa penjemputan.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 17, // Bengkel Motor Prima
                    'rating' => 5,
                    'ulasan' => 'Servis motor sangat memuaskan, mekanik profesional.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 18, // Bengkel Jaya Abadi
                    'rating' => 4,
                    'ulasan' => 'Pelayanan baik, lokasi strategis, harga wajar.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 19, // Bengkel Ban Prima
                    'rating' => 3,
                    'ulasan' => 'Tambal ban cepat, tapi pelayanan kurang ramah.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id_user' => 2,
                    'id_bengkel' => 20, // Bengkel Motor Mandiri
                    'rating' => 4,
                    'ulasan' => 'Servis motor bagus, ada jasa penjemputan, tapi agak mahal.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
    }
}
