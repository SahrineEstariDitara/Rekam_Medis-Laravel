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
            ['email' => 'admin@admin.rekammedis.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Staff
        User::firstOrCreate(
            ['email' => 'staff@staff.rekammedis.com'],
            [
                'name' => 'Staff Sistem',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        // Dokter
        User::firstOrCreate(
            ['email' => 'dokter1@dokter.rekammedis.com'],
            [
                'name' => 'Dr. Ahmad Hidayat',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dokter2@dokter.rekammedis.com'],
            [
                'name' => 'Dr. Siti Nurhaliza',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dokter3@dokter.rekammedis.com'],
            [
                'name' => 'Dr. Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        // Pasien
        User::firstOrCreate(
            ['email' => 'pasien1@pasien.rekammedis.com'],
            [
                'name' => 'Andi Wijaya',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien2@pasien.rekammedis.com'],
            [
                'name' => 'Sari Indah',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien3@pasien.rekammedis.com'],
            [
                'name' => 'Rudi Hartono',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien4@pasien.rekammedis.com'],
            [
                'name' => 'Maya Sari',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pasien5@pasien.rekammedis.com'],
            [
                'name' => 'Dedi Kurniawan',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );
    }
}
