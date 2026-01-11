@extends('layouts.app')

@section('title', 'Tambah Profil Dokter')

@section('content')
<div class="page-header mb-4">
    <h2 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Tambah Profil Dokter</h2>
</div>

@if($availableUsers->isEmpty())
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-person-x fs-1 text-muted d-block mb-3"></i>
        <h5 class="text-muted">Tidak Ada User Dokter Tersedia</h5>
        <p class="text-muted mb-4">
            Semua user dengan role "Dokter" sudah memiliki profil, atau belum ada user dokter yang dibuat oleh Admin.
        </p>
        <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('staff.dokter.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
        </div>
        <div class="alert alert-info mt-4 text-start">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Catatan:</strong> Untuk menambah dokter baru, hubungi <strong>Admin</strong> untuk membuat akun user dengan role "Dokter" terlebih dahulu melalui menu <strong>Kelola User</strong>.
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        <div class="alert alert-info mb-4">
            <i class="bi bi-info-circle me-2"></i>
            Pilih user dokter yang sudah dibuat oleh Admin, lalu lengkapi data profil dokternya.
        </div>

        <form action="{{ route('staff.dokter.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="user_id" class="form-label">Pilih User Dokter <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">-- Pilih User Dokter --</option>
                    @foreach($availableUsers as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">User dengan role "Dokter" yang belum memiliki profil</small>
            </div>

            <hr class="my-4">
            <h6 class="text-muted mb-3"><i class="bi bi-card-text me-2"></i>Data Profil Dokter</h6>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="spesialis" class="form-label">Spesialis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('spesialis') is-invalid @enderror" id="spesialis" name="spesialis" value="{{ old('spesialis') }}" placeholder="Contoh: Penyakit Dalam, Anak, Kandungan" required>
                        @error('spesialis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap dokter">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('staff.dokter.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
