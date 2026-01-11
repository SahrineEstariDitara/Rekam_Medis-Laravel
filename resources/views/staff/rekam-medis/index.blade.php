@extends('layouts.app')

@section('title', 'Kelola Rekam Medis')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-file-medical-fill"></i> Kelola Rekam Medis</h2>
    <a href="{{ route('staff.rekam-medis.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Rekam Medis
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="12%">TANGGAL</th>
                        <th width="12%">NO. RM</th>
                        <th width="20%">NAMA PASIEN</th>
                        <th width="15%">DOKTER</th>
                        <th width="20%">DIAGNOSA</th>
                        <th width="16%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $index => $rm)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $rekamMedis->firstItem() + $index }}</td>
                            <td class="align-middle text-muted">{{ $rm->tanggal_periksa ? $rm->tanggal_periksa->format('d/m/Y') : '-' }}</td>
                            <td class="align-middle">
                                <span class="badge rounded-pill fw-normal" style="background-color: #FFF0F5; color: #AA60C8; border: 1px solid #EABDE6;">
                                    {{ $rm->pasien->no_rm }}
                                </span>
                            </td>
                            <td class="fw-medium text-dark align-middle">{{ $rm->pasien->nama }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle text-secondary me-2 opacity-50"></i>
                                    {{ $rm->dokter->nama }}
                                </div>
                            </td>
                            <td class="align-middle text-muted small">{{ Str::limit($rm->diagnosa, 30) }}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.rekam-medis.show', $rm) }}" class="btn btn-sm btn-light text-info shadow-sm" style="border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('staff.rekam-medis.edit', $rm) }}" class="btn btn-sm btn-light shadow-sm" style="color: #AA60C8; border-radius: 0; border: 1px solid #eee; border-left: none;" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.rekam-medis.destroy', $rm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')">
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
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-clipboard2-x fs-1 d-block mb-2"></i>
                                Tidak ada data rekam medis
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end p-3 border-top">
            {{ $rekamMedis->links() }}
        </div>
    </div>
</div>
@endsection
