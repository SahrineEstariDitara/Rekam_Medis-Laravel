@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Dokter</h2>
    <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pasien
                        </div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalPasien }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pemeriksaan Hari Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold">{{ $rekamMedisHariIni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-medical text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('dokter.rekam-medis.create') }}" class="btn btn-primary btn-sm mb-2 w-100">
                    <i class="bi bi-plus-circle"></i> Buat Rekam Medis Baru
                </a>
                <a href="{{ route('dokter.pasien.index') }}" class="btn btn-info btn-sm mb-2 w-100">
                    <i class="bi bi-people"></i> Lihat Daftar Pasien
                </a>
                <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-success btn-sm w-100">
                    <i class="bi bi-file-medical"></i> Riwayat Rekam Medis
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
