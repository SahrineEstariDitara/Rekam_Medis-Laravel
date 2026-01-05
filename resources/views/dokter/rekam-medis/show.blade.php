@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-medical"></i> Detail Rekam Medis</h2>
    <div>
        <a href="{{ route('dokter.rekam-medis.edit', $rekamMedi) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('dokter.resep.create', $rekamMedi->id) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Resep
        </a>
    </div>
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
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $rekamMedi->pasien->alamat }}</td>
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
            <h6 class="text-primary">Keluhan:</h6>
            <p>{{ $rekamMedi->keluhan }}</p>
        </div>
        <div class="mb-3">
            <h6 class="text-primary">Diagnosa:</h6>
            <p>{{ $rekamMedi->diagnosa }}</p>
        </div>
        <div class="mb-3">
            <h6 class="text-primary">Tindakan:</h6>
            <p>{{ $rekamMedi->tindakan }}</p>
        </div>
        @if($rekamMedi->catatan)
            <div class="mb-3">
                <h6 class="text-primary">Catatan:</h6>
                <p>{{ $rekamMedi->catatan }}</p>
            </div>
        @endif
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Resep Obat</h5>
    </div>
    <div class="card-body">
        @if($rekamMedi->resep->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedi->resep as $index => $r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $r->obat->nama_obat }}</td>
                                <td>{{ $r->dosis }}</td>
                                <td>
                                    <form action="{{ route('dokter.resep.destroy', $r) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus resep ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada resep obat</p>
        @endif
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
@endsection
