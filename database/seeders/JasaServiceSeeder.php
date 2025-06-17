<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JasaServiceSeeder extends Seeder
{
    public function run(): void
    {
        $bengkels = DB::table('bengkel')->select('id', 'id_user', 'jenis_bengkel')->get();
        $jasas = DB::table('jasas')->select('id', 'jenis_jasa')->get();

        // Cek apakah tabel bengkel atau jasas kosong
        if ($bengkels->isEmpty() || $jasas->isEmpty()) {
            throw new \Exception('Tabel bengkel atau jasas kosong. Pastikan seeder lain dijalankan terlebih dahulu.');
        }

        $jasaServices = [];
        $id = 1; // Mulai ID dari 1
        $hargaJasaRanges = [
            1 => [20000, 50000],   // Ganti Oli
            2 => [50000, 100000],  // Tambal Ban
            3 => [20000, 60000],   // Ganti Kampas Rem
            4 => [30000, 70000],   // Tune Up
        ];

        foreach ($bengkels as $bengkel) {
            // Tentukan jasa yang tersedia berdasarkan jenis bengkel
            $availableJasaIds = $bengkel->jenis_bengkel === 'service'
                ? [1, 2, 3, 4] // Bengkel service: semua jasa
                : [2, 4];       // Bengkel tambal_ban: hanya Tambal Ban dan Tune Up

            // Acak jumlah jasa yang ditawarkan (minimal 1, maksimal semua yang tersedia)
            $numJasa = rand(1, count($availableJasaIds));
            $selectedJasaIds = array_slice($availableJasaIds, 0, $numJasa);

            foreach ($selectedJasaIds as $jasaId) {
                // Cari nama_jasa berdasarkan jasa_id
                $jasa = $jasas->firstWhere('id', $jasaId);
                $jasaServices[] = [
                    'id' => $id++, // ID manual berurutan
                    'id_user' => $bengkel->id_user,
                    'id_bengkel' => $bengkel->id,
                    'jasa_id' => $jasaId,
                    'nama_jasa' => $jasa->jenis_jasa,
                    'harga_jasa' => rand($hargaJasaRanges[$jasaId][0], $hargaJasaRanges[$jasaId][1]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('jasa_services')->insert($jasaServices);
    }
}