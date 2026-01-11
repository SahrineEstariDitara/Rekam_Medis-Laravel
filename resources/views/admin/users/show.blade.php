@extends('layouts.app')

@section('title', 'Detail Profil User')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Detail Profil</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <!-- Kartu Profil Singkat -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center p-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold mx-auto mb-3" 
                     style="width: 100px; height: 100px; background-color: #FFDFEF; color: #AA60C8; font-size: 2.5rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <span class="badge bg-primary text-uppercase mb-4">{{ $user->role }}</span>
                
                <div class="d-grid">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detail Informasi -->
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Informasi Lengkap</h5>
            </div>
            <div class="card-body">
                
                @if($user->role === 'pasien' && $user->pasien)
                    <h6 class="text-primary mb-3"><i class="bi bi-person-wheelchair me-2"></i>Data Pasien</h6>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">No. Rekam Medis</div>
                        <div class="col-sm-8 fw-bold">{{ $user->pasien->no_rm }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Lengkap</div>
                        <div class="col-sm-8">{{ $user->pasien->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Jenis Kelamin</div>
                        <div class="col-sm-8">{{ $user->pasien->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Tanggal Lahir</div>
                        <div class="col-sm-8">{{ \Carbon\Carbon::parse($user->pasien->tanggal_lahir)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Alamat</div>
                        <div class="col-sm-8">{{ $user->pasien->alamat }}</div>
                    </div>

                    <!-- Riwayat Medis Singkat -->
                    @if($user->pasien->rekamMedis && $user->pasien->rekamMedis->count() > 0)
                        <hr class="my-4">
                        <h6 class="text-primary mb-3"><i class="bi bi-clock-history me-2"></i>Riwayat Kunjungan Terakhir</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Dokter</th>
                                        <th>Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->pasien->rekamMedis as $rm)
                                    <tr>
                                        <td>{{ $rm->tanggal_periksa->format('d/m/Y') }}</td>
                                        <td>{{ $rm->dokter->nama ?? '-' }}</td>
                                        <td>{{ $rm->diagnosa }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif($user->role === 'dokter' && $user->dokter)
                    <h6 class="text-primary mb-3"><i class="bi bi-person-badge me-2"></i>Data Dokter</h6>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Dokter</div>
                        <div class="col-sm-8 fw-bold">{{ $user->dokter->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Spesialis</div>
                        <div class="col-sm-8">{{ $user->dokter->spesialis }}</div>
                    </div>
                @endif

                @if($user->role === 'admin' || $user->role === 'staff')
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>User ini adalah <strong>{{ ucfirst($user->role) }}</strong> sistem.
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
