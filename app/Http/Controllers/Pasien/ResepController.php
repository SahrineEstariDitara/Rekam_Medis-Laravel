<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Tampilkan semua resep pasien (READ-ONLY)
     */
    public function index()
    {
        $pasien = auth()->user()->pasien;
        
        $resep = Resep::whereHas('rekamMedis', function ($query) use ($pasien) {
                $query->where('pasien_id', $pasien->id);
            })
            ->with(['rekamMedis', 'obat'])
            ->latest()
            ->paginate(20);

        return view('pasien.resep.index', compact('resep'));
    }
}
