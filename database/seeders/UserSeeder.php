<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Dokter
        User::create([
            'name' => 'Dr. Ahmad Hidayat',
            'email' => 'dokter1@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'name' => 'Dr. Siti Nurhaliza',
            'email' => 'dokter2@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'dokter3@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        // Pasien
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'pasien1@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        User::create([
            'name' => 'Sari Indah',
            'email' => 'pasien2@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        User::create([
            'name' => 'Rudi Hartono',
            'email' => 'pasien3@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        User::create([
            'name' => 'Maya Sari',
            'email' => 'pasien4@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        User::create([
            'name' => 'Dedi Kurniawan',
            'email' => 'pasien5@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
