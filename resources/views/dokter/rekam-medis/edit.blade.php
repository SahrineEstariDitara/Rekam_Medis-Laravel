@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-pencil-square"></i> Edit Rekam Medis</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('dokter.rekam-medis.update', $rekamMedi->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">Nama Pasien</label>
                        <select class="form-select" disabled>
                            <option selected>{{ $rekamMedi->pasien->no_rm }} - {{ $rekamMedi->pasien->nama }}</option>
                        </select>
                        <input type="hidden" name="pasien_id" value="{{ $rekamMedi->pasien_id }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_periksa" class="form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_periksa') is-invalid @enderror" 
                               id="tanggal_periksa" name="tanggal_periksa" 
                               value="{{ old('tanggal_periksa', $rekamMedi->tanggal_periksa->format('Y-m-d')) }}" required>
                        @error('tanggal_periksa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan <span class="text-danger">*</span></label>
                <textarea class="form-control @error('keluhan') is-invalid @enderror" 
                          id="keluhan" name="keluhan" rows="3" required>{{ old('keluhan', $rekamMedi->keluhan) }}</textarea>
                @error('keluhan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                          id="diagnosa" name="diagnosa" rows="3" required>{{ old('diagnosa', $rekamMedi->diagnosa) }}</textarea>
                @error('diagnosa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="tindakan" class="form-label">Tindakan <span class="text-danger">*</span></label>
                <textarea class="form-control @error('tindakan') is-invalid @enderror" 
                          id="tindakan" name="tindakan" rows="3" required>{{ old('tindakan', $rekamMedi->tindakan) }}</textarea>
                @error('tindakan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                          id="catatan" name="catatan" rows="2">{{ old('catatan', $rekamMedi->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Perubahan
                </button>
                <a href="{{ route('dokter.rekam-medis.show', $rekamMedi->id) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection