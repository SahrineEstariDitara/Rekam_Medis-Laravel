@extends('layouts.app')

@section('title', 'Riwayat Resep Obat')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-capsule-pill"></i> Riwayat Resep Obat</h2>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr style="background-color: #FFDFEF; color: #AA60C8;">
                                <th class="ps-4 py-3">TANGGAL</th>
                                <th class="py-3">NAMA OBAT</th>
                                <th class="py-3">JENIS</th>
                                <th class="py-3">JUMLAH</th>
                                <th class="py-3">DOSIS</th>
                                <th class="py-3">DOKTER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resep as $r)
                                <tr>
                                    <td class="ps-4 py-3 fw-medium">{{ $r->rekamMedis->tanggal_periksa->format('d/m/Y') }}</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle me-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 35px; height: 35px; background-color: #FFF0F5; color: #AA60C8;">
                                                <i class="bi bi-capsule"></i>
                                            </div>
                                            {{ $r->obat->nama_obat }}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        @php
                                            $badgeClass = match($r->obat->jenis) {
                                                'Obat Keras' => 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 rounded-pill',
                                                'Obat Bebas' => 'bg-success bg-opacity-10 text-success border border-success border-opacity-10 rounded-pill',
                                                'Obat Bebas Terbatas' => 'bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-10 rounded-pill',
                                                default => 'bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 rounded-pill'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $r->obat->jenis }}</span>
                                    </td>
                                    <td class="py-3">{{ $r->jumlah }} {{ $r->satuan ?? 'pcs' }}</td>
                                    <td class="py-3 fst-italic text-muted">{{ $r->dosis }}</td>
                                    <td class="py-3">{{ $r->rekamMedis->dokter->nama }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                        Belum ada riwayat resep obat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end p-3 border-top">
                    {{ $resep->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
