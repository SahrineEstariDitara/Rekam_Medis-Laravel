@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-people-fill"></i> Data Pasien</h2>
    <a href="{{ route('staff.pasien.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-2"></i>Tambah Pasien
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>Jaminan</th> <!-- Optional if needed later, ignoring for now based on fields -->
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $index => $pasien)
                        <tr>
                            <td class="text-muted">{{ $pasiens->firstItem() + $index }}</td>
                            <td><span class="badge" style="background-color: #FFDFEF; color: #AA60C8;">{{ $pasien->no_rm }}</span></td>
                            <td class="fw-medium">{{ $pasien->nama }}</td>
                            <td>
                                @if($pasien->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-info bg-opacity-10 text-info"><i class="bi bi-gender-male me-1"></i> Laki-laki</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-gender-female me-1"></i> Perempuan</span>
                                @endif
                            </td>
                             <td class="small text-muted">{{ Str::limit($pasien->alamat, 40) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('staff.pasien.edit', $pasien) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.pasien.destroy', $pasien) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pasien ini? Akun user terkait juga akan dihapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                Tidak ada data pasien
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pasiens->hasPages())
        <div class="d-flex justify-content-end p-3 border-top">
            {{ $pasiens->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
