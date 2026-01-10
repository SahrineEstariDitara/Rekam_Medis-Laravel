@extends('layouts.app')

@section('title', 'Tambah Obat')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-capsule-pill"></i> Tambah Obat Baru</h2>
    <a href="{{ route('staff.obat.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('staff.obat.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" 
                               id="nama_obat" name="nama_obat" value="{{ old('nama_obat') }}" 
                               placeholder="Masukkan nama obat" required>
                        @error('nama_obat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Obat <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis Obat</option>
                            <option value="Obat Bebas" {{ old('jenis') == 'Obat Bebas' ? 'selected' : '' }}>Obat Bebas (Hijau)</option>
                            <option value="Obat Bebas Terbatas" {{ old('jenis') == 'Obat Bebas Terbatas' ? 'selected' : '' }}>Obat Bebas Terbatas (Biru)</option>
                            <option value="Obat Keras" {{ old('jenis') == 'Obat Keras' ? 'selected' : '' }}>Obat Keras (Merah)</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                               id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan / Indikasi</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="3" 
                                  placeholder="Contoh: Obat untuk sakit kepala, demam, dll.">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('staff.obat.index') }}" class="btn btn-outline-primary">
                            Batal
                        </a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

