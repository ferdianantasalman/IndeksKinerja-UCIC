<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create User
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Rektorat',
            'role' => 'rektorat',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Fakultas FTI',
            'role' => 'fakultas',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Fakultas FEB',
            'role' => 'fakultas',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi TI',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi SI',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi DKV',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi MI',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi KA',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi MNJ',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi AK',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Prodi MB',
            'role' => 'prodi',
            'password' => bcrypt(12345),
        ]);

        User::create([
            'name' => 'Dosen A',
            'nidn' => '12345638',
            'role' => 'dosen',
            'password' => bcrypt(12345),
        ]);
    }
}
