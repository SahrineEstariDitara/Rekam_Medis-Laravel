<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil pasien
     */
    public function index()
    {
        $pasien = auth()->user()->pasien;
        return view('pasien.profil.index', compact('pasien'));
    }
}
