<?php

namespace Database\Seeders;

use App\Models\Resep;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        $rekamMedis = RekamMedis::all();
        $obat = Obat::all();

        if ($rekamMedis->isEmpty() || $obat->isEmpty()) {
            $this->command->warn('Tidak ada data rekam medis atau obat. Jalankan RekamMedisSeeder dan ObatSeeder terlebih dahulu.');
            return;
        }

        // Resep untuk Rekam Medis pertama (Influenza)
        $rm1 = $rekamMedis->first();
        Resep::create([
            'rekam_medis_id' => $rm1->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Paracetamol%')->first()->id,
            'dosis' => '3 x 1 tablet sehari (setelah makan)',
        ]);
        Resep::create([
            'rekam_medis_id' => $rm1->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Vitamin C%')->first()->id,
            'dosis' => '1 x 1 tablet sehari',
        ]);

        // Resep untuk Rekam Medis kedua (Gastritis)
        $rm2 = $rekamMedis->skip(1)->first();
        Resep::create([
            'rekam_medis_id' => $rm2->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Omeprazole%')->first()->id,
            'dosis' => '2 x 1 tablet sehari (sebelum makan)',
        ]);
        Resep::create([
            'rekam_medis_id' => $rm2->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Antasida%')->first()->id,
            'dosis' => '3 x 1 tablet sehari (saat perut terasa perih)',
        ]);

        // Resep untuk Rekam Medis ketiga (Bronkitis)
        $rm3 = $rekamMedis->skip(2)->first();
        Resep::create([
            'rekam_medis_id' => $rm3->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Amoxicillin%')->first()->id,
            'dosis' => '3 x 1 tablet sehari (setelah makan) - 5 hari',
        ]);
        Resep::create([
            'rekam_medis_id' => $rm3->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%OBH%')->first()->id,
            'dosis' => '3 x 1 sendok makan sehari',
        ]);

        // Resep untuk Rekam Medis keempat (Dermatitis)
        $rm4 = $rekamMedis->skip(3)->first();
        Resep::create([
            'rekam_medis_id' => $rm4->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Cetirizine%')->first()->id,
            'dosis' => '1 x 1 tablet sehari (malam hari)',
        ]);
        Resep::create([
            'rekam_medis_id' => $rm4->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Dexamethasone%')->first()->id,
            'dosis' => '2 x 1 tablet sehari (3 hari)',
        ]);

        // Resep untuk Rekam Medis kelima (Hipertensi)
        $rm5 = $rekamMedis->skip(4)->first();
        Resep::create([
            'rekam_medis_id' => $rm5->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Amlodipin%')->first()->id,
            'dosis' => '1 x 1 tablet sehari (pagi hari)',
        ]);

        // Resep untuk Rekam Medis keenam (Anxiety)
        $rm6 = $rekamMedis->skip(5)->first();
        Resep::create([
            'rekam_medis_id' => $rm6->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Vitamin B%')->first()->id,
            'dosis' => '1 x 1 tablet sehari',
        ]);

        // Resep untuk Rekam Medis ketujuh (Osteoarthritis)
        $rm7 = $rekamMedis->skip(6)->first();
        Resep::create([
            'rekam_medis_id' => $rm7->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Ibuprofen%')->first()->id,
            'dosis' => '3 x 1 tablet sehari (setelah makan)',
        ]);

        // Resep untuk Rekam Medis kedelapan (Vertigo)
        $rm8 = $rekamMedis->skip(7)->first();
        Resep::create([
            'rekam_medis_id' => $rm8->id,
            'obat_id' => Obat::where('nama_obat', 'like', '%Domperidone%')->first()->id,
            'dosis' => '3 x 1 tablet sehari (sebelum makan)',
        ]);
    }
}
