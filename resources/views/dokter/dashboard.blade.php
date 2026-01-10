@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="page-header mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Dokter</h2>
    <span class="text-muted">Selamat datang, {{ auth()->user()->name }}</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Pasien</p>
                        <h3 class="stats-value">{{ $totalPasien }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #FFDFEF !important; color: #AA60C8 !important;">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Pemeriksaan Hari Ini</p>
                        <h3 class="stats-value">{{ $rekamMedisHariIni }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #EABDE6 !important; color: #fff !important;">
                        <i class="bi bi-file-medical"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lightning-charge me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('dokter.rekam-medis.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Buat Rekam Medis Baru
                    </a>
                    <a href="{{ route('dokter.pasien.index') }}" class="btn btn-primary">
                        <i class="bi bi-people me-2"></i> Lihat Daftar Pasien
                    </a>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary">
                        <i class="bi bi-file-medical me-2"></i> Riwayat Rekam Medis
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
