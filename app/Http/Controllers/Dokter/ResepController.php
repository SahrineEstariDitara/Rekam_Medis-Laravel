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
     * Halaman Form Tambah Resep (Dikembalikan)
     */
    public function create($rekamMedisId)
    {
        $rekamMedis = RekamMedis::with('pasien')->findOrFail($rekamMedisId);
        
        // Cek otorisasi: Dokter hanya bisa tambah resep di rekam medis buatannya
        if ($rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        // Ambil obat yang stoknya > 0
        $obat = Obat::where('stok', '>', 0)->get();
        
        // Pastikan kamu punya file view ini: resources/views/dokter/resep/create.blade.php
        return view('dokter.resep.create', compact('rekamMedis', 'obat'));
    }

    /**
     * Simpan Resep
     */
    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'obat_id'        => 'required|exists:obat,id',
            'jumlah'         => 'required|integer|min:1',
            'dosis'          => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($request->rekam_medis_id);
        
        if ($rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        // Cek Stok
        $obat = Obat::findOrFail($request->obat_id);
        if ($obat->stok < $request->jumlah) {
            return back()->withInput()->with('error', 'Stok obat tidak mencukupi! Sisa: ' . $obat->stok);
        }

        // Simpan
        Resep::create([
            'rekam_medis_id' => $request->rekam_medis_id,
            'obat_id'        => $request->obat_id,
            'jumlah'         => $request->jumlah,
            'dosis'          => $request->dosis,
        ]);

        // Kurangi Stok
        $obat->decrement('stok', $request->jumlah);

        // Redirect kembali ke detail rekam medis
        return redirect()->route('dokter.rekam-medis.show', $rekamMedis)
            ->with('success', 'Resep berhasil ditambahkan');
    }

    /**
     * Hapus Resep
     */
    public function destroy(Resep $resep)
    {
        if ($resep->rekamMedis->dokter_id !== auth()->user()->dokter->id) {
            abort(403, 'Anda tidak memiliki izin');
        }

        $rekamMedisId = $resep->rekam_medis_id;
        
        // Balikin stok sebelum hapus
        $resep->obat->increment('stok', $resep->jumlah);
        
        $resep->delete();

        return redirect()->route('dokter.rekam-medis.show', $rekamMedisId)
            ->with('success', 'Resep berhasil dihapus');
    }
}