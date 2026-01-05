<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan semua rekam medis
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'resep.obat'])
            ->latest('tanggal_periksa')
            ->paginate(20);

        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Tampilkan detail rekam medis
     */
    public function show(RekamMedis $rekamMedis)
    {
        $rekamMedis->load(['pasien', 'dokter', 'resep.obat']);
        return view('admin.rekam-medis.show', compact('rekamMedis'));
    }
}
