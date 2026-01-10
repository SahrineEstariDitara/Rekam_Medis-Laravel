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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::with('user')->latest()->paginate(10);
        return view('staff.pasien.index', compact('pasiens'));
    }

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

        return view('staff.pasien.create', compact('newNoRm'));
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
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
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
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('staff.pasien.index')
            ->with('success', 'Data Pasien berhasil ditambahkan. Password default: "password"');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used largely, usually handled in edit or irrelevant
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        return view('staff.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($pasien->user_id)],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        // Update User
        $pasien->user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        // Update Pasien
        $pasien->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('staff.pasien.index')
            ->with('success', 'Data Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        // Delete User (Cascade usually handles Pasien, but let's be safe or just delete Pasien and let User remain? 
        // Best practice: Delete User, and Pasien goes with it if cascaded, or delete both manually. 
        // Pasien table has user_id. If we delete user, we might want to delete patient. 
        // Let's delete both.
        
        $user = $pasien->user;
        $pasien->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('staff.pasien.index')
            ->with('success', 'Data Pasien berhasil dihapus.');
    }
}
