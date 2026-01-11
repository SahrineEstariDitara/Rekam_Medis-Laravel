<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin - Mengelola user
     */
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();
        $totalStaff = User::where('role', 'staff')->count();

        // Statistik 5 Penyakit (Diagnosa) Terbanyak
        $penyakitTerbanyak = RekamMedis::select('diagnosa', DB::raw('count(*) as total'))
            ->whereNotNull('diagnosa')
            ->groupBy('diagnosa')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // Ambil kunjungan (Rekam Medis) hari ini
        $kunjunganHariIni = RekamMedis::with(['pasien.user', 'dokter'])
            ->whereDate('tanggal_periksa', today())
            ->latest()
            ->get();

        // Lampirkan riwayat singkat untuk setiap kunjungan (antisipasi jika relasi hasMany belum ada di model Pasien)
        foreach ($kunjunganHariIni as $kunjungan) {
            $kunjungan->riwayat = RekamMedis::where('pasien_id', $kunjungan->pasien_id)
                ->where('id', '!=', $kunjungan->id) // Kecualikan kunjungan ini
                ->latest('tanggal_periksa')
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPasien',
            'totalDokter',
            'totalStaff',
            'kunjunganHariIni',
            'penyakitTerbanyak'
        ));
    }

    /**
     * Dashboard Staff - Mengelola rekam medis dan obat
     */
    public function staffDashboard()
    {
        $totalPasien = Pasien::count();
        $totalRekamMedis = RekamMedis::count();
        $totalObat = Obat::count();
        $stokObatRendah = Obat::where('stok', '<', 10)->count();

        return view('staff.dashboard', compact(
            'totalPasien',
            'totalRekamMedis',
            'totalObat',
            'stokObatRendah'
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

    /**
     * Fitur Pencarian Cepat Admin
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::with(['pasien', 'dokter'])
            ->where('name', 'like', "%{$query}%")
            ->orWhereHas('pasien', function($q) use ($query) {
                $q->where('no_rm', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $results = $users->map(function($user) {
            $info = ucfirst($user->role);
            if ($user->role === 'pasien' && $user->pasien) {
                $info .= ' - ' . $user->pasien->no_rm;
            } elseif ($user->role === 'dokter' && $user->dokter) {
                $info .= ' - ' . $user->dokter->spesialis;
            }

            return [
                'id' => $user->id,
                'name' => $user->name,
                'info' => $info,
                'url' => route('admin.users.show', $user->id)
            ];
        });

        return response()->json($results);
    }
}
