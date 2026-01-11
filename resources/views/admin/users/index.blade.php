@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1"><i class="bi bi-people me-2"></i>Kelola User</h2>
        <span class="text-muted">Manajemen data pengguna sistem</span>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-header border-bottom-0" style="background-color: #FFDFEF; border-radius: 15px 15px 0 0; padding-bottom: 0;">
        <ul class="nav nav-tabs card-header-tabs" id="userTabs" role="tablist" style="border-bottom: none;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-4 py-2" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab"
                        style="color: #AA60C8; border-radius: 10px 10px 0 0; border: none;">Admin</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff" type="button" role="tab"
                        style="color: #AA60C8; border-radius: 10px 10px 0 0; border: none;">Staff</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2" id="dokter-tab" data-bs-toggle="tab" data-bs-target="#dokter" type="button" role="tab"
                        style="color: #AA60C8; border-radius: 10px 10px 0 0; border: none;">Dokter</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2" id="pasien-tab" data-bs-toggle="tab" data-bs-target="#pasien" type="button" role="tab"
                        style="color: #AA60C8; border-radius: 10px 10px 0 0; border: none;">Pasien</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="userTabsContent">
            
            <!-- Tab Admin -->
            <div class="tab-pane fade show active" id="admin" role="tabpanel">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Daftar Admin</h5>
                    <a href="{{ route('admin.users.create', ['role' => 'admin']) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Admin
                    </a>
                </div>
                @include('admin.users.table', ['users' => $admins, 'type' => 'admin'])
            </div>

            <!-- Tab Staff -->
            <div class="tab-pane fade" id="staff" role="tabpanel">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Daftar Staff</h5>
                    <a href="{{ route('admin.users.create', ['role' => 'staff']) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Staff
                    </a>
                </div>
                @include('admin.users.table', ['users' => $staffs, 'type' => 'staff'])
            </div>

            <!-- Tab Dokter -->
            <div class="tab-pane fade" id="dokter" role="tabpanel">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Daftar Dokter</h5>
                    <a href="{{ route('admin.users.create', ['role' => 'dokter']) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Dokter
                    </a>
                </div>
                @include('admin.users.table', ['users' => $dokters, 'type' => 'dokter'])
            </div>

            <!-- Tab Pasien -->
            <div class="tab-pane fade" id="pasien" role="tabpanel">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Daftar Pasien</h5>
                    <a href="{{ route('admin.users.create', ['role' => 'pasien']) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Pasien
                    </a>
                </div>
                @include('admin.users.table', ['users' => $pasiens, 'type' => 'pasien'])
            </div>

        </div>
    </div>
</div>
@endsection

{{-- Sub-view untuk tabel agar tidak duplikasi kode --}}
@php
    // Definisikan sub-view inline atau buat file terpisah _table.blade.php
    // Di sini saya gunakan teknik include inline logic untuk kesederhanaan dalam satu file response
@endphp

@section('scripts')
<script>
    // Simpan tab aktif di localStorage agar saat refresh tetap di tab yang sama
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('#userTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                localStorage.setItem('activeUserTab', event.target.id);
            })
        })

        var activeTab = localStorage.getItem('activeUserTab');
        if(activeTab){
            var triggerEl = document.querySelector('#' + activeTab)
            if(triggerEl) {
                var tab = new bootstrap.Tab(triggerEl)
                tab.show()
            }
        }
    });
</script>

<style>
    /* Styling khusus untuk tab navigasi */
    #userTabs .nav-link {
        background-color: transparent; /* Tab tidak aktif transparan */
        color: #AA60C8; /* Warna teks ungu */
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    #userTabs .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.5); /* Hover effect */
        opacity: 1;
    }

    #userTabs .nav-link.active {
        background-color: #ffffff !important; /* Tab aktif putih */
        color: #AA60C8 !important;
        opacity: 1;
        box-shadow: 0 -2px 5px rgba(0,0,0,0.05); /* Bayangan halus */
    }
    
    /* Hapus border default card agar menyatu dengan header */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .card-header {
        border-bottom: 1px solid #FFF0F5;
    }
</style>
@endsection