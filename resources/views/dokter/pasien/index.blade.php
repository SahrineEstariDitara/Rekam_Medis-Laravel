@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-person"></i> Daftar Pasien</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>No. RM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasien as $index => $p)
                        <tr>
                            <td>{{ $pasien->firstItem() + $index }}</td>
                            <td>{{ $p->no_rm }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_kelamin }}</td>
                            <td>{{ $p->tanggal_lahir->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($p->alamat, 50) }}</td>
                            <td>
                                <a href="{{ route('dokter.pasien.show', $p) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pasien</td>
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
