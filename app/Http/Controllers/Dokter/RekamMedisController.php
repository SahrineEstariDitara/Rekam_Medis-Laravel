<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pasien;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan daftar rekam medis yang dibuat dokter
     */
    public function index()
    {
        $dokter = auth()->user()->dokter;
        
        $rekamMedis = RekamMedis::where('dokter_id', $dokter->id)
            ->with(['pasien', 'resep.obat'])
            ->latest('tanggal_periksa')
            ->paginate(20);

        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Form create rekam medis
     */
    public function create()
    {
        $pasien = Pasien::all();
        return view('dokter.rekam-medis.create', compact('pasien'));
    }

    /**
     * Simpan rekam medis baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_periksa' => 'required|date',
        ]);

        $dokter = auth()->user()->dokter;

        $rekamMedis = RekamMedis::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $dokter->id,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'catatan' => $request->catatan,
            'tanggal_periksa' => $request->tanggal_periksa,
        ]);

        return redirect()->route('dokter.rekam-medis.show', $rekamMedis)
            ->with('success', 'Rekam medis berhasil ditambahkan');
    }

    /**
     * Tampilkan detail rekam medis
     */
    public function show(RekamMedis $rekamMedi)
    {
        $rekamMedi->load(['pasien', 'dokter', 'resep.obat']);
        return view('dokter.rekam-medis.show', compact('rekamMedi'));
    }

    /**
     * Form edit rekam medis
     */
    public function edit(RekamMedis $rekamMedi)
    {
        // Pastikan dokter hanya bisa edit rekam medis yang dia buat
        if ($rekamMedi->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit rekam medis ini');
        }

        $pasien = Pasien::all();
        return view('dokter.rekam-medis.edit', compact('rekamMedi', 'pasien'));
    }

    /**
     * Update rekam medis
     */
    public function update(Request $request, RekamMedis $rekamMedi)
    {
        // Pastikan dokter hanya bisa edit rekam medis yang dia buat
        if ($rekamMedi->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengupdate rekam medis ini');
        }

        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_periksa' => 'required|date',
        ]);

        $rekamMedi->update($request->all());

        return redirect()->route('dokter.rekam-medis.show', $rekamMedi)
            ->with('success', 'Rekam medis berhasil diupdate');
    }
}
