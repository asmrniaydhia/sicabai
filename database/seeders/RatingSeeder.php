<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $bengkels = DB::table('bengkel')->select('id')->get();
        $users = DB::table('users')->whereNotIn('id', DB::table('bengkel')->pluck('id_user'))->pluck('id')->all();

        // Cek apakah tabel bengkel atau users kosong
        if ($bengkels->isEmpty() || empty($users)) {
            throw new \Exception('Tabel bengkel atau users kosong. Pastikan seeder lain dijalankan terlebih dahulu.');
        }

        $ratings = [];
        $id = 1; // Mulai ID dari 1
        $ulasanOptions = [
            'Pelayanan sangat baik, mekanik ramah, dan cepat selesai.',
            'Servis motor oke, harga terjangkau, recommended!',
            'Tambal ban cepat, tapi tempat agak kotor.',
            'Harga murah tapi antri lama.',
            'Pelayanan cepat dan ramah, pasti kembali lagi!',
            'Hasil servis memuaskan, tapi harga sedikit mahal.',
            'Mekanik profesional, lokasi strategis.',
            'Tambal ban cukup baik, tapi pelayanan kurang ramah.',
            'Jasa penjemputan sangat membantu, servis bagus.',
            'Tempat bersih, tapi waktu tunggu agak lama.'
        ];

        foreach ($bengkels as $bengkel) {
            // Jumlah rating acak per bengkel (minimal 2, maksimal 5)
            $numRatings = rand(2, 5);
            for ($i = 0; $i < $numRatings; $i++) {
                $ratings[] = [
                    'id' => $id++, // ID manual berurutan
                    'id_user' => $users[array_rand($users)], // Pilih user acak
                    'id_bengkel' => $bengkel->id,
                    'rating' => rand(1, 5), // Rating acak 1-5
                    'ulasan' => $ulasanOptions[array_rand($ulasanOptions)], // Ulasan acak
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('ratings')->insert($ratings);
    }
}