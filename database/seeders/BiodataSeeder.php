<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $biodatas = [
            // contoh biodata admin
            [
                'nama' => 'Winang',
                'alamat' => 'Bandung',
                'telepon' => '08814595526',
            ],

            // contoh biodata guru
            [
                'nama' => 'Salman Mustapa',
                'alamat' => 'Gorontalo',
                'telepon' => '082154488769',
            ],

            // contoh biodata siswa
            [
                'nama' => 'Adik Winang',
                'alamat' => 'Bandung',
                'telepon' => '08814595526',
            ],

        ];

        foreach ($biodatas as $biodata) {
            Biodata::create($biodata);
        }
    }
}
