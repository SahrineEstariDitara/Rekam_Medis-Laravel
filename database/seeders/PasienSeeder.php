<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'email' => 'pasien1@example.com',
                'no_rm' => 'RM2026001',
                'nama' => 'Andi Wijaya',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-05-15',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat, DKI Jakarta',
            ],
            [
                'email' => 'pasien2@example.com',
                'no_rm' => 'RM2026002',
                'nama' => 'Sari Indah',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1985-08-20',
                'alamat' => 'Jl. Sudirman No. 456, Bandung, Jawa Barat',
            ],
            [
                'email' => 'pasien3@example.com',
                'no_rm' => 'RM2026003',
                'nama' => 'Rudi Hartono',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1978-12-10',
                'alamat' => 'Jl. Diponegoro No. 78, Semarang, Jawa Tengah',
            ],
            [
                'email' => 'pasien4@example.com',
                'no_rm' => 'RM2026004',
                'nama' => 'Maya Sari',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1995-03-25',
                'alamat' => 'Jl. Gatot Subroto No. 234, Surabaya, Jawa Timur',
            ],
            [
                'email' => 'pasien5@example.com',
                'no_rm' => 'RM2026005',
                'nama' => 'Dedi Kurniawan',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1988-11-30',
                'alamat' => 'Jl. Ahmad Yani No. 567, Yogyakarta, DIY',
            ],
        ];

        foreach ($pasiens as $pasienData) {
            $user = User::where('email', $pasienData['email'])->first();
            
            if ($user) {
                Pasien::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'no_rm' => $pasienData['no_rm'],
                        'nama' => $pasienData['nama'],
                        'jenis_kelamin' => $pasienData['jenis_kelamin'],
                        'tanggal_lahir' => $pasienData['tanggal_lahir'],
                        'alamat' => $pasienData['alamat'],
                    ]
                );
            }
        }
    }
}
