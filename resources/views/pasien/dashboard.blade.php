@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold" style="color: #AA60C8;"><i class="bi bi-speedometer2 me-2"></i>Dashboard Pasien</h2>
    <p class="text-muted">Selamat datang kembali, <span class="fw-bold text-dark">{{ $pasien->nama }}</span>! 👋</p>
</div>

<div class="row g-4 mb-5">
    <!-- Stats Card: Total Kunjungan -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #FFF0F5 0%, #FFFFFF 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" 
                     style="width: 60px; height: 60px; background-color: #EABDE6; color: white;">
                    <i class="bi bi-calendar-check fs-3"></i>
                </div>
                <div>
                    <div class="text-uppercase fw-bold small text-muted mb-1">Total Kunjungan</div>
                    <div class="h3 fw-bold mb-0" style="color: #AA60C8;">{{ $totalKunjungan }} <span class="fs-6 text-muted fw-normal">kali</span></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Card: Kunjungan Terakhir -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #E0F7FA 0%, #FFFFFF 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" 
                     style="width: 60px; height: 60px; background-color: #4DD0E1; color: white;">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
                <div>
                    <div class="text-uppercase fw-bold small text-muted mb-1">Kunjungan Terakhir</div>
                    <div class="h4 fw-bold mb-0" style="color: #00BCD4;">
                        {{ $kunjunganTerakhir ? $kunjunganTerakhir->tanggal_periksa->format('d F Y') : 'Belum ada' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Profil Saya -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header border-0 py-3" style="background-color: #FFDFEF;">
                <h5 class="m-0 fw-bold" style="color: #AA60C8;">
                    <i class="bi bi-person-circle me-2"></i>Profil Saya
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3 border" 
                         style="width: 70px; height: 70px; border-color: #EABDE6 !important;">
                         @if($pasien->jenis_kelamin == 'Laki-laki')
                            <i class="bi bi-gender-male fs-1 text-primary opacity-75"></i>
                         @else
                            <i class="bi bi-gender-female fs-1" style="color: #AA60C8; opacity: 0.75;"></i>
                         @endif
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $pasien->nama }}</h5>
                        <div class="badge rounded-pill mt-1" style="background-color: #D69ADE; font-weight: normal;">
                            {{ $pasien->no_rm }}
                        </div>
                    </div>
                </div>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="small text-muted text-uppercase fw-bold">Jenis Kelamin</label>
                            <div class="fw-medium text-dark">{{ $pasien->jenis_kelamin }}</div>
                        </div>
                        <div class="col-6">
                            <label class="small text-muted text-uppercase fw-bold">Tanggal Lahir</label>
                            <div class="fw-medium text-dark">{{ $pasien->tanggal_lahir->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('pasien.profil.index') }}" class="btn w-100 fw-bold py-2 shadow-sm text-white" 
                   style="border-radius: 12px; background: linear-gradient(90deg, #D69ADE 0%, #AA60C8 100%); border: none;">
                    <i class="bi bi-pencil-square me-2"></i>Lihat Detail Profil
                </a>
            </div>
        </div>
    </div>
    
    <!-- Quick Menu -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header border-0 py-3" style="background-color: #E6E6FA;">
                <h5 class="m-0 fw-bold" style="color: #6A5ACD;">
                    <i class="bi bi-grid-fill me-2"></i>Menu Cepat
                </h5>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center gap-3">
                <a href="{{ route('pasien.rekam-medis.index') }}" class="btn text-start p-4 border-0 shadow-sm d-flex align-items-center transition-hover" 
                   style="background: linear-gradient(135deg, #89CFF0 0%, #4682B4 100%); border-radius: 15px; color: white;">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-file-medical-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Riwayat Medis</h5>
                        <small class="text-white-50">Lihat riwayat pemeriksaan & diagnosa</small>
                    </div>
                    <i class="bi bi-arrow-right ms-auto fs-4"></i>
                </a>

                <a href="{{ route('pasien.resep.index') }}" class="btn text-start p-4 border-0 shadow-sm d-flex align-items-center transition-hover" 
                   style="background: linear-gradient(135deg, #FAD0C4 0%, #FF9A9E 100%); border-radius: 15px; color: white;">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-capsule fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Resep Obat</h5>
                        <small class="text-white-50">Lihat resep obat yang diberikan dokter</small>
                    </div>
                    <i class="bi bi-arrow-right ms-auto fs-4"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.2s;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
