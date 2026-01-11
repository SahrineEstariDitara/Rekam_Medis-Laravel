@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-people-fill"></i> Data Pasien</h2>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="15%">NO. RM</th>
                        <th width="20%">NAMA PASIEN</th>
                        <th width="15%">JENIS KELAMIN</th>
                        <th width="20%">ALAMAT</th>
                        <th width="10%">NO. TELEPON</th>
                        <th width="15%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $index => $pasien)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $pasiens->firstItem() + $index }}</td>
                            <td class="align-middle">
                                <span class="badge rounded-pill fw-normal" style="background-color: #FFDFEF; color: #AA60C8; border: 1px solid #EABDE6;">
                                    {{ $pasien->no_rm }}
                                </span>
                            </td>
                            <td class="fw-medium text-dark align-middle">{{ $pasien->nama }}</td>
                            <td class="align-middle">
                                @if($pasien->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill">
                                        <i class="bi bi-gender-male me-1"></i> Laki-laki
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 rounded-pill">
                                        <i class="bi bi-gender-female me-1"></i> Perempuan
                                    </span>
                                @endif
                            </td>
                            <td class="small text-muted align-middle text-truncate" style="max-width: 200px;" title="{{ $pasien->alamat }}">{{ $pasien->alamat ?? '-' }}</td>
                            <td class="small text-muted align-middle">{{ $pasien->no_tlp ?? '-' }}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.pasien.edit', $pasien) }}" class="btn btn-sm btn-light shadow-sm" style="color: #AA60C8; border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.pasien.destroy', $pasien) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pasien ini? Akun user terkait juga akan dihapus.')">
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
