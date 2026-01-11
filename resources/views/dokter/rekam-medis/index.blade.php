@extends('layouts.app')

@section('title', 'Semua Rekam Medis')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-file-medical"></i> Semua Rekam Medis</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th>TANGGAL</th>
                        <th>NO. RM</th>
                        <th>NAMA PASIEN</th>
                        <th>DOKTER</th>
                        <th>DIAGNOSA</th>
                        <th width="10%" class="text-center">AKSI</th>
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
                            <td class="align-middle text-muted">{{ $rm->dokter->nama }}</td>
                            <td class="align-middle text-muted small">{{ Str::limit($rm->diagnosa, 50) }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('dokter.rekam-medis.show', $rm) }}" class="btn btn-sm btn-light text-info shadow-sm" style="border-radius: 8px; border: 1px solid #eee;" title="Detail">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-file-medical fs-1 d-block mb-2 opacity-25"></i>
                                Tidak ada data rekam medis
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $rekamMedis->links() }}
        </div>
    </div>
</div>
@endsection
