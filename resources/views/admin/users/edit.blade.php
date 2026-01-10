@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-person-gear"></i> Edit User</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>

</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-uppercase text-muted fw-bold mb-3">Informasi Akun</h6>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <span class="text-muted">(Kosongkan jika tidak diubah)</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                            <small class="text-muted">Role tidak dapat diubah</small>
                        </div>
                    </div>
                    
                    @if($user->role === 'dokter' && $user->dokter)
                    <h6 class="text-uppercase text-muted fw-bold mb-3">Data Dokter</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="nama_dokter" class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" 
                                   value="{{ old('nama_dokter', $user->dokter->nama) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="spesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="spesialis" name="spesialis" 
                                   value="{{ old('spesialis', $user->dokter->spesialis) }}">
                        </div>
                    </div>
                    @endif
                    
                    @if($user->role === 'pasien' && $user->pasien)
                    <h6 class="text-uppercase text-muted fw-bold mb-3">Data Pasien</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="no_rm" class="form-label">No. Rekam Medis</label>
                            <input type="text" class="form-control" value="{{ $user->pasien->no_rm }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" 
                                   value="{{ old('nama_pasien', $user->pasien->nama) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki" {{ $user->pasien->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $user->pasien->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir', $user->pasien->tanggal_lahir) }}">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->pasien->alamat) }}</textarea>
                        </div>
                    </div>
                    @endif
                    
                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Update
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
@endsection
