@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-person-plus"></i> Tambah User Baru</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('staff.users.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" name="role" required onchange="toggleRoleFields()">
                            <option value="">Pilih Role</option>
                            <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="dokter" {{ old('role') === 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="pasien" {{ old('role') === 'pasien' ? 'selected' : '' }}>Pasien</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Field untuk Dokter -->
            <div id="dokter-fields" style="display: none;">
                <hr>
                <h5>Data Dokter</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_dokter" class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="spesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="spesialis" name="spesialis" value="{{ old('spesialis') }}">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Field untuk Pasien -->
            <div id="pasien-fields" style="display: none;">
                <hr>
                <h5>Data Pasien</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_rm" class="form-label">No. Rekam Medis</label>
                            <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ old('no_rm') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('staff.users.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleRoleFields() {
    const role = document.getElementById('role').value;
    const dokterFields = document.getElementById('dokter-fields');
    const pasienFields = document.getElementById('pasien-fields');
    
    dokterFields.style.display = 'none';
    pasienFields.style.display = 'none';
    
    if (role === 'dokter') {
        dokterFields.style.display = 'block';
    } else if (role === 'pasien') {
        pasienFields.style.display = 'block';
    }
}

// Trigger on page load
document.addEventListener('DOMContentLoaded', toggleRoleFields);
</script>
@endpush
@endsection
