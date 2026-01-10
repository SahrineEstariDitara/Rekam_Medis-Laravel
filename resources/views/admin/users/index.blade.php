@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-people"></i> Kelola User</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah User
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-bottom border-light p-0">
        <ul class="nav nav-tabs nav-justified" id="userTabs" role="tablist" style="border-bottom: none;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active py-3 fw-bold border-0 border-bottom border-3 border-primary text-primary" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">
                    <i class="bi bi-shield-lock me-2"></i>Admin
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link py-3 fw-bold border-0 text-muted" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff" type="button" role="tab" aria-controls="staff" aria-selected="false">
                    <i class="bi bi-person-badge-fill me-2"></i>Staff
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link py-3 fw-bold border-0 text-muted" id="dokter-tab" data-bs-toggle="tab" data-bs-target="#dokter" type="button" role="tab" aria-controls="dokter" aria-selected="false">
                    <i class="bi bi-heart-pulse-fill me-2"></i>Dokter
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link py-3 fw-bold border-0 text-muted" id="pasien-tab" data-bs-toggle="tab" data-bs-target="#pasien" type="button" role="tab" aria-controls="pasien" aria-selected="false">
                    <i class="bi bi-people-fill me-2"></i>Pasien
                </button>
            </li>
        </ul>
    </div>
    
    <div class="card-body p-0">
        <div class="tab-content" id="userTabsContent">
            <!-- Admin Tab -->
            <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                @include('admin.users.table', ['users' => $admins, 'type' => 'admin'])
            </div>
            
            <!-- Staff Tab -->
            <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                @include('admin.users.table', ['users' => $staffs, 'type' => 'staff'])
            </div>
            
            <!-- Dokter Tab -->
            <div class="tab-pane fade" id="dokter" role="tabpanel" aria-labelledby="dokter-tab">
                @include('admin.users.table', ['users' => $dokters, 'type' => 'dokter'])
            </div>
            
            <!-- Pasien Tab -->
            <div class="tab-pane fade" id="pasien" role="tabpanel" aria-labelledby="pasien-tab">
                @include('admin.users.table', ['users' => $pasiens, 'type' => 'pasien'])
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to handle tab styling active state
    document.addEventListener('DOMContentLoaded', function() {
        const triggerTabList = [].slice.call(document.querySelectorAll('#userTabs button'))
        triggerTabList.forEach(function(triggerEl) {
            triggerEl.addEventListener('click', function(event) {
                // Reset all tabs
                triggerTabList.forEach(t => {
                    t.classList.remove('text-primary', 'border-primary', 'border-bottom', 'border-3');
                    t.classList.add('text-muted');
                });
                // Activate clicked tab
                event.target.classList.remove('text-muted');
                event.target.classList.add('text-primary', 'border-primary', 'border-bottom', 'border-3');
            })
        })
    });
</script>
@endsection
