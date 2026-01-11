@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Kelola User</h2>
    <a href="{{ route('staff.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>DETAIL</th>
                        <th width="15%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $index + 1 }}</td>
                            <td class="fw-medium text-dark align-middle">{{ $user->name }}</td>
                            <td class="text-muted small align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @if($user->role === 'staff')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 rounded-pill fw-normal">Staff</span>
                                @elseif($user->role === 'dokter')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill fw-normal">Dokter</span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 rounded-pill fw-normal">Pasien</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($user->role === 'dokter' && $user->dokter)
                                    <span class="text-muted small">Spesialis: {{ $user->dokter->spesialis }}</span>
                                @elseif($user->role === 'pasien' && $user->pasien)
                                    <span class="text-muted small">No. RM: {{ $user->pasien->no_rm }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.users.show', $user) }}" class="btn btn-sm btn-light text-info shadow-sm" style="border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('staff.users.edit', $user) }}" class="btn btn-sm btn-light shadow-sm" style="color: #AA60C8; border-radius: 0; border: 1px solid #eee; border-left: none;" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm" style="border-radius: 0 8px 8px 0; border: 1px solid #eee; border-left: none;" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-25"></i>
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
