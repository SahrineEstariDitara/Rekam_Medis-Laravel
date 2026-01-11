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
        $admins = User::where('role', 'admin')->latest()->get();
        $staffs = User::where('role', 'staff')->latest()->get();
        $dokters = User::with('dokter')->where('role', 'dokter')->latest()->get();
        $pasiens = User::with('pasien')->where('role', 'pasien')->latest()->get();
        
        return view('admin.users.index', compact('admins', 'staffs', 'dokters', 'pasiens'));
    }

    /**
     * Form create user
     */
    public function create(Request $request)
    {
        $role = $request->query('role');
        return view('admin.users.create', compact('role'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        // Gunakan nama user sebagai default jika nama_pasien/nama_dokter tidak diisi
        $request->merge([
            'nama_pasien' => $request->filled('nama_pasien') ? $request->nama_pasien : $request->name,
            'nama_dokter' => $request->filled('nama_dokter') ? $request->nama_dokter : $request->name,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,staff,dokter,pasien',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            
            // Validasi untuk pasien
            'no_rm' => 'nullable|required_if:role,pasien|unique:pasien,no_rm',
            'alamat' => 'nullable|required_if:role,pasien',
            
            // Validasi untuk dokter
            'spesialis' => 'nullable|required_if:role,dokter',
        ]);

        DB::beginTransaction();
        try {
            // Buat user
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ];

            $user = new User();
            $user->forceFill($userData)->save();

            // Jika role pasien, buat data pasien
            if ($request->role === 'pasien') {
                $pasien = new Pasien();
                $pasien->forceFill([
                    'user_id' => $user->id,
                    'no_rm' => $request->no_rm,
                    'nama' => $request->nama_pasien, // Menggunakan hasil merge di atas
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                ])->save();
            }

            // Jika role dokter, buat data dokter
            if ($request->role === 'dokter') {
                $dokter = new Dokter();
                $dokter->forceFill([
                    'user_id' => $user->id,
                    'nama' => $request->nama_dokter, // Menggunakan hasil merge di atas
                    'spesialis' => $request->spesialis,
                ])->save();
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
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
        // Gunakan nama user sebagai default jika nama_pasien/nama_dokter tidak diisi
        $request->merge([
            'nama_pasien' => $request->nama_pasien ?? $request->name,
            'nama_dokter' => $request->nama_dokter ?? $request->name,
        ]);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ];

        // Validasi profil wajib untuk semua role
        $rules['jenis_kelamin'] = 'required|in:Laki-laki,Perempuan';
        $rules['tanggal_lahir'] = 'required|date';

        if ($user->role === 'dokter') {
            $rules['spesialis'] = 'required';
        }
        if ($user->role === 'pasien') {
            $rules['alamat'] = 'required';
        }

        $request->validate($rules);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->forceFill($userData)->save();

            // Update data pasien jika ada
            if ($user->role === 'pasien' && $user->pasien) {
                $user->pasien->forceFill([
                    'nama' => $request->nama_pasien, // Menggunakan hasil merge
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                ])->save();
            }

            // Update data dokter jika ada
            if ($user->role === 'dokter' && $user->dokter) {
                $user->dokter->forceFill([
                    'nama' => $request->nama_dokter, // Menggunakan hasil merge
                    'spesialis' => $request->spesialis,
                ])->save();
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
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
