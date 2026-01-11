<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Staff\RekamMedisController as StaffRekamMedisController;
use App\Http\Controllers\Staff\PasienController as StaffPasienController;
use App\Http\Controllers\Staff\DokterController as StaffDokterController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\RekamMedisController as DokterRekamMedisController;
use App\Http\Controllers\Dokter\ResepController as DokterResepController;
use App\Http\Controllers\Pasien\ProfilController;
use App\Http\Controllers\Pasien\RekamMedisController as PasienRekamMedisController;
use App\Http\Controllers\Pasien\ResepController as PasienResepController;
use App\Http\Controllers\Master\ObatController;
use App\Http\Controllers\PendaftaranController;

// Public Pendaftaran Route
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Admin Routes - Hanya untuk mengelola user
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::resource('users', UserController::class);
        // Admin Pendaftaran (Uses Staff Controller logic)
        Route::resource('pendaftaran', StaffPasienController::class)->only(['create', 'store']);
    });

    // Staff Routes - Untuk mengelola rekam medis dan obat
    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffDashboard'])->name('dashboard');
        Route::resource('rekam-medis', StaffRekamMedisController::class)->parameters(['rekam-medis' => 'rekamMedis']);
        Route::resource('obat', ObatController::class);
        Route::resource('pasien', StaffPasienController::class);
        Route::resource('dokter', StaffDokterController::class);
    });

    // Dokter Routes
    Route::middleware(['role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dokterDashboard'])->name('dashboard');
        Route::resource('pasien', PasienController::class)->only(['index', 'show']);
        Route::resource('rekam-medis', DokterRekamMedisController::class);
        Route::get('resep/create/{rekamMedisId}', [DokterResepController::class, 'create'])->name('resep.create');
        Route::post('resep', [DokterResepController::class, 'store'])->name('resep.store');
        Route::delete('resep/{resep}', [DokterResepController::class, 'destroy'])->name('resep.destroy');
        Route::get('obat', [ObatController::class, 'indexForDokter'])->name('obat.index');
    });

    // Pasien Routes
    Route::middleware(['role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'pasienDashboard'])->name('dashboard');
        Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::get('rekam-medis/{rekamMedi}/download', [PasienRekamMedisController::class, 'download'])->name('rekam-medis.download');
        Route::resource('rekam-medis', PasienRekamMedisController::class)->only(['index', 'show']);
        Route::get('resep', [PasienResepController::class, 'index'])->name('resep.index');
    });
});

Route::get('/', function () {
    return view('welcome');
});
