@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
        <span class="text-muted">{{ now()->format('d M Y, H:i') }}</span>
    </div>
    <div class="position-relative" style="min-width: 300px;">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="adminSearchInput" class="form-control border-start-0 ps-0" placeholder="Cari Pasien, Dokter, Staff..." autocomplete="off">
        </div>
        <div id="adminSearchResults" class="list-group position-absolute w-100 mt-1 shadow-sm" style="z-index: 1050; display: none;"></div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Users</p>
                        <h3 class="stats-value">{{ $totalUsers }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #FFDFEF !important; color: #AA60C8 !important;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Pasien</p>
                        <h3 class="stats-value">{{ $totalPasien }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #EABDE6 !important; color: #fff !important;">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Dokter</p>
                        <h3 class="stats-value">{{ $totalDokter }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #D69ADE !important; color: #fff !important;">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stats-label">Total Staff</p>
                        <h3 class="stats-value">{{ $totalStaff }}</h3>
                    </div>
                    <div class="stats-icon" style="background-color: #AA60C8 !important; color: #fff !important;">
                        <i class="bi bi-person-gear"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-lightning-charge me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah User Baru
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-people me-2"></i>Kelola Semua User
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-pie-chart me-2"></i>Statistik Pengguna
            </div>
            <div class="card-body">
                <canvas id="userChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-pie-chart-fill me-2"></i>Diagnosa Terbanyak
            </div>
            <div class="card-body">
                <canvas id="diseaseChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-check me-2"></i>Kunjungan Pasien Hari Ini</span>
                <span class="badge bg-primary">{{ $kunjunganHariIni->count() }} Pasien</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Keluhan Hari Ini</th>
                                <th>Diagnosa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kunjunganHariIni as $kunjungan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold">{{ $kunjungan->pasien->nama }}</div>
                                    <small class="text-muted">RM: {{ $kunjungan->pasien->no_rm }}</small>
                                </td>
                                <td>{{ $kunjungan->dokter->nama }}</td>
                                <td>{{ Str::limit($kunjungan->keluhan, 50) }}</td>
                                <td><span class="badge bg-info text-dark">{{ $kunjungan->diagnosa ?? 'Belum didiagnosa' }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#historyModal{{ $kunjungan->id }}">
                                        <i class="bi bi-clock-history"></i> Riwayat
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">Tidak ada kunjungan pasien hari ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals diletakkan di luar tabel agar tidak merusak struktur HTML (penyebab bug kedip) -->
@foreach($kunjunganHariIni as $kunjungan)
<div class="modal fade" id="historyModal{{ $kunjungan->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Medis: {{ $kunjungan->pasien->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @forelse($kunjungan->riwayat as $riwayat)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{ \Carbon\Carbon::parse($riwayat->tanggal_periksa)->format('d M Y') }}</h6>
                                <small class="text-muted">Dokter: {{ $riwayat->dokter ? $riwayat->dokter->nama : '-' }}</small>
                            </div>
                            <p class="mb-1"><strong>Diagnosa:</strong> {{ $riwayat->diagnosa }}</p>
                            <small class="text-muted">Keluhan: {{ $riwayat->keluhan }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">Belum ada riwayat medis sebelumnya.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Statistik Pengguna (Doughnut)
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pasien', 'Dokter', 'Staff'],
                datasets: [{
                    data: [{{ $totalPasien }}, {{ $totalDokter }}, {{ $totalStaff }}],
                    backgroundColor: ['#EABDE6', '#D69ADE', '#AA60C8'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart Statistik Penyakit (Pie)
        const diseaseCtx = document.getElementById('diseaseChart').getContext('2d');
        new Chart(diseaseCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($penyakitTerbanyak->pluck('diagnosa')) !!},
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: {!! json_encode($penyakitTerbanyak->pluck('total')) !!},
                    backgroundColor: [
                        '#AA60C8',
                        '#D69ADE',
                        '#EABDE6',
                        '#FFDFEF',
                        '#F8BDEB'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Fitur Pencarian Cepat
        const searchInput = document.getElementById('adminSearchInput');
        const searchResults = document.getElementById('adminSearchResults');
        let timeout = null;

        searchInput.addEventListener('input', function(e) {
            clearTimeout(timeout);
            const query = e.target.value;

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`{{ route('admin.search') }}?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(user => {
                                const item = document.createElement('a');
                                item.href = user.url;
                                item.className = 'list-group-item list-group-item-action';
                                item.innerHTML = `
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">${user.name}</h6>
                                        <small class="text-muted">${user.info}</small>
                                    </div>
                                `;
                                searchResults.appendChild(item);
                            });
                            searchResults.style.display = 'block';
                        } else {
                            searchResults.innerHTML = '<div class="list-group-item text-muted">Tidak ditemukan</div>';
                            searchResults.style.display = 'block';
                        }
                    });
            }, 300);
        });

        // Sembunyikan hasil saat klik di luar
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    });
</script>
@endsection
