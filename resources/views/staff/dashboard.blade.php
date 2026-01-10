@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Staff</h2>
    <span class="text-muted">{{ now()->format('d M Y, H:i') }}</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
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
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Rekam Medis</p>
                        <h3 class="stats-value">{{ $totalRekamMedis }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #EABDE6 !important; color: #fff !important;">
                        <i class="bi bi-file-medical"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Obat</p>
                        <h3 class="stats-value">{{ $totalObat }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #D69ADE !important; color: #fff !important;">
                        <i class="bi bi-capsule"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Stok Rendah</p>
                        <h3 class="stats-value text-danger">{{ $stokObatRendah }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #AA60C8 !important; color: #fff !important;">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lightning-charge me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('staff.rekam-medis.index') }}" class="btn btn-primary">
                        <i class="bi bi-file-medical me-2"></i>Lihat Rekam Medis
                    </a>
                    <a href="{{ route('staff.obat.index') }}" class="btn btn-primary">
                        <i class="bi bi-capsule me-2"></i>Kelola Data Obat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



