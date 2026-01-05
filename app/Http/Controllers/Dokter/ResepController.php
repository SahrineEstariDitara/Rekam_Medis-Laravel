<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Tambah resep untuk rekam medis
     */
    public function create($rekamMedisId)
    {
        $rekamMedis = RekamMedis::with('pasien')->findOrFail($rekamMedisId);
        
        // Pastikan dokter hanya bisa menambah resep untuk rekam medis yang dia buat
        if ($rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        $obat = Obat::where('stok', '>', 0)->get();
        
        return view('dokter.resep.create', compact('rekamMedis', 'obat'));
    }

    /**
     * Simpan resep
     */
    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'obat_id' => 'required|exists:obat,id',
            'dosis' => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($request->rekam_medis_id);
        
        // Pastikan dokter hanya bisa menambah resep untuk rekam medis yang dia buat
        if ($rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        Resep::create($request->all());

        return redirect()->route('dokter.rekam-medis.show', $rekamMedis)
            ->with('success', 'Resep berhasil ditambahkan');
    }

    /**
     * Hapus resep
     */
    public function destroy(Resep $resep)
    {
        // Pastikan dokter hanya bisa hapus resep yang dia buat
        if ($resep->rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        $rekamMedisId = $resep->rekam_medis_id;
        $resep->delete();

        return redirect()->route('dokter.rekam-medis.show', $rekamMedisId)
            ->with('success', 'Resep berhasil dihapus');
    }
}
