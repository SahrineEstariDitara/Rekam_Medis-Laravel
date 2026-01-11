@extends('layouts.app')

@section('title', 'Riwayat Medis')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-file-medical-fill"></i> Riwayat Kesehatan Saya</h2>
</div>

<div class="row">
    <div class="col-md-12">
        @forelse($rekamMedis as $rm)
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; transition: transform 0.2s;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; box-shadow: 0 4px 10px rgba(170, 96, 200, 0.3);">
                                <i class="bi bi-clipboard2-pulse fs-1"></i>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h5 class="fw-bold text-dark mb-1">
                                Pemeriksaan Dokter
                                <small class="text-muted fw-normal ms-2" style="font-size: 0.9rem;">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $rm->tanggal_periksa->format('d M Y') }}
                                </small>
                            </h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-person-fill me-1"></i> {{ $rm->dokter->nama }} 
                                <span class="badge bg-info bg-opacity-10 text-info ms-2">{{ $rm->dokter->spesialis }}</span>
                            </p>
                            <div class="p-3 bg-light rounded-3 mb-2">
                                <span class="d-block text-muted small fw-bold text-uppercase">Diagnosa</span>
                                <span class="text-dark fw-medium">{{ Str::limit($rm->diagnosa, 100) }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="d-grid gap-2">
                                <a href="{{ route('pasien.rekam-medis.show', $rm) }}" class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                                {{-- Placeholder for PDF Download --}}
                                <a href="{{ route('pasien.rekam-medis.download', $rm) }}" class="btn btn-primary rounded-pill text-white" target="_blank">
                                    <i class="bi bi-file-pdf me-2"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-journal-medical text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                </div>
                <h4 class="text-muted">Belum ada riwayat pemeriksaan</h4>
                <p class="text-muted small">Riwayat pemeriksaan kesehatan Anda akan muncul di sini.</p>
            </div>
        @endforelse

        <div class="d-flex justify-content-end mt-4">
            {{ $rekamMedis->links() }}
        </div>
    </div>
</div>
@endsection

