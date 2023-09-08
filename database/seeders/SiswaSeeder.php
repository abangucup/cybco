<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = [
            [
                'nis' => '01234',
                'kelas' => '7A',
                'nama_ortu' => 'Ayahanda Winang',
                'telepon_ortu' => '0811111111111',
                'biodata_id' => 3,
            ],
        ];

        foreach ($siswa as $data) {
            Siswa::create($data);
        }
    }
}
