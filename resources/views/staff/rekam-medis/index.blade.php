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
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $index => $rm)
                        <tr>
                            <td class="text-muted">{{ $rekamMedis->firstItem() + $index }}</td>
                            <td>{{ $rm->tanggal_periksa->format('d/m/Y') }}</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $rm->pasien->no_rm }}</span></td>
                            <td class="fw-medium">{{ $rm->pasien->nama }}</td>
                            <td>{{ $rm->dokter->nama }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 30) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('staff.rekam-medis.show', $rm) }}" class="btn btn-outline-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('staff.rekam-medis.edit', $rm) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.rekam-medis.destroy', $rm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')">
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
