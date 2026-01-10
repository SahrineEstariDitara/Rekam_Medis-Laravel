<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-hospital-fill me-2"></i>Sistem Rekam Medis
        </a>
        
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #FFDFEF; color: #AA60C8;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark small" style="line-height: 1;">{{ auth()->user()->name }}</span>
                    <span class="badge" style="background-color: #FFDFEF; color: #AA60C8; font-size: 0.7rem;">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius: 8px;">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

