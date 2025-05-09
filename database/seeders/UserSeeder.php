<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password')
            ]
        );
        $admin->assignRole('admin');

        // Guru
        $guru = User::firstOrCreate(
            ['email' => 'guru@gmail.com'],
            [
                'name' => 'Guru Matematika',
                'password' => Hash::make('password')
            ]
        );
        $guru->assignRole('guru');

        // Siswa
        $siswa = User::firstOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'name' => 'Siswa Bagus',
                'password' => Hash::make('password')
            ]
        );
        $siswa->assignRole('siswa');
    }
}
