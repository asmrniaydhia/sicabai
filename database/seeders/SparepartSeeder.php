<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spareparts = [
            [
                'nama_sparepart' => 'Oli Mesin',
                'deskripsi' => 'Oli mesin berkualitas tinggi untuk motor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sparepart' => 'Ban Motor',
                'deskripsi' => 'Ban tahan lama untuk berbagai tipe motor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sparepart' => 'Rantai Motor',
                'deskripsi' => 'Rantai tahan karat untuk motor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sparepart' => 'Kampas Rem',
                'deskripsi' => 'Kampas rem berkualitas untuk keamanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_sparepart' => 'Aki Motor',
                'deskripsi' => 'Aki motor dengan daya tahan lama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('spareparts')->insert($spareparts);
    }
}
