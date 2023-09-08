<?php

namespace Database\Seeders;

use App\Models\Pertanyaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaans = [
            [
                'pertanyaan' => 'Apakah Anda pernah terlambat datang ke sekolah dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah meninggalkan kelas tanpa izin guru dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah menggunakan gadget secara diam-diam di dalam kelas dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah melakukan pelecehan verbal terhadap teman sekelas dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah membolos sekolah tanpa alasan yang sah dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah terlibat dalam perkelahian atau tindakan kekerasan dengan siswa lain dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah menyalin tugas atau pekerjaan rumah dari teman sekelas dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah membawa barang terlarang ke dalam lingkungan sekolah dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah merusak fasilitas atau properti sekolah dalam sebulan terakhir?'
            ],
            [
                'pertanyaan' => 'Apakah Anda pernah melakukan kecurangan selama ujian atau tes di sekolah dalam sebulan terakhir?'
            ],
        ];

        foreach ($pertanyaans as $pertanyaan) {
            Pertanyaan::create($pertanyaan);
        }
    }
}
