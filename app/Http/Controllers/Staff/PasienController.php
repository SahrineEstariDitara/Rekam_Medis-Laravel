<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('user')->latest()->paginate(10);
        return view('staff.pasien.index', compact('pasiens'));
    }

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

        return view('staff.pasien.create', compact('newNoRm'));
    }

    public function store(Request $request)
    {
        // ✅ Validasi
        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'tempat_lahir'  => 'required|string|max:100',
            'no_rm'         => 'required|string|unique:pasien,no_rm',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'no_tlp'        => 'required|string|max:20',
            'keluhan'       => 'required|string|max:255', // ✅ WAJIB
        ]);

        // 1️⃣ Buat User
        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make('password'),
            'role'     => 'pasien',
        ]);

        // 2️⃣ Buat Pasien
        Pasien::create([
            'user_id'        => $user->id,
            'no_rm'          => $request->no_rm,
            'nama'           => $request->nama,
            'tempat_lahir'   => $request->tempat_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_tlp'         => $request->no_tlp,
            'keluhan'        => $request->keluhan,
        ]);

        $route = auth()->user()->role === 'admin'
            ? 'admin.users.index'
            : 'staff.pasien.index';

        return redirect()->route($route)
            ->with('success', 'Data Pasien berhasil ditambahkan. Password default: "password"');
    }

    public function edit(Pasien $pasien)
    {
        return view('staff.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        // ✅ Validasi
        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => ['required', 'email', Rule::unique('users', 'email')->ignore($pasien->user_id)],
            'tempat_lahir'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'no_tlp'        => 'required|string|max:20',
            'keluhan'       => 'required|string|max:255', // ✅ WAJIB
        ]);

        // 1️⃣ Update User
        $pasien->user->update([
            'name'  => $request->nama,
            'email' => $request->email,
        ]);

        // 2️⃣ Update Pasien
        $pasien->update([
            'nama'           => $request->nama,
            'tempat_lahir'   => $request->tempat_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_tlp'         => $request->no_tlp,
            'keluhan'        => $request->keluhan,
        ]);

        $route = auth()->user()->role === 'admin'
            ? 'admin.users.index'
            : 'staff.pasien.index';

        return redirect()->route($route)
            ->with('success', 'Data Pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $user = $pasien->user;

        $pasien->delete();

        if ($user) {
            $user->delete();
        }

        $route = auth()->user()->role === 'admin'
            ? 'admin.users.index'
            : 'staff.pasien.index';

        return redirect()->route($route)
            ->with('success', 'Data Pasien berhasil dihapus.');
    }
}
