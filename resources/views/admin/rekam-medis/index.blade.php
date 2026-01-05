@extends('layouts.app')

@section('title', 'Semua Rekam Medis')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-file-medical"></i> Semua Rekam Medis</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $index => $rm)
                        <tr>
                            <td>{{ $rekamMedis->firstItem() + $index }}</td>
                            <td>{{ $rm->tanggal_periksa->format('d/m/Y') }}</td>
                            <td>{{ $rm->pasien->no_rm }}</td>
                            <td>{{ $rm->pasien->nama }}</td>
                            <td>{{ $rm->dokter->nama }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.rekam-medis.show', $rm) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data rekam medis</td>
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
