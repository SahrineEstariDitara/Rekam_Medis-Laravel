@extends('layouts.app')

@section('title', 'Edit Obat')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-capsule-pill"></i> Edit Obat</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('staff.obat.update', $obat) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" 
                       id="nama_obat" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                @error('nama_obat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Obat <span class="text-danger">*</span></label>
                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                    <option value="">Pilih Jenis Obat</option>
                    <option value="Obat Bebas" {{ old('jenis', $obat->jenis) == 'Obat Bebas' ? 'selected' : '' }}>Obat Bebas (Hijau)</option>
                    <option value="Obat Bebas Terbatas" {{ old('jenis', $obat->jenis) == 'Obat Bebas Terbatas' ? 'selected' : '' }}>Obat Bebas Terbatas (Biru)</option>
                    <option value="Obat Keras" {{ old('jenis', $obat->jenis) == 'Obat Keras' ? 'selected' : '' }}>Obat Keras (Merah)</option>
                </select>
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                       id="stok" name="stok" value="{{ old('stok', $obat->stok) }}" min="0" required>
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan / Indikasi</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                          id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $obat->keterangan) }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('staff.obat.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
