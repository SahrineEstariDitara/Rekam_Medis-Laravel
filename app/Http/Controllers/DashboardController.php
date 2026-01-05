<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();
        $totalRekamMedis = RekamMedis::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPasien',
            'totalDokter',
            'totalRekamMedis'
        ));
    }

    /**
     * Dashboard Dokter
     */
    public function dokterDashboard()
    {
        $dokter = auth()->user()->dokter;
        $totalPasien = Pasien::count();
        $rekamMedisHariIni = RekamMedis::where('dokter_id', $dokter->id)
            ->whereDate('tanggal_periksa', today())
            ->count();

        return view('dokter.dashboard', compact(
            'totalPasien',
            'rekamMedisHariIni'
        ));
    }

    /**
     * Dashboard Pasien
     */
    public function pasienDashboard()
    {
        $pasien = auth()->user()->pasien;
        $totalKunjungan = RekamMedis::where('pasien_id', $pasien->id)->count();
        $kunjunganTerakhir = RekamMedis::where('pasien_id', $pasien->id)
            ->latest('tanggal_periksa')
            ->first();

        return view('pasien.dashboard', compact(
            'pasien',
            'totalKunjungan',
            'kunjunganTerakhir'
        ));
    }
}
