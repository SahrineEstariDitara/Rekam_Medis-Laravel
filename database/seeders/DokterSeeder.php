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
                'email' => 'dokter1@dokter.rekammedis.com',
                'nama' => 'Dr. Ahmad Hidayat, Sp.PD',
                'spesialis' => 'Penyakit Dalam',
                'no_telp' => '081234567801',
                'alamat' => 'Jl. Kesehatan No. 10, Jakarta Pusat',
            ],
            [
                'email' => 'dokter2@dokter.rekammedis.com',
                'nama' => 'Dr. Siti Nurhaliza, Sp.A',
                'spesialis' => 'Anak',
                'no_telp' => '081234567802',
                'alamat' => 'Jl. Medika No. 25, Jakarta Selatan',
            ],
            [
                'email' => 'dokter3@dokter.rekammedis.com',
                'nama' => 'Dr. Budi Santoso, Sp.OG',
                'spesialis' => 'Kandungan',
                'no_telp' => '081234567803',
                'alamat' => 'Jl. Rumah Sakit No. 5, Jakarta Barat',
            ],
        ];

        foreach ($dokters as $dokterData) {
            $user = User::where('email', $dokterData['email'])->first();
            
            if ($user) {
                Dokter::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama' => $dokterData['nama'],
                        'spesialis' => $dokterData['spesialis'],
                        'no_telp' => $dokterData['no_telp'],
                        'alamat' => $dokterData['alamat'],
                    ]
                );
            }
        }
    }
}
