@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-file-earmark-medical-fill"></i> Detail Rekam Medis</h2>
    <a href="{{ route('staff.rekam-medis.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Informasi Pemeriksaan</h5>
                <span class="badge bg-primary">{{ $rekamMedis->tanggal_periksa->format('d F Y') }}</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold">Pasien</label>
                        <p class="fs-5 fw-medium text-dark mb-0">{{ $rekamMedis->pasien->nama }}</p>
                        <span class="text-muted small">No. RM: {{ $rekamMedis->pasien->no_rm }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold">Dokter Pemeriksa</label>
                        <p class="fs-5 fw-medium text-dark mb-0">{{ $rekamMedis->dokter->nama }}</p>
                        <span class="text-muted small">{{ $rekamMedis->dokter->spesialis }}</span>
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Keluhan</label>
                    <p class="text-dark bg-light p-3 rounded">{{ $rekamMedis->keluhan }}</p>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Diagnosa</label>
                    <p class="text-dark bg-light p-3 rounded">{{ $rekamMedis->diagnosa }}</p>
                </div>

                <div class="mb-0">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Tindakan</label>
                    <p class="text-dark bg-light p-3 rounded">{{ $rekamMedis->tindakan }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Resep Obat</h5>
            </div>
            <div class="card-body">
                @if($rekamMedis->resep->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($rekamMedis->resep as $resep)
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-primary">{{ $resep->obat->nama_obat }}</span>
                                    <span class="badge bg-secondary bg-opacity-10 text-dark">{{ $resep->jumlah }} {{ $resep->satuan ?? 'pcs' }}</span>
                                </div>
                                <p class="mb-0 small text-muted fst-italic">{{ $resep->aturan_pakai }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-capsule-pill fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">Belum ada resep obat.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="d-grid mt-3">
             <a href="{{ route('staff.rekam-medis.edit', $rekamMedis) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit Data
            </a>
        </div>
    </div>
</div>
@endsection
