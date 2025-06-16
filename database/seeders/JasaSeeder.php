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
        $jasas = [
            [
                'jenis_jasa' => 'Ganti Oli',
                'deskripsi' => 'Penggantian oli mesin dengan oli berkualitas sesuai spesifikasi motor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_jasa' => 'Tambal Ban',
                'deskripsi' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_jasa' => 'Ganti Kampas Rem',
                'deskripsi' => 'Penggantian kampas rem depan atau belakang untuk performa pengereman optimal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_jasa' => 'Tune Up',
                'deskripsi' => 'Penyesuaian performa mesin untuk meningkatkan efisiensi bahan bakar dan tenaga.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('jasas')->insert($jasas);
    }
}
