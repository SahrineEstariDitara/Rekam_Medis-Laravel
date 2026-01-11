@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-file-earmark-plus"></i> Tambah Rekam Medis</h2>

</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('staff.rekam-medis.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="pasien_id" class="form-label">Pasien <span class="text-danger">*</span></label>
                            <select class="form-select @error('pasien_id') is-invalid @enderror" id="pasien_id" name="pasien_id" required>
                                <option value="">Pilih Pasien</option>
                                @foreach($pasien as $p)
                                    <option value="{{ $p->id }}" {{ old('pasien_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->no_rm }} - {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pasien_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="dokter_id" class="form-label">Dokter Pemeriksa <span class="text-danger">*</span></label>
                            <select class="form-select @error('dokter_id') is-invalid @enderror" id="dokter_id" name="dokter_id" required>
                                <option value="">Pilih Dokter</option>
                                @foreach($dokter as $d)
                                    <option value="{{ $d->id }}" {{ old('dokter_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} ({{ $d->spesialis }})
                                    </option>
                                @endforeach
                            </select>
                            @error('dokter_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="tanggal_periksa" class="form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_periksa') is-invalid @enderror" 
                                   id="tanggal_periksa" name="tanggal_periksa" 
                                   value="{{ old('tanggal_periksa', date('Y-m-d')) }}" required>
                            @error('tanggal_periksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="keluhan" class="form-label">Keluhan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keluhan') is-invalid @enderror" 
                                      id="keluhan" name="keluhan" rows="3" required>{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                      id="diagnosa" name="diagnosa" rows="3" required>{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="tindakan" class="form-label">Tindakan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('tindakan') is-invalid @enderror" 
                                      id="tindakan" name="tindakan" rows="3" required>{{ old('tindakan') }}</textarea>
                            @error('tindakan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between pt-3 border-top mt-4">
                        <a href="{{ route('staff.rekam-medis.index') }}" class="btn btn-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
