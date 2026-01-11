<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendaftaranController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Auto-generate No RM: RM + YYYY + XXX (e.g., RM2026001)
        $latestPasien = Pasien::latest('id')->first();
        $year = date('Y');
        if ($latestPasien && str_contains($latestPasien->no_rm, 'RM' . $year)) {
            $lastNumber = (int) substr($latestPasien->no_rm, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newNoRm = 'RM' . $year . sprintf('%03d', $newNumber);

        return view('pendaftaran', compact('newNoRm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_rm' => 'required|string|unique:pasien',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string|max:20',
            'keluhan' => 'required|string',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',
        ]);

        // Create User first
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'), // Default password
            'role' => 'pasien',
        ]);

        // Create Pasien linked to User
        Pasien::create([
            'user_id' => $user->id,
            'no_rm' => $request->no_rm,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'keluhan' => $request->keluhan,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan login dengan email Anda dan password default: "password"');
    }
}
