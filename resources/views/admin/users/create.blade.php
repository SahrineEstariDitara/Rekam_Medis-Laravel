@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah User Baru</h5>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role Pengguna <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-select" onchange="toggleFields()" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ (old('role') ?? $role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ (old('role') ?? $role) == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="dokter" {{ (old('role') ?? $role) == 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="pasien" {{ (old('role') ?? $role) == 'pasien' ? 'selected' : '' }}>Pasien</option>
                        </select>
                    </div>

                    <!-- Data Akun Utama -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap (Akun) <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Data Profil Umum -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">Pilih...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Field Khusus Dokter -->
                    <div id="dokterFields" style="display: none;" class="border p-3 rounded mb-3 bg-light">
                        <h6 class="text-primary"><i class="bi bi-person-badge me-2"></i>Data Dokter</h6>
                        <div class="mb-3">
                            <label for="nama_dokter" class="form-label">Nama Dokter (dengan Gelar)</label>
                            <input type="text" name="nama_dokter" class="form-control" value="{{ old('nama_dokter') }}" placeholder="Contoh: dr. Budi Santoso, Sp.PD">
                            <small class="text-muted">Jika kosong, akan menggunakan Nama Lengkap Akun.</small>
                        </div>
                        <div class="mb-3">
                            <label for="spesialis" class="form-label">Spesialis</label>
                            <input type="text" name="spesialis" class="form-control" value="{{ old('spesialis') }}" placeholder="Contoh: Penyakit Dalam">
                        </div>
                    </div>

                    <!-- Field Khusus Pasien -->
                    <div id="pasienFields" style="display: none;" class="border p-3 rounded mb-3 bg-light">
                        <h6 class="text-primary"><i class="bi bi-person-wheelchair me-2"></i>Data Pasien</h6>
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" value="{{ old('nama_pasien') }}">
                            <small class="text-muted">Jika kosong, akan menggunakan Nama Lengkap Akun.</small>
                        </div>
                        <div class="mb-3">
                            <label for="no_rm" class="form-label">Nomor Rekam Medis (No. RM)</label>
                            <input type="text" name="no_rm" class="form-control" value="{{ old('no_rm') }}" placeholder="Contoh: RM-2024-001">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan User Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        const role = document.getElementById('role').value;
        const dokterFields = document.getElementById('dokterFields');
        const pasienFields = document.getElementById('pasienFields');

        // Reset display
        dokterFields.style.display = 'none';
        pasienFields.style.display = 'none';

        if (role === 'dokter') {
            dokterFields.style.display = 'block';
        } else if (role === 'pasien') {
            pasienFields.style.display = 'block';
        }
    }

    // Jalankan saat halaman dimuat (untuk old input saat validasi gagal)
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection