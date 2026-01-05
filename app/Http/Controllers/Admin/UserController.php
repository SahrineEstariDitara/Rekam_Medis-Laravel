<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user
     */
    public function index()
    {
        $users = User::with(['pasien', 'dokter'])->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Form create user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,dokter,pasien',
            
            // Validasi untuk pasien
            'no_rm' => 'required_if:role,pasien|unique:pasien,no_rm',
            'nama_pasien' => 'required_if:role,pasien',
            'jenis_kelamin' => 'required_if:role,pasien|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required_if:role,pasien|date',
            'alamat' => 'required_if:role,pasien',
            
            // Validasi untuk dokter
            'nama_dokter' => 'required_if:role,dokter',
            'spesialis' => 'required_if:role,dokter',
        ]);

        DB::beginTransaction();
        try {
            // Buat user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Jika role pasien, buat data pasien
            if ($request->role === 'pasien') {
                Pasien::create([
                    'user_id' => $user->id,
                    'no_rm' => $request->no_rm,
                    'nama' => $request->nama_pasien,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                ]);
            }

            // Jika role dokter, buat data dokter
            if ($request->role === 'dokter') {
                Dokter::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama_dokter,
                    'spesialis' => $request->spesialis,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail user
     */
    public function show(User $user)
    {
        $user->load(['pasien', 'dokter']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $user->load(['pasien', 'dokter']);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Update data pasien jika ada
            if ($user->role === 'pasien' && $user->pasien) {
                $user->pasien->update([
                    'nama' => $request->nama_pasien,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                ]);
            }

            // Update data dokter jika ada
            if ($user->role === 'dokter' && $user->dokter) {
                $user->dokter->update([
                    'nama' => $request->nama_dokter,
                    'spesialis' => $request->spesialis,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
