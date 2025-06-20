<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin sistem',
                'email'=> 'admin@gmail.com',
                'nik'  => '1234567890',
                'tgl_lahir' => date('Y-m-d', strtotime('2001-01-15')),
                'role' => 'admin',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'user karyawan',
                'email'=> 'user@gmail.com',
                'nik'  => '9182823278',
                'tgl_lahir' => date('Y-m-d', strtotime('2001-01-15')),
                'role' => 'user',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
