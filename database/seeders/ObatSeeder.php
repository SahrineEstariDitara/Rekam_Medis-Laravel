<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obatList = [
            ['nama_obat' => 'Paracetamol 500mg', 'stok' => 150],
            ['nama_obat' => 'Amoxicillin 500mg', 'stok' => 120],
            ['nama_obat' => 'Omeprazole 20mg', 'stok' => 80],
            ['nama_obat' => 'Cetirizine 10mg', 'stok' => 100],
            ['nama_obat' => 'Vitamin C 1000mg', 'stok' => 200],
            ['nama_obat' => 'Ibuprofen 400mg', 'stok' => 90],
            ['nama_obat' => 'Antasida Tablet', 'stok' => 110],
            ['nama_obat' => 'Salbutamol Inhaler', 'stok' => 45],
            ['nama_obat' => 'Metformin 500mg', 'stok' => 75],
            ['nama_obat' => 'Amlodipin 5mg', 'stok' => 85],
            ['nama_obat' => 'Simvastatin 20mg', 'stok' => 60],
            ['nama_obat' => 'Captopril 25mg', 'stok' => 70],
            ['nama_obat' => 'Ranitidine 150mg', 'stok' => 95],
            ['nama_obat' => 'Loratadine 10mg', 'stok' => 105],
            ['nama_obat' => 'Dexamethasone 0.5mg', 'stok' => 55],
            ['nama_obat' => 'Vitamin B Complex', 'stok' => 130],
            ['nama_obat' => 'Asam Mefenamat 500mg', 'stok' => 88],
            ['nama_obat' => 'Domperidone 10mg', 'stok' => 77],
            ['nama_obat' => 'Lansoprazole 30mg', 'stok' => 65],
            ['nama_obat' => 'OBH Sirup', 'stok' => 50],
        ];

        foreach ($obatList as $obat) {
            Obat::create($obat);
        }
    }
}
