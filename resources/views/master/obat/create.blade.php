@extends('layouts.app')

@section('title', 'Tambah Obat')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-capsule-pill"></i> Tambah Obat Baru</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('master.obat.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" 
                       id="nama_obat" name="nama_obat" value="{{ old('nama_obat') }}" required>
                @error('nama_obat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                       id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required>
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('master.obat.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
