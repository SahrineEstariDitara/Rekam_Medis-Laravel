@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Dokter</h2>
        <small class="text-muted">Kelola profil dokter (spesialis, telepon, alamat)</small>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="20%">NAMA DOKTER</th>
                        <th width="20%">EMAIL</th>
                        <th width="15%">SPESIALIS</th>
                        <th width="15%">NO. TELEPON</th>
                        <th width="15%">ALAMAT</th>
                        <th width="10%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokters as $index => $dokter)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $dokters->firstItem() + $index }}</td>
                            <td class="fw-medium text-dark align-middle">{{ $dokter->nama }}</td>
                            <td class="text-muted small align-middle">{{ $dokter->user->email ?? '-' }}</td>
                            <td class="align-middle">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill fw-normal">
                                    {{ $dokter->spesialis }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $dokter->no_telp ?? '-' }}</td>
                            <td class="align-middle">
                                @if($dokter->alamat)
                                    <span class="text-truncate d-inline-block text-muted small" style="max-width: 150px;" title="{{ $dokter->alamat }}">{{ $dokter->alamat }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.dokter.edit', $dokter) }}" class="btn btn-sm btn-light shadow-sm" style="color: #AA60C8; border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Edit Profil">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.dokter.destroy', $dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus profil dokter ini?\n\nCatatan: Akun user tetap ada dan dapat ditambahkan kembali.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm" style="border-radius: 0 8px 8px 0; border: 1px solid #eee; border-left: none;" title="Hapus Profil">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-person-badge fs-1 d-block mb-2 opacity-50"></i>
                                <p class="mb-2">Tidak ada data profil dokter</p>
                                <small>Tambahkan profil untuk user dokter yang sudah dibuat oleh Admin</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($dokters->hasPages())
        <div class="d-flex justify-content-end p-3 border-top">
            {{ $dokters->links() }}
        </div>
        @endif
    </div>
</div>

<div class="alert alert-light border mt-4">
    <div class="d-flex">
        <i class="bi bi-lightbulb text-warning me-3 fs-5"></i>
        <div>
            <strong>Cara Kerja:</strong>
            <ol class="mb-0 ps-3 mt-2">
                <li><strong>Admin</strong> membuat akun user dengan role "Dokter" di menu <em>Kelola User</em></li>
                <li><strong>Staff</strong> melengkapi profil dokter (spesialis, telepon, alamat) di halaman ini</li>
            </ol>
        </div>
    </div>
</div>
@endsection