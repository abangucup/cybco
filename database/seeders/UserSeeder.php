<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            // contoh user admin
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'biodata_id' => 1,
            ],

            // contoh user guru
            [
                'username' => '123456',
                'email' => 'guru@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
                'biodata_id' => 2,
            ],

            // contoh user siswa
            [
                'username' => '01234',
                'email' => 'siswa@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'biodata_id' => 3,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
