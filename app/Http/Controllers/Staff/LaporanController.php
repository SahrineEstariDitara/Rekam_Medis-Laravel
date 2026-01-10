<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan
     */
    public function index()
    {
        return view('staff.laporan.index');
    }

    /**
     * Laporan statistik kunjungan pasien
     */
    public function statistikKunjungan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $kunjunganPerHari = RekamMedis::whereBetween('tanggal_periksa', [
                $request->tanggal_mulai,
                $request->tanggal_akhir
            ])
            ->select(DB::raw('DATE(tanggal_periksa) as tanggal'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $kunjunganPerDokter = RekamMedis::whereBetween('tanggal_periksa', [
                $request->tanggal_mulai,
                $request->tanggal_akhir
            ])
            ->with('dokter')
            ->select('dokter_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('dokter_id')
            ->get();

        $totalKunjungan = RekamMedis::whereBetween('tanggal_periksa', [
                $request->tanggal_mulai,
                $request->tanggal_akhir
            ])->count();

        return view('staff.laporan.statistik', compact(
            'kunjunganPerHari',
            'kunjunganPerDokter',
            'totalKunjungan'
        ));
    }
}
