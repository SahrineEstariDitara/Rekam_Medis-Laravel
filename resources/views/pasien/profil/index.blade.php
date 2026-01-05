@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-person-badge"></i> Profil Saya</h2>
</div>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Data Pribadi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">No. Rekam Medis</th>
                        <td>: {{ $pasien->no_rm }}</td>
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
                        <td>: {{ $pasien->tanggal_lahir->format('d F Y') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Email</th>
                        <td>: {{ $pasien->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $pasien->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
