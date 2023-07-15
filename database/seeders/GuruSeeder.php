<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = [
            [
                'nuptk' => '123456',
                'biodata_id' => 2,
            ],
        ];

        foreach ($guru as $data) {
            Guru::create($data);
        }
    }
}
