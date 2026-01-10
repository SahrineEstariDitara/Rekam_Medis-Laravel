@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-person-plus"></i> Tambah User Baru</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>

</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <h6 class="text-uppercase text-muted fw-bold mb-3">Informasi Akun</h6>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" name="role" required onchange="toggleRoleFields()">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="dokter" {{ old('role') === 'dokter' ? 'selected' : '' }}>Dokter</option>
                                <option value="pasien" {{ old('role') === 'pasien' ? 'selected' : '' }}>Pasien</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Field untuk Dokter -->
                    <div id="dokter-fields" class="mb-4" style="display: none;">
                        <h6 class="text-uppercase text-muted fw-bold mb-3">Data Dokter</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_dokter" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="spesialis" class="form-label">Spesialis <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="spesialis" name="spesialis" value="{{ old('spesialis') }}" placeholder="Contoh: Umum, Gigi, Anak">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Field untuk Pasien -->
                    <div id="pasien-fields" class="mb-4" style="display: none;">
                        <h6 class="text-uppercase text-muted fw-bold mb-3">Data Pasien</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="no_rm" class="form-label">No. Rekam Medis <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ old('no_rm') }}" placeholder="Contoh: RM001">
                            </div>
                            <div class="col-md-6">
                                <label for="nama_pasien" class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
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

document.addEventListener('DOMContentLoaded', toggleRoleFields);
</script>
@endpush
@endsection

