@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
    <span class="text-muted">{{ now()->format('d M Y, H:i') }}</span>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pasien
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPasien }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Dokter
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDokter }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-badge text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Rekam Medis
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRekamMedis }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-medical text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm mb-2 w-100">
                    <i class="bi bi-plus-circle"></i> Tambah User Baru
                </a>
                <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-info btn-sm mb-2 w-100">
                    <i class="bi bi-file-medical"></i> Lihat Semua Rekam Medis
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-success btn-sm w-100">
                    <i class="bi bi-graph-up"></i> Lihat Laporan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
