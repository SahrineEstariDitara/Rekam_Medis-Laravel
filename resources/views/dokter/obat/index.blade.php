@extends('layouts.app')

@section('title', 'Stok Obat')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1 fw-bold" style="color: #AA60C8;"><i class="bi bi-capsule me-2"></i>Stok Obat Tersedia</h2>
        <span class="text-muted">Lihat ketersediaan obat sebelum meresepkan</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #D69ADE 0%, #AA60C8 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-capsule fs-3"></i>
                    </div>
                    <div>
                        <small class="text-white-50 text-uppercase">Total Jenis Obat</small>
                        <h2 class="mb-0 fw-bold">{{ $obat->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #5cb85c 0%, #449d44 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                    <div>
                        <small class="text-white-50 text-uppercase">Stok Aman (>10)</small>
                        <h2 class="mb-0 fw-bold">{{ $obat->where('stok', '>', 10)->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #f0ad4e 0%, #ec971f 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-exclamation-triangle fs-3"></i>
                    </div>
                    <div>
                        <small class="text-white-50 text-uppercase">Stok Rendah (≤10)</small>
                        <h2 class="mb-0 fw-bold">{{ $obat->where('stok', '<=', 10)->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background-color: #FFDFEF; color: #AA60C8;">
                        <th width="5%" class="text-center">NO</th>
                        <th width="30%">NAMA OBAT</th>
                        <th width="20%">JENIS</th>
                        <th width="15%" class="text-center">STOK TERSEDIA</th>
                        <th width="30%">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $index => $o)
                        <tr>
                            <td class="text-center text-muted align-middle">{{ $index + 1 }}</td>
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
                                <span class="badge {{ $badgeClass }} rounded-pill fw-normal">{{ $o->jenis ?? '-' }}</span>
                            </td>
                            <td class="text-center align-middle">
                                @if($o->stok > 20)
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i>{{ $o->stok }} pcs
                                    </span>
                                @elseif($o->stok > 10)
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $o->stok }} pcs
                                    </span>
                                @elseif($o->stok > 0)
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $o->stok }} pcs
                                    </span>
                                @else
                                    <span class="badge bg-dark rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i>Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted small align-middle">{{ Str::limit($o->keterangan, 50) ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-capsule fs-1 d-block mb-2 opacity-25"></i>
                                <p class="mb-0">Tidak ada data obat</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="alert border mt-4" style="background-color: #FFF0F5; border-color: #EABDE6 !important; border-radius: 15px;">
    <div class="d-flex align-items-start">
        <i class="bi bi-info-circle text-primary me-3 fs-5"></i>
        <div>
            <strong style="color: #AA60C8;">Catatan:</strong>
            <p class="mb-0 text-muted small">Halaman ini menampilkan stok obat saat ini. Stok akan otomatis berkurang setiap kali Anda menambahkan resep ke rekam medis pasien.</p>
        </div>
    </div>
</div>
@endsection
