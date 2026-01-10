@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-capsule"></i> Data Obat</h2>
    <a href="{{ route('staff.obat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Obat
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Obat</th>
                        <th width="20%">Jenis</th>
                        <th width="15%">Stok</th>
                        <th>Keterangan</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $index => $o)
                        <tr>
                            <td class="text-muted">{{ $obat->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #EABDE6; color: #AA60C8;">
                                        <i class="bi bi-capsule"></i>
                                    </div>
                                    <span class="fw-medium">{{ $o->nama_obat }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($o->jenis) {
                                        'Obat Keras' => 'bg-danger bg-opacity-10 text-danger',
                                        'Obat Bebas' => 'bg-success bg-opacity-10 text-success',
                                        'Obat Bebas Terbatas' => 'bg-warning bg-opacity-10 text-dark',
                                        default => 'bg-secondary bg-opacity-10 text-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $o->jenis }}</span>
                            </td>
                            <td>
                                @if($o->stok > 20)
                                    <span class="badge bg-success bg-opacity-25 text-success">{{ $o->stok }} pcs</span>
                                @elseif($o->stok > 10)
                                    <span class="badge bg-warning bg-opacity-25 text-warning-emphasis">{{ $o->stok }} pcs</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger">{{ $o->stok }} pcs</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ Str::limit($o->keterangan, 50) ?? '-' }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('staff.obat.edit', $o) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.obat.destroy', $o) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
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
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Tidak ada data obat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        
        @if($obat->hasPages())
        <div class="d-flex justify-content-end p-3 border-top">
            {{ $obat->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

