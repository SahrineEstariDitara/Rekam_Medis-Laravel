@extends('layouts.app')

@section('title', 'Edit Profil Dokter')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('staff.dokter.index') }}" class="btn btn-light rounded-circle shadow-sm me-3 text-secondary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                 <h4 class="mb-0 fw-bold" style="color: var(--primary-color);">Edit Profil Dokter</h4>
                 <p class="text-muted mb-0 small">Perbarui informasi spesialis dan kontak dokter</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4">
                
                <!-- Read-Only User Info Section -->
                <div class="d-flex align-items-center p-3 mb-4 rounded-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 1px solid #dee2e6;">
                    <div class="bg-white rounded-circle p-3 shadow-sm me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person-fill fs-3 text-secondary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <label class="small text-uppercase fw-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 1px;">Akun Pengguna (Read-Only)</label>
                        <h5 class="fw-bold mb-0 text-dark">{{ $dokter->user->name }}</h5>
                        <div class="text-muted small"><i class="bi bi-envelope me-1"></i> {{ $dokter->user->email }}</div>
                    </div>
                    <div class="text-end d-none d-sm-block">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 rounded-pill px-3 py-2">
                            <i class="bi bi-shield-lock me-1"></i> Managed by Admin
                        </span>
                    </div>
                </div>

                <form action="{{ route('staff.dokter.update', $dokter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="fw-bold mb-3 d-flex align-items-center" style="color: var(--primary-color);">
                        <i class="bi bi-clipboard2-pulse me-2"></i> Informasi Profesional & Kontak
                    </h6>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-4 @error('spesialis') is-invalid @enderror" id="spesialis" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" placeholder="Spesialis" required style="border-color: #eee;">
                                <label for="spesialis" class="text-muted"><i class="bi bi-stethoscope me-1"></i> Spesialis <span class="text-danger">*</span></label>
                            </div>
                            @error('spesialis')
                                <div class="invalid-feedback d-block ms-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text ms-1 small text-muted">Contoh: Penyakit Dalam, Anak, Kandungan</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-4 @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $dokter->no_telp) }}" placeholder="No. Telepon" style="border-color: #eee;">
                                <label for="no_telp" class="text-muted"><i class="bi bi-telephone me-1"></i> No. Telepon</label>
                            </div>
                            @error('no_telp')
                                <div class="invalid-feedback d-block ms-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-floating">
                            <textarea class="form-control rounded-4 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat" style="height: 100px; border-color: #eee;">{{ old('alamat', $dokter->alamat) }}</textarea>
                            <label for="alamat" class="text-muted"><i class="bi bi-geo-alt me-1"></i> Alamat Lengkap</label>
                        </div>
                        @error('alamat')
                            <div class="invalid-feedback d-block ms-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('staff.dokter.index') }}" class="btn btn-light rounded-pill px-4 fw-bold text-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
