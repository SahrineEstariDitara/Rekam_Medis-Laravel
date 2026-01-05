<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Tampilkan daftar pasien
     */
    public function index()
    {
        $pasien = Pasien::with('user')->latest()->paginate(20);
        return view('dokter.pasien.index', compact('pasien'));
    }

    /**
     * Tampilkan detail pasien beserta riwayat rekam medis
     */
    public function show(Pasien $pasien)
    {
        $pasien->load(['rekamMedis' => function ($query) {
            $query->with(['dokter', 'resep.obat'])
                ->latest('tanggal_periksa');
        }]);

        return view('dokter.pasien.show', compact('pasien'));
    }
}
