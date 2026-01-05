@extends('layouts.app')

@section('title', 'Riwayat Medis')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-file-medical"></i> Riwayat Rekam Medis Saya</h2>
</div>

<div class="card shadow">
    <div class="card-body">
        @forelse($rekamMedis as $rm)
            <div class="card mb-3 border-left-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-primary">{{ $rm->tanggal_periksa->format('d F Y') }}</h5>
                            <p class="mb-1"><strong>Dokter:</strong> {{ $rm->dokter->nama }} ({{ $rm->dokter->spesialis }})</p>
                            <p class="mb-1"><strong>Diagnosa:</strong> {{ Str::limit($rm->diagnosa, 100) }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('pasien.rekam-medis.show', $rm) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Anda belum memiliki riwayat rekam medis
            </div>
        @endforelse
        
        <div class="mt-3">
            {{ $rekamMedis->links() }}
        </div>
    </div>
</div>
@endsection
