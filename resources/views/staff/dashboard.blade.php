@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="mb-1 fw-bold" style="color: #AA60C8;"><i class="bi bi-speedometer2 me-2"></i>Dashboard Staff</h2>
        <span class="text-muted"><i class="bi bi-calendar-event me-2"></i>{{ now()->format('d F Y') }}</span>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-muted fw-bold small mb-2" style="letter-spacing: 1px;">Total Pasien</p>
                        <h3 class="fw-bold mb-0" style="color: #AA60C8;">{{ $totalPasien }}</h3>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #FFDFEF; color: #AA60C8;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-muted fw-bold small mb-2" style="letter-spacing: 1px;">Rekam Medis</p>
                        <h3 class="fw-bold mb-0" style="color: #AA60C8;">{{ $totalRekamMedis }}</h3>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EABDE6; color: #fff;">
                        <i class="bi bi-file-medical fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-muted fw-bold small mb-2" style="letter-spacing: 1px;">Total Obat</p>
                        <h3 class="fw-bold mb-0" style="color: #AA60C8;">{{ $totalObat }}</h3>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #D69ADE; color: #fff;">
                        <i class="bi bi-capsule fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-muted fw-bold small mb-2" style="letter-spacing: 1px;">Stok Rendah</p>
                        <h3 class="fw-bold mb-0 text-danger">{{ $stokObatRendah }}</h3>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #AA60C8; color: #fff;">
                        <i class="bi bi-exclamation-triangle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-4 mb-4">
    <!-- Line Chart: Tren Kunjungan -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold" style="color: #AA60C8;"><i class="bi bi-graph-up me-2"></i>Tren Kunjungan Pasien</h5>
                <small class="text-muted">7 Hari Terakhir</small>
            </div>
            <div class="card-body p-4">
                <canvas id="kunjunganChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Doughnut Chart: Diagnosa Terbanyak -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold" style="color: #AA60C8;"><i class="bi bi-pie-chart me-2"></i>Top 5 Diagnosa</h5>
                <small class="text-muted">Penyakit yang sering ditangani</small>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center position-relative">
                <canvas id="diagnosaChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="row g-4 mb-4">
    <!-- Bar Chart: Status Stok Obat -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
             <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold" style="color: #AA60C8;"><i class="bi bi-box-seam me-2"></i>Status Stok Obat</h5>
                <small class="text-muted">Ketersediaan Obat</small>
            </div>
            <div class="card-body p-4">
                 <canvas id="obatChart" style="max-height: 200px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
     <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(145deg, #fff0f5 0%, #fff 100%);">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold" style="color: #AA60C8;"><i class="bi bi-lightning-charge me-2"></i>Aksi Cepat</h5>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center gap-3">
                <a href="{{ route('staff.rekam-medis.index') }}" class="btn btn-lg text-white d-flex align-items-center justify-content-center shadow-sm" style="background-color: #AA60C8; border-radius: 12px; transition: all 0.3s;">
                    <i class="bi bi-file-medical me-3 fs-4"></i>
                    <span class="fw-semibold">Lihat Semua Rekam Medis</span>
                </a>
                <a href="{{ route('staff.obat.index') }}" class="btn btn-lg text-white d-flex align-items-center justify-content-center shadow-sm" style="background-color: #D69ADE; border-radius: 12px; transition: all 0.3s;">
                    <i class="bi bi-capsule me-3 fs-4"></i>
                    <span class="fw-semibold">Kelola Data Obat</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Line Chart: Kunjungan
        const ctxKunjungan = document.getElementById('kunjunganChart').getContext('2d');
        new Chart(ctxKunjungan, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#AA60C8',
                    backgroundColor: 'rgba(170, 96, 200, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#AA60C8',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { borderDash: [2, 4], color: '#f0f0f0' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Doughnut Chart: Diagnosa
        const ctxDiagnosa = document.getElementById('diagnosaChart').getContext('2d');
        new Chart(ctxDiagnosa, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($diagnosaLabels) !!},
                datasets: [{
                    data: {!! json_encode($diagnosaData) !!},
                    backgroundColor: [
                        '#AA60C8',
                        '#D69ADE',
                        '#EABDE6',
                        '#FFDFEF',
                        '#F8F9FA'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20 }
                    }
                },
                cutout: '70%'
            }
        });

         // Bar Chart: Stok Obat
         const ctxObat = document.getElementById('obatChart').getContext('2d');
         new Chart(ctxObat, {
            type: 'bar',
            data: {
                labels: ['Stok Aman', 'Stok Rendah (<10)'],
                datasets: [{
                    label: 'Jumlah Obat',
                    data: [{{ $obatStats['Aman'] }}, {{ $obatStats['Rendah'] }}],
                    backgroundColor: ['#D69ADE', '#FF6B6B'],
                    borderRadius: 10,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // Horizontal bar
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
         });
    });
</script>
@endsection
