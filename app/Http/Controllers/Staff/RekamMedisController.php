<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

use App\Models\Dokter;
use App\Models\Pasien;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan semua rekam medis
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'resep.obat'])
            ->latest('tanggal_periksa')
            ->paginate(5);

        return view('staff.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Form tambah rekam medis
     */
    public function create()
    {
        $pasien = Pasien::orderBy('nama')->get();
        $dokter = Dokter::with('user')->orderBy('nama')->get(); // Assuming Dokter has relationship with User just for ordering if needed
        return view('staff.rekam-medis.create', compact('pasien', 'dokter'));
    }

    /**
     * Simpan data rekam medis
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        RekamMedis::create($request->all());

        return redirect()->route('staff.rekam-medis.index')
            ->with('success', 'Rekam Medis berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail rekam medis
     */
    public function show(RekamMedis $rekamMedis)
    {
        $rekamMedis->load(['pasien', 'dokter', 'resep.obat']);
        return view('staff.rekam-medis.show', compact('rekamMedis'));
    }

    /**
     * Form edit rekam medis
     */
    public function edit(RekamMedis $rekamMedis)
    {
        $pasien = Pasien::orderBy('nama')->get();
        $dokter = Dokter::orderBy('nama')->get();
        return view('staff.rekam-medis.edit', compact('rekamMedis', 'pasien', 'dokter'));
    }

    /**
     * Update rekam medis
     */
    public function update(Request $request, RekamMedis $rekamMedis)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        $rekamMedis->update($request->all());

        return redirect()->route('staff.rekam-medis.index')
            ->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    /**
     * Hapus rekam medis
     */
    public function destroy(RekamMedis $rekamMedis)
    {
        $rekamMedis->delete();

        return redirect()->route('staff.rekam-medis.index')
            ->with('success', 'Rekam Medis berhasil dihapus.');
    }
}

