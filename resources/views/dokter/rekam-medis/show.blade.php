@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-file-medical"></i> Detail Rekam Medis</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('dokter.rekam-medis.edit', $rekamMedi) }}" class="btn btn-warning text-white">
            <i class="bi bi-pencil me-2"></i> Edit
        </a>
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahResep">
            <i class="bi bi-plus-circle me-2"></i> Tambah Resep
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-primary text-white border-bottom border-light p-3">
                <h5 class="mb-0 fw-bold text-white">
                    <i class="bi bi-person-badge me-2"></i>Data Pasien
                </h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="40%" class="text-muted">No. Rekam Medis</th>
                        <td class="fw-medium">: <span class="badge bg-white text-primary">{{ $rekamMedi->pasien->no_rm }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Nama</th>
                        <td class="fw-medium">: {{ $rekamMedi->pasien->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Jenis Kelamin</th>
                        <td>: 
                            @if($rekamMedi->pasien->jenis_kelamin == 'Laki-laki')
                                <i class="bi bi-gender-male text-primary"></i> Laki-laki
                            @else
                                <i class="bi bi-gender-female text-danger"></i> Perempuan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tanggal Lahir</th>
                        <td>: {{ $rekamMedi->pasien->tanggal_lahir ? $rekamMedi->pasien->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Alamat</th>
                        <td>: {{ $rekamMedi->pasien->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-primary text-white border-bottom border-light p-3">
                <h5 class="mb-0 fw-bold text-white">
                    <i class="bi bi-info-circle me-2"></i>Informasi Pemeriksaan
                </h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="40%" class="text-muted">Tanggal Periksa</th>
                        <td class="fw-medium">: {{ $rekamMedi->tanggal_periksa ? $rekamMedi->tanggal_periksa->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Dokter Pemeriksa</th>
                        <td class="fw-medium">: {{ $rekamMedi->dokter->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Spesialis</th>
                        <td>: <span class="badge bg-info bg-opacity-10 text-info">{{ $rekamMedi->dokter->spesialis }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-primary text-white border-bottom border-light p-3">
         <h5 class="mb-0 fw-bold text-white">
            <i class="bi bi-clipboard2-pulse me-2"></i>Detail Klinis
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded-3 h-100">
                    <h6 class="fw-bold text-muted mb-2">Keluhan</h6>
                    <p class="mb-0">{{ $rekamMedi->keluhan }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded-3 h-100">
                    <h6 class="fw-bold text-muted mb-2">Diagnosa</h6>
                    <p class="mb-0 fw-medium" style="color: var(--primary-color);">{{ $rekamMedi->diagnosa }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded-3 h-100">
                    <h6 class="fw-bold text-muted mb-2">Tindakan</h6>
                    <p class="mb-0">{{ $rekamMedi->tindakan }}</p>
                </div>
            </div>
        </div>
        @if($rekamMedi->catatan)
            <div class="mt-3 p-3 bg-warning bg-opacity-10 rounded-3 border border-warning border-opacity-25">
                <h6 class="fw-bold text-warning-emphasis mb-1"><i class="bi bi-sticky me-1"></i> Catatan Tambahan</h6>
                <p class="mb-0 text-dark opacity-75">{{ $rekamMedi->catatan }}</p>
            </div>
        @endif
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header border-bottom-0 p-3 d-flex justify-content-between align-items-center" style="background-color: #AA60C8; color: white;">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-capsule me-2"></i>Resep Obat
        </h5>
        
    </div>
    <div class="card-body p-0">
        @if($rekamMedi->resep && $rekamMedi->resep->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #FFDFEF; color: #AA60C8;">
                        <tr>
                            <th class="ps-4 py-3" width="5%" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">NO</th>
                            <th class="py-3">NAMA OBAT</th>
                            <th class="py-3">SISA STOK</th>
                            <th class="py-3">JUMLAH</th>
                            <th class="py-3">ATURAN PAKAI / DOSIS</th>
                            <th class="pe-4 py-3 text-end" width="10%" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedi->resep as $index => $r)
                            <tr>
                                <td class="ps-4">{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $r->obat->nama_obat }}</td>
                                <td><span class="badge bg-secondary rounded-pill">{{ $r->obat->stok }}</span></td>
                                <td>{{ $r->jumlah }} {{ $r->satuan ?? 'pcs' }}</td>
                                <td><span class="fst-italic text-muted">{{ $r->dosis }}</span></td>
                                <td class="pe-4 text-end">
                                    <form action="{{ route('dokter.resep.destroy', $r) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-icon" 
                                                onclick="return confirm('Yakin ingin menghapus resep ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-capsule-pill fs-1 text-muted opacity-25 mb-3 d-block"></i>
                <p class="text-muted">Belum ada resep obat yang ditambahkan.</p>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#modalTambahResep">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Obat
                </button>
            </div>
        @endif
    </div>
</div>

<div class="mt-4 mb-5">
    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary px-4 rounded-pill">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<!-- Modal Tambah Resep -->
<div class="modal fade" id="modalTambahResep" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" style="color: var(--primary-color);" id="modalLabel">
                    <i class="bi bi-capsule me-2"></i>Tambah Resep Obat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('dokter.resep.store') }}" method="POST">
                @csrf
                <div class="modal-body pt-4">
                    <input type="hidden" name="rekam_medis_id" value="{{ $rekamMedi->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Nama Obat</label>
                        <select name="obat_id" id="obatSelect" class="form-select bg-light border-0" required style="border-radius: 10px;" onchange="updateStokInfo()">
                            <option value="" data-stok="0">-- Pilih Obat --</option>
                            @foreach($obats->where('stok', '>', 0) as $obat)
                                <option value="{{ $obat->id }}" data-stok="{{ $obat->stok }}">
                                    {{ $obat->nama_obat }} — Stok: {{ $obat->stok }} pcs
                                </option>
                            @endforeach
                        </select>
                        <div id="stokInfo" class="mt-2 small text-muted d-none">
                            <i class="bi bi-box-seam me-1"></i> Stok tersedia: <span id="stokValue" class="fw-bold">0</span> pcs
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Jumlah yang Diresepkan</label>
                        <input type="number" name="jumlah" id="jumlahInput" class="form-control bg-light border-0" placeholder="Masukkan jumlah" min="1" required style="border-radius: 10px;" oninput="checkJumlah()">
                        <div id="jumlahWarning" class="mt-1 small text-danger d-none">
                            <i class="bi bi-exclamation-triangle me-1"></i> Jumlah melebihi stok!
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Aturan Pakai / Dosis</label>
                        <textarea name="dosis" class="form-control bg-light border-0" rows="3" placeholder="Contoh: 3x1 Sesudah makan" required style="border-radius: 10px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 pe-4">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Resep</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentStok = 0;

    function updateStokInfo() {
        const select = document.getElementById('obatSelect');
        const stokInfo = document.getElementById('stokInfo');
        const stokValue = document.getElementById('stokValue');
        const selectedOption = select.options[select.selectedIndex];
        
        currentStok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
        
        if (select.value) {
            stokValue.textContent = currentStok;
            stokInfo.classList.remove('d-none');
            
            // Change color based on stock level
            if (currentStok <= 10) {
                stokValue.className = 'fw-bold text-danger';
            } else if (currentStok <= 20) {
                stokValue.className = 'fw-bold text-warning';
            } else {
                stokValue.className = 'fw-bold text-success';
            }
        } else {
            stokInfo.classList.add('d-none');
        }
        
        checkJumlah();
    }

    function checkJumlah() {
        const jumlahInput = document.getElementById('jumlahInput');
        const warning = document.getElementById('jumlahWarning');
        const submitBtn = document.querySelector('#modalTambahResep button[type="submit"]');
        const jumlah = parseInt(jumlahInput.value) || 0;
        
        if (jumlah > currentStok && currentStok > 0) {
            warning.classList.remove('d-none');
            jumlahInput.classList.add('is-invalid');
            submitBtn.disabled = true;
        } else {
            warning.classList.add('d-none');
            jumlahInput.classList.remove('is-invalid');
            submitBtn.disabled = false;
        }
    }
</script>
@endpush
