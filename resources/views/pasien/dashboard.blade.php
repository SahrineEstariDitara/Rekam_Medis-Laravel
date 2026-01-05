@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Pasien</h2>
    <p class="text-muted">Selamat datang, {{ $pasien->nama }}</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kunjungan
                        </div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalKunjungan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-calendar-check text-primary" style="font-size: 2rem;"></i>
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
                            Kunjungan Terakhir
                        </div>
                        <div class="h6 mb-0 font-weight-bold">
                            {{ $kunjunganTerakhir ? $kunjunganTerakhir->tanggal_periksa->format('d/m/Y') : 'Belum ada' }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-clock-history text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0">Profil Saya</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">No. Rekam Medis</th>
                        <td>: {{ $pasien->no_rm }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: {{ $pasien->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: {{ $pasien->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ $pasien->tanggal_lahir->format('d/m/Y') }}</td>
                    </tr>
                </table>
                <a href="{{ route('pasien.profil.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h6 class="m-0">Quick Menu</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('pasien.rekam-medis.index') }}" class="btn btn-info btn-sm mb-2 w-100">
                    <i class="bi bi-file-medical"></i> Lihat Riwayat Medis
                </a>
                <a href="{{ route('pasien.resep.index') }}" class="btn btn-warning btn-sm w-100">
                    <i class="bi bi-prescription2"></i> Lihat Resep Obat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
