<nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i> Kelola User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/rekam-medis*') ? 'active' : '' }}" href="{{ route('admin.rekam-medis.index') }}">
                        <i class="bi bi-file-medical"></i> Rekam Medis
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('master/obat*') ? 'active' : '' }}" href="{{ route('master.obat.index') }}">
                        <i class="bi bi-capsule"></i> Data Obat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/laporan*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                        <i class="bi bi-graph-up"></i> Laporan
                    </a>
                </li>
            @elseif(auth()->user()->role === 'dokter')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dokter/dashboard') ? 'active' : '' }}" href="{{ route('dokter.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dokter/pasien*') ? 'active' : '' }}" href="{{ route('dokter.pasien.index') }}">
                        <i class="bi bi-person"></i> Daftar Pasien
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dokter/rekam-medis*') ? 'active' : '' }}" href="{{ route('dokter.rekam-medis.index') }}">
                        <i class="bi bi-file-medical"></i> Rekam Medis
                    </a>
                </li>
            @elseif(auth()->user()->role === 'pasien')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien/dashboard') ? 'active' : '' }}" href="{{ route('pasien.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien/profil*') ? 'active' : '' }}" href="{{ route('pasien.profil.index') }}">
                        <i class="bi bi-person-badge"></i> Profil Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien/rekam-medis*') ? 'active' : '' }}" href="{{ route('pasien.rekam-medis.index') }}">
                        <i class="bi bi-file-medical"></i> Riwayat Medis
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien/resep*') ? 'active' : '' }}" href="{{ route('pasien.resep.index') }}">
                        <i class="bi bi-prescription2"></i> Resep Obat
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
