@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="page-header mb-4">
    <h2 style="color: #AA60C8;"><i class="bi bi-emoji-smile me-2"></i>Dashboard Dokter</h2>
    <span class="text-muted">Selamat datang, <span style="color: #AA60C8;">{{ auth()->user()->name }}</span></span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background-color: #FFDFEF;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase small fw-bold mb-2" style="color: #AA60C8; letter-spacing: 1px;">Total Pasien</p>
                        <h2 class="fw-bold mb-0" style="color: #AA60C8; font-size: 2.5rem;">{{ $totalPasien }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 60px; height: 60px; background-color: white;">
                        <i class="bi bi-person" style="font-size: 1.8rem; color: #AA60C8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background-color: #FFDFEF;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase small fw-bold mb-2" style="color: #AA60C8; letter-spacing: 1px;">Pemeriksaan Hari Ini</p>
                        <h2 class="fw-bold mb-0" style="color: #AA60C8; font-size: 2.5rem;">{{ $rekamMedisHariIni }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 60px; height: 60px; background-color: white;">
                        <i class="bi bi-file-medical" style="font-size: 1.8rem; color: #AA60C8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pt-4 pb-0 px-4" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0 fw-bold" style="color: #AA60C8;">
                    <i class="bi bi-lightning-charge me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-grid gap-3">
                    <a href="{{ route('dokter.rekam-medis.create') }}" class="btn btn-lg rounded-pill py-3" 
                       style="background-color: #C084C0; border: none; color: white;">
                        <i class="bi bi-plus-circle me-2"></i>Buat Rekam Medis Baru
                    </a>
                    <a href="{{ route('dokter.pasien.index') }}" class="btn btn-lg rounded-pill py-3" 
                       style="background-color: #C084C0; border: none; color: white;">
                        <i class="bi bi-people me-2"></i>Lihat Daftar Pasien
                    </a>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-lg rounded-pill py-3" 
                       style="background-color: #D4A5D9; border: 2px solid #C084C0; color: #7a4a7a;">
                        <i class="bi bi-file-medical me-2"></i>Riwayat Rekam Medis
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #FFDFEF 0%, #EABDE6 100%);">
            <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" 
                     style="width: 80px; height: 80px; background-color: white;">
                    <i class="bi bi-heart-pulse" style="font-size: 2.5rem; color: #AA60C8;"></i>
                </div>
                <h5 class="fw-bold mb-2" style="color: #AA60C8;">Selamat Bekerja!</h5>
                <p class="text-muted small mb-0">Semoga hari Anda menyenangkan dan pasien Anda lekas sembuh.</p>
            </div>
        </div>
    </div>
</div>
@endsection
