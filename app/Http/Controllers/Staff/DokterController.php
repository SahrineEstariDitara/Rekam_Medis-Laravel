<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = Dokter::with('user')->latest()->paginate(10);
        return view('staff.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get users with role 'dokter' that don't have a dokter profile yet
        $availableUsers = User::where('role', 'dokter')
            ->whereDoesntHave('dokter')
            ->orderBy('name')
            ->get();
        
        return view('staff.dokter.create', compact('availableUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:dokter,user_id',
            'spesialis' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        // Get the user
        $user = User::findOrFail($request->user_id);

        // Create Dokter linked to existing User
        Dokter::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'spesialis' => $request->spesialis,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('staff.dokter.index')
            ->with('success', 'Profil Dokter untuk ' . $user->name . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        return view('staff.dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'spesialis' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        // Update Dokter profile only (user data is managed by admin)
        $dokter->update([
            'nama' => $dokter->user->name, // Sync name from user
            'spesialis' => $request->spesialis,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('staff.dokter.index')
            ->with('success', 'Data Dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        $userName = $dokter->user->name ?? 'Unknown';
        
        // Only delete the dokter profile, NOT the user account
        // User account is managed by admin
        $dokter->delete();

        return redirect()->route('staff.dokter.index')
            ->with('success', 'Profil Dokter ' . $userName . ' berhasil dihapus. Akun user tetap ada dan dapat dikelola oleh Admin.');
    }
}