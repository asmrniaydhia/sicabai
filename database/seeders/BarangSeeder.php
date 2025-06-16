<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bengkels = DB::table('bengkel')->select('id', 'id_user')->get(); // Ambil id dan id_user dari bengkel
        $spareparts = DB::table('spareparts')->pluck('id')->all(); // Ambil semua ID sparepart

        $barangs = [];
        foreach ($bengkels as $bengkel) {
            foreach ($spareparts as $sparepartId) {
                $barangs[] = [
                    'id_user' => $bengkel->id_user, // Ambil id_user dari bengkel
                    'id_bengkel' => $bengkel->id,   // Ambil id bengkel
                    'sparepart_id' => $sparepartId,
                    'merk' => $this->generateRandomMerk(),
                    'harga_jual' => rand(50000, 500000), // Harga acak antara 50.000 hingga 500.000
                    'stok' => rand(1, 20), // Stok acak antara 1 hingga 20
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('barangs')->insert($barangs);
    }

    private function generateRandomMerk()
    {
        $merks = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'Generic'];
        return $merks[array_rand($merks)];
    }

}
