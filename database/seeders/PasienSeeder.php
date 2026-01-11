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
                'email' => 'pasien1@pasien.rekammedis.com',
                'no_rm' => 'RM2026001',
                'nama' => 'Andi Wijaya',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-05-15',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat, DKI Jakarta',
                'no_tlp' => '081234567890',
                'keluhan' => 'Demam dan batuk',
            ],
            [
                'email' => 'pasien2@pasien.rekammedis.com',
                'no_rm' => 'RM2026002',
                'nama' => 'Sari Indah',
                'tempat_lahir' => 'Bandung',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1985-08-20',
                'alamat' => 'Jl. Sudirman No. 456, Bandung, Jawa Barat',
                'no_tlp' => '081234567891',
                'keluhan' => 'Sakit kepala',
            ],
            [
                'email' => 'pasien3@pasien.rekammedis.com',
                'no_rm' => 'RM2026003',
                'nama' => 'Rudi Hartono',
                'tempat_lahir' => 'Semarang',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1978-12-10',
                'alamat' => 'Jl. Diponegoro No. 78, Semarang, Jawa Tengah',
                'no_tlp' => '081234567892',
                'keluhan' => 'Nyeri punggung',
            ],
            [
                'email' => 'pasien4@pasien.rekammedis.com',
                'no_rm' => 'RM2026004',
                'nama' => 'Maya Sari',
                'tempat_lahir' => 'Surabaya',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1995-03-25',
                'alamat' => 'Jl. Gatot Subroto No. 234, Surabaya, Jawa Timur',
                'no_tlp' => '081234567893',
                'keluhan' => 'Alergi kulit',
            ],
            [
                'email' => 'pasien5@pasien.rekammedis.com',
                'no_rm' => 'RM2026005',
                'nama' => 'Dedi Kurniawan',
                'tempat_lahir' => 'Yogyakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1988-11-30',
                'alamat' => 'Jl. Ahmad Yani No. 567, Yogyakarta, DIY',
                'no_tlp' => '081234567894',
                'keluhan' => 'Flu dan pilek',
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
                        'tempat_lahir' => $pasienData['tempat_lahir'],
                        'jenis_kelamin' => $pasienData['jenis_kelamin'],
                        'tanggal_lahir' => $pasienData['tanggal_lahir'],
                        'alamat' => $pasienData['alamat'],
                        'no_tlp' => $pasienData['no_tlp'],
                        'keluhan' => $pasienData['keluhan'],
                    ]
                );
            }
        }
    }
}
