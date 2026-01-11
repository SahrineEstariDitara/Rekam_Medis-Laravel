<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }


    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Cek apakah login menggunakan No. Rekam Medis (Mode Pasien)
        if ($request->has('no_rm') && $request->filled('no_rm')) {
            $request->validate([
                'no_rm'  => 'required|exists:pasien,no_rm',
                'email'  => 'required|email',
                'password' => 'required',
            ]);

            // Cari pasien berdasarkan No RM
            $pasien = \App\Models\Pasien::where('no_rm', $request->no_rm)->first();
            
            // Verifikasi apakah pasien valid dan emailnya sesuai
            if (!$pasien || !$pasien->user || $pasien->user->email !== $request->email) {
                return back()->withErrors([
                    'no_rm' => 'Data No. Rekam Medis tidak cocok dengan email ini.',
                ])->onlyInput('no_rm', 'email');
            }

            // Lakukan login menggunakan kredensial email & password
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->route('pasien.dashboard');
            }
            
            return back()->withErrors([
                'email' => 'Password salah.', // Pesan error umum
            ])->onlyInput('no_rm', 'email');
        }

        // Login standar menggunakan email (Mode Umum)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            } elseif ($user->role === 'pasien') {
                return redirect()->route('pasien.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

