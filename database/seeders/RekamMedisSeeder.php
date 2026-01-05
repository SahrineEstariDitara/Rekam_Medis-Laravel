<?php

namespace Database\Seeders;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RekamMedisSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        if ($pasiens->isEmpty() || $dokters->isEmpty()) {
            $this->command->warn('Tidak ada data pasien atau dokter. Jalankan UserSeeder, PasienSeeder, dan DokterSeeder terlebih dahulu.');
            return;
        }

        $rekamMedisList = [
            [
                'pasien_id' => $pasiens->first()->id,
                'dokter_id' => $dokters->first()->id,
                'keluhan' => 'Demam tinggi, sakit kepala, dan batuk kering sejak 3 hari yang lalu',
                'diagnosa' => 'Influenza (Flu)',
                'tindakan' => 'Pemberian obat antipiretik dan istirahat yang cukup',
                'catatan' => 'Pasien disarankan untuk banyak minum air putih dan istirahat total',
                'tanggal_periksa' => Carbon::now()->subDays(5),
            ],
            [
                'pasien_id' => $pasiens->skip(1)->first()->id,
                'dokter_id' => $dokters->skip(1)->first()->id,
                'keluhan' => 'Mual, muntah, dan nyeri perut bagian atas',
                'diagnosa' => 'Gastritis Akut',
                'tindakan' => 'Pemberian obat antasida dan PPI (Proton Pump Inhibitor)',
                'catatan' => 'Hindari makanan pedas dan asam, makan teratur',
                'tanggal_periksa' => Carbon::now()->subDays(3),
            ],
            [
                'pasien_id' => $pasiens->skip(2)->first()->id,
                'dokter_id' => $dokters->first()->id,
                'keluhan' => 'Sesak napas, batuk berdahak, dan demam ringan',
                'diagnosa' => 'Bronkitis Akut',
                'tindakan' => 'Pemberian antibiotik dan bronkodilator',
                'catatan' => 'Kontrol kembali jika keluhan tidak membaik dalam 3 hari',
                'tanggal_periksa' => Carbon::now()->subDays(2),
            ],
            [
                'pasien_id' => $pasiens->skip(3)->first()->id,
                'dokter_id' => $dokters->skip(1)->first()->id,
                'keluhan' => 'Gatal-gatal pada kulit, ruam kemerahan di area tangan dan kaki',
                'diagnosa' => 'Dermatitis Alergi',
                'tindakan' => 'Pemberian antihistamin dan kortikosteroid topikal',
                'catatan' => 'Hindari kontak dengan bahan alergen',
                'tanggal_periksa' => Carbon::now()->subDays(1),
            ],
            [
                'pasien_id' => $pasiens->first()->id,
                'dokter_id' => $dokters->skip(1)->first()->id,
                'keluhan' => 'Kontrol rutin hipertensi',
                'diagnosa' => 'Hipertensi Grade 1 (terkontrol)',
                'tindakan' => 'Lanjutkan terapi antihipertensi',
                'catatan' => 'Tekanan darah 130/85 mmHg. Diet rendah garam dan olahraga teratur',
                'tanggal_periksa' => Carbon::now(),
            ],
            [
                'pasien_id' => $pasiens->skip(4)->first()->id,
                'dokter_id' => $dokters->first()->id,
                'keluhan' => 'Nyeri dada sebelah kiri, berdebar-debar',
                'diagnosa' => 'Kecemasan (Anxiety)',
                'tindakan' => 'Konseling dan pemberian anxiolytic ringan',
                'catatan' => 'Hasil EKG normal. Disarankan untuk manajemen stres',
                'tanggal_periksa' => Carbon::now()->subDays(4),
            ],
            [
                'pasien_id' => $pasiens->skip(2)->first()->id,
                'dokter_id' => $dokters->skip(2)->first()->id,
                'keluhan' => 'Nyeri sendi pada lutut kanan, sulit berjalan',
                'diagnosa' => 'Osteoarthritis Lutut Kanan',
                'tindakan' => 'Pemberian NSAID dan fisioterapi',
                'catatan' => 'Hindari aktivitas berat, gunakan alat bantu jalan jika perlu',
                'tanggal_periksa' => Carbon::now()->subDays(6),
            ],
            [
                'pasien_id' => $pasiens->skip(1)->first()->id,
                'dokter_id' => $dokters->first()->id,
                'keluhan' => 'Pusing berputar, mual saat menggerakkan kepala',
                'diagnosa' => 'Vertigo (BPPV - Benign Paroxysmal Positional Vertigo)',
                'tindakan' => 'Manuver Epley dan pemberian antivertigo',
                'catatan' => 'Latihan vestibular di rumah',
                'tanggal_periksa' => Carbon::now()->subDays(7),
            ],
        ];

        foreach ($rekamMedisList as $rekamMedis) {
            RekamMedis::create($rekamMedis);
        }
    }
}
