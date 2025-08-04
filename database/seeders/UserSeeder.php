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
     */
    public function run(): void
    {
        //

        $data = [
            [
                'nik' => '11232323',
                'nama' => 'UserAdmin',
                'user' => 'UserAdmin',
                'password' => Hash::make('UserAdmin2025'),
                'roles' => 'Admin',
                'is_active' => 1
            ],
            [
                'nik' => '11232324',
                'nama' => 'User',
                'user' => 'User',
                'password' => Hash::make('User2025'),
                'roles' => 'User',
                'is_active' => 1
            ],
        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
