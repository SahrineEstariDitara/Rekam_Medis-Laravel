@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-capsule"></i> Data Obat</h2>
    <a href="{{ route('master.obat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Obat
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Obat</th>
                        <th width="15%">Stok</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $index => $o)
                        <tr>
                            <td>{{ $obat->firstItem() + $index }}</td>
                            <td>{{ $o->nama_obat }}</td>
                            <td>
                                @if($o->stok > 20)
                                    <span class="badge bg-success">{{ $o->stok }}</span>
                                @elseif($o->stok > 10)
                                    <span class="badge bg-warning">{{ $o->stok }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $o->stok }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('master.obat.edit', $o) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('master.obat.destroy', $o) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus obat ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data obat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $obat->links() }}
        </div>
    </div>
</div>
@endsection
