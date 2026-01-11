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

        return \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            $rekamMedis = RekamMedis::findOrFail($request->rekam_medis_id);
            
            if ($rekamMedis->dokter_id !== auth()->user()->dokter->id) {
                abort(403, 'Anda tidak memiliki izin');
            }

            // Lock for update untuk mencegah race condition
            $obat = Obat::lockForUpdate()->findOrFail($request->obat_id);
            
            if ($obat->stok < $request->jumlah) {
                // Throw exception agar transaction di-rollback (meski di sini belum ada perubahan DB)
                // Tapi lebih baik return back di luar transaction atau throw validation exception
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'jumlah' => 'Stok obat tidak mencukupi! Sisa: ' . $obat->stok
                ]);
            }

            // Simpan Resep
            Resep::create([
                'rekam_medis_id' => $request->rekam_medis_id,
                'obat_id'        => $request->obat_id,
                'jumlah'         => $request->jumlah,
                'dosis'          => $request->dosis,
            ]);

            // Kurangi Stok
            $obat->decrement('stok', $request->jumlah);

            return redirect()->route('dokter.rekam-medis.show', $rekamMedis)
                ->with('success', 'Resep berhasil ditambahkan. Stok obat diperbarui (Sisa: ' . $obat->stok . ' pcs).');
        });
    }

    /**
     * Hapus Resep
     */
    public function destroy(Resep $resep)
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($resep) {
            if ($resep->rekamMedis->dokter_id !== auth()->user()->dokter->id) {
                abort(403, 'Anda tidak memiliki izin');
            }

            $rekamMedisId = $resep->rekam_medis_id;
            
            // Balikin stok sebelum hapus
            // Lock juga disini biar aman
            $obat = Obat::lockForUpdate()->find($resep->obat_id);
            if($obat) {
                $obat->increment('stok', $resep->jumlah);
            }
            
            $resep->delete();

            return redirect()->route('dokter.rekam-medis.show', $rekamMedisId)
                ->with('success', 'Resep berhasil dihapus. Stok obat dikembalikan (Total: ' . ($obat->stok ?? '-') . ' pcs).');
        });
    }
}