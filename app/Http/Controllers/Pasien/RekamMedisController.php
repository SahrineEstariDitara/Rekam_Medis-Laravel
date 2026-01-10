<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan riwayat rekam medis pasien (READ-ONLY)
     */
    public function index()
    {
        $pasien = auth()->user()->pasien;
        
        $rekamMedis = RekamMedis::where('pasien_id', $pasien->id)
            ->with(['dokter', 'resep.obat'])
            ->latest('tanggal_periksa')
            ->paginate(20);

        return view('pasien.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Tampilkan detail rekam medis (READ-ONLY)
     */
    public function show(RekamMedis $rekamMedi)
    {
        $pasien = auth()->user()->pasien;
        
        // Pastikan pasien hanya bisa melihat rekam medis miliknya sendiri
        if ($rekamMedi->pasien_id !== $pasien->id) {
            abort(403, 'Anda tidak memiliki izin untuk melihat rekam medis ini');
        }

        $rekamMedi->load(['dokter', 'resep.obat']);
        
        // PERBAIKAN: Ubah 'rekamMedis' menjadi 'rekamMedi'
        return view('pasien.rekam-medis.show', compact('rekamMedi'));
    }

    /**
     * Download rekam medis PDF
     */
    public function download(RekamMedis $rekamMedi)
    {
        $pasien = auth()->user()->pasien;
        
        // Pastikan pasien hanya bisa mengunduh rekam medis miliknya sendiri
        if ($rekamMedi->pasien_id !== $pasien->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengunduh rekam medis ini');
        }

        $rekamMedi->load(['dokter', 'resep.obat']);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pasien.rekam-medis.pdf', compact('rekamMedi'));
        return $pdf->download('rekam-medis-' . $rekamMedi->tanggal_periksa->format('Y-m-d') . '.pdf');
    }
}
