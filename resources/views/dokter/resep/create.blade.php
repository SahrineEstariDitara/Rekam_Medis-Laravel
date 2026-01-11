@extends('layouts.app')

@section('title', 'Tambah Resep Obat')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-capsule"></i> Tambah Resep Obat</h2>
    <p class="text-muted">
        Pasien: <strong>{{ $rekamMedis->pasien->nama }}</strong> | 
        No. RM: <strong>{{ $rekamMedis->pasien->no_rm }}</strong>
    </p>
</div>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Input Resep</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('dokter.resep.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="rekam_medis_id" value="{{ $rekamMedis->id }}">

            <div class="mb-3">
                <label for="obat_id" class="form-label">Pilih Obat <span class="text-danger">*</span></label>
                <select name="obat_id" id="obat_id" class="form-select @error('obat_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Obat --</option>
                    @foreach($obat as $o)
                        <option value="{{ $o->id }}" {{ old('obat_id') == $o->id ? 'selected' : '' }}>
                            {{ $o->nama_obat }} (Stok Tersedia: {{ $o->stok }} {{ $o->satuan }})
                        </option>
                    @endforeach
                </select>
                @error('obat_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" 
                           min="1" value="{{ old('jumlah') }}" placeholder="Contoh: 10" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dosis" class="form-label">Aturan Pakai / Dosis <span class="text-danger">*</span></label>
                    <input type="text" name="dosis" id="dosis" class="form-control @error('dosis') is-invalid @enderror" 
                           value="{{ old('dosis') }}" placeholder="Contoh: 3x1 Sesudah Makan" required>
                    @error('dosis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('dokter.rekam-medis.show', $rekamMedis->id) }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Simpan Resep
                </button>
            </div>
        </form>
    </div>
</div>
@endsection