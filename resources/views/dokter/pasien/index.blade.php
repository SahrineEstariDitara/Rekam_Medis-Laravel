@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-person"></i> Daftar Pasien</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="15%">NO. RM</th>
                        <th width="20%">NAMA</th>
                        <th width="15%">JENIS KELAMIN</th>
                        <th width="15%">TANGGAL LAHIR</th>
                        <th width="20%">ALAMAT</th>
                        <th width="10%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasien as $index => $p)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $pasien->firstItem() + $index }}</td>
                            <td class="align-middle">
                                <span class="badge rounded-pill fw-normal" style="background-color: #FFF0F5; color: #AA60C8; border: 1px solid #EABDE6;">
                                    {{ $p->no_rm }}
                                </span>
                            </td>
                            <td class="fw-medium text-dark align-middle">{{ $p->nama }}</td>
                            <td class="align-middle">
                                @if($p->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill fw-normal">Laki-laki</span>
                                @else
                                    <span class="badge rounded-pill fw-normal" style="background-color: #FFF0F5; color: #AA60C8; border: 1px solid #EABDE6;">Perempuan</span>
                                @endif
                            </td>
                            <td class="align-middle text-muted">{{ $p->tanggal_lahir->format('d/m/Y') }}</td>
                            <td class="align-middle text-muted small">{{ Str::limit($p->alamat, 40) }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('dokter.pasien.show', $p) }}" class="btn btn-sm btn-light text-info shadow-sm" style="border-radius: 8px; border: 1px solid #eee;" title="Detail">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-25"></i>
                                Tidak ada data pasien
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $pasien->links() }}
        </div>
    </div>
</div>
@endsection
