@extends('layouts.app') 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Detail Pasien</h2>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Identitas Pasien
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">No. Rekam Medis</th>
                            <td>: {{ $pasien->no_rm ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: {{ $pasien->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $pasien->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>: {{ $pasien->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $pasien->alamat }}</td>
                        </tr>
                    </table>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info text-white">
                    Riwayat Rekam Medis
                </div>
                <div class="card-body">
                    @if($pasien->rekamMedis->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Periksa</th>
                                    <th>Keluhan</th>
                                    <th>Diagnosa</th>
                                    <th>Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasien->rekamMedis as $rm)
                                <tr>
                                    <td>{{ $rm->tanggal_periksa }}</td>
                                    <td>{{ $rm->keluhan }}</td>
                                    <td>{{ $rm->diagnosa }}</td>
                                    <td>{{ $rm->dokter->nama ?? 'Dokter tidak ditemukan' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">Belum ada riwayat rekam medis.</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection