<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'email' => 'dokter1@example.com',
                'nama' => 'Dr. Ahmad Hidayat, Sp.PD',
                'spesialis' => 'Penyakit Dalam',
            ],
            [
                'email' => 'dokter2@example.com',
                'nama' => 'Dr. Siti Nurhaliza, Sp.A',
                'spesialis' => 'Anak',
            ],
            [
                'email' => 'dokter3@example.com',
                'nama' => 'Dr. Budi Santoso, Sp.OG',
                'spesialis' => 'Kandungan',
            ],
        ];

        foreach ($dokters as $dokterData) {
            $user = User::where('email', $dokterData['email'])->first();
            
            if ($user) {
                Dokter::create([
                    'user_id' => $user->id,
                    'nama' => $dokterData['nama'],
                    'spesialis' => $dokterData['spesialis'],
                ]);
            }
        }
    }
}
