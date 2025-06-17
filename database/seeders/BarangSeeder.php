<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $bengkels = DB::table('bengkel')->select('id', 'id_user')->get();
        $spareparts = DB::table('spareparts')->pluck('id')->all();

        // Cek apakah tabel bengkel atau spareparts kosong
        if ($bengkels->isEmpty() || empty($spareparts)) {
            throw new \Exception('Tabel bengkel atau spareparts kosong. Pastikan seeder lain dijalankan terlebih dahulu.');
        }

        $barangs = [];
        $id = 1; // Mulai ID dari 1
        $hargaRanges = [
            1 => [50000, 150000],   // Oli Mesin
            2 => [200000, 500000],  // Ban Motor
            3 => [100000, 300000],  // Rantai Motor
            4 => [50000, 200000],   // Kampas Rem
            5 => [150000, 400000],  // Aki Motor
        ];
        $hargaJasaRanges = [
            1 => [20000, 50000],    // Oli Mesin
            2 => [50000, 100000],   // Ban Motor
            3 => [30000, 70000],    // Rantai Motor
            4 => [20000, 60000],    // Kampas Rem
            5 => [40000, 80000],    // Aki Motor
        ];

        foreach ($bengkels as $bengkel) {
            foreach ($spareparts as $sparepartId) {
                $barangs[] = [
                    'id' => $id++, // ID manual berurutan
                    'id_user' => $bengkel->id_user,
                    'id_bengkel' => $bengkel->id,
                    'sparepart_id' => $sparepartId,
                    'merk' => $this->generateRandomMerk($sparepartId),
                    'harga_jual' => rand($hargaRanges[$sparepartId][0], $hargaRanges[$sparepartId][1]),
                    'harga_jasa' => rand($hargaJasaRanges[$sparepartId][0], $hargaJasaRanges[$sparepartId][1]), // Tambahkan harga_jasa
                    'stok' => rand(1, 20),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('barangs')->insert($barangs);
    }

    private function generateRandomMerk($sparepartId)
    {
        $merkBySparepart = [
            1 => ['Shell', 'Pertamina', 'Castrol'],        // Oli Mesin
            2 => ['Michelin', 'Pirelli', 'Swallow'],       // Ban Motor
            3 => ['DID', 'EK', 'Regina'],                  // Rantai Motor
            4 => ['Bosch', 'NGK', 'Aspira'],               // Kampas Rem
            5 => ['Yuasa', 'GS Astra', 'Motobatt'],        // Aki Motor
        ];
        $merks = $merkBySparepart[$sparepartId] ?? ['Generic'];
        return $merks[array_rand($merks)];
    }
}