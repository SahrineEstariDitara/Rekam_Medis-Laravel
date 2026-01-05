@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-file-medical"></i> Detail Rekam Medis</h2>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Pasien</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">No. Rekam Medis</th>
                        <td>: {{ $rekamMedi->pasien->no_rm }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: {{ $rekamMedi->pasien->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: {{ $rekamMedi->pasien->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ $rekamMedi->pasien->tanggal_lahir->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Informasi Pemeriksaan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Tanggal Periksa</th>
                        <td>: {{ $rekamMedi->tanggal_periksa->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>: {{ $rekamMedi->dokter->nama }}</td>
                    </tr>
                    <tr>
                        <th>Spesialis</th>
                        <td>: {{ $rekamMedi->dokter->spesialis }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Detail Pemeriksaan</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h6 class="text-primary"><i class="bi bi-chat-left-text"></i> Keluhan:</h6>
            <p class="ms-3">{{ $rekamMedi->keluhan }}</p>
        </div>
        <hr>
        <div class="mb-3">
            <h6 class="text-primary"><i class="bi bi-clipboard-pulse"></i> Diagnosa:</h6>
            <p class="ms-3">{{ $rekamMedi->diagnosa }}</p>
        </div>
        <hr>
        <div class="mb-3">
            <h6 class="text-primary"><i class="bi bi-heart-pulse"></i> Tindakan:</h6>
            <p class="ms-3">{{ $rekamMedi->tindakan }}</p>
        </div>
        @if($rekamMedi->catatan)
            <hr>
            <div class="mb-3">
                <h6 class="text-primary"><i class="bi bi-journal-text"></i> Catatan:</h6>
                <p class="ms-3 fst-italic text-muted">{{ $rekamMedi->catatan }}</p>
            </div>
        @endif
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="bi bi-prescription2"></i> Resep Obat</h5>
    </div>
    <div class="card-body">
        @if($rekamMedi->resep->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedi->resep as $index => $r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <i class="bi bi-capsule text-primary"></i> 
                                    {{ $r->obat->nama_obat }}
                                </td>
                                <td>{{ $r->dosis }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="bi bi-info-circle"></i> Tidak ada resep obat untuk pemeriksaan ini
            </div>
        @endif
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('pasien.rekam-medis.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
    </a>
</div>
@endsection
