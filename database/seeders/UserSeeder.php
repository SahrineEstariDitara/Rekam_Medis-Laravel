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
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Staff
        User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff Sistem',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        // Dokter
        User::firstOrCreate(
            ['email' => 'dokter1@example.com'],
            [
                'name' => 'Dr. Ahmad Hidayat',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dokter2@example.com'],
            [
                'name' => 'Dr. Siti Nurhaliza',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dokter3@example.com'],
            [
                'name' => 'Dr. Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        // Pasien
        User::firstOrCreate(
            ['email' => 'pasien1@example.com'],
            [
                'name' => 'Andi Wijaya',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien2@example.com'],
            [
                'name' => 'Sari Indah',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien3@example.com'],
            [
                'name' => 'Rudi Hartono',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien4@example.com'],
            [
                'name' => 'Maya Sari',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien5@example.com'],
            [
                'name' => 'Dedi Kurniawan',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );
    }
}
