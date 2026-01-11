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

                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="25%">NAMA OBAT</th>
                        <th width="20%">JENIS</th>
                        <th width="15%" class="text-center">STOK</th>
                        <th width="23%">KETERANGAN</th>
                        <th width="12%" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $index => $o)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $obat->firstItem() + $index }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-pill d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; background-color: #FFF0F5; color: #AA60C8;">
                                        <i class="bi bi-capsule"></i>
                                    </div>
                                    <span class="fw-medium text-dark">{{ $o->nama_obat }}</span>
                                </div>
                            </td>
                            <td class="align-middle">
                                @php
                                    $badgeClass = match($o->jenis) {
                                        'Obat Keras' => 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10',
                                        'Obat Bebas' => 'bg-success bg-opacity-10 text-success border border-success border-opacity-10',
                                        'Obat Bebas Terbatas' => 'bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-10',
                                        default => 'bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill fw-normal">{{ $o->jenis }}</span>
                            </td>
                            <td class="text-center align-middle">
                                @if($o->stok > 20)
                                    <span class="badge bg-success bg-opacity-25 text-success rounded-pill fw-normal">{{ $o->stok }} pcs</span>
                                @elseif($o->stok > 10)
                                    <span class="badge bg-warning bg-opacity-25 text-warning-emphasis rounded-pill fw-normal">{{ $o->stok }} pcs</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger rounded-pill fw-normal">{{ $o->stok }} pcs</span>
                                @endif
                            </td>
                            <td class="text-muted small align-middle">
                                {{ Str::limit($o->keterangan, 50) ?? '-' }}
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.obat.edit', $o) }}" class="btn btn-sm btn-light shadow-sm" style="color: #AA60C8; border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.obat.destroy', $o) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
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

