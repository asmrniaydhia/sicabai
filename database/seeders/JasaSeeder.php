<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jasa;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data jasa yang akan dimasukkan
        $data_jasa = [
            [
                'jenis_jasa' => 'Tambal Ban Tubeless',
                'deskripsi' => 'Perbaikan kebocoran ban tubeless dari luar menggunakan karet strip (cacing). Cepat dan praktis.',
            ],
            [
                'jenis_jasa' => 'Tambal Ban Dalam',
                'deskripsi' => 'Penambalan kebocoran pada ban dalam konvensional menggunakan metode press panas yang lebih awet.',
            ],
            [
                'jenis_jasa' => 'Ganti Ban',
                'deskripsi' => 'Jasa bongkar pasang ban luar, baik ban lama maupun ban baru. Harga tidak termasuk pembelian ban.',
            ],
            [
                'jenis_jasa' => 'Isi Angin Nitrogen',
                'deskripsi' => 'Pengisian angin ban dengan gas Nitrogen untuk tekanan lebih stabil dan menjaga suhu ban.',
            ],
            [
                'jenis_jasa' => 'Balancing Roda',
                'deskripsi' => 'Menyeimbangkan putaran roda agar tidak bergetar pada kecepatan tinggi untuk kenyamanan dan keamanan berkendara.',
            ],
            [
                'jenis_jasa' => 'Press Velg / Pelek',
                'deskripsi' => 'Jasa perbaikan untuk meluruskan velg (pelek) yang bengkok atau penyok akibat benturan keras.',
            ],
        ];

        // Looping untuk memasukkan setiap data ke dalam database
        foreach ($data_jasa as $jasa) {
            Jasa::create($jasa);
        }
    }
}
