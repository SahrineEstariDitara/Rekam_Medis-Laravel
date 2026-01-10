<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Rekam Medis') }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #AA60C8;
            --primary-light: #D69ADE;
            --accent-color: #EABDE6;
            --bg-color: #FFDFEF;
            --text-color: #4A4A4A;
        }
        
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #FFF5F9;
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(170, 96, 200, 0.1);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: var(--text-color) !important;
            font-weight: 600;
            margin: 0 10px;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(170, 96, 200, 0.3);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            background: transparent;
            transition: all 0.3s;
        }
        
        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #FFF5F9 0%, #FFDFEF 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: var(--accent-color);
            border-radius: 50%;
            opacity: 0.5;
            z-index: 0;
            filter: blur(40px);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }
        
        .hero-image-container {
            position: relative;
            z-index: 1;
        }
        
        .floating-icon {
            animation: float 3s ease-in-out infinite;
            color: var(--primary-color);
            font-size: 8rem;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        /* Features */
        .feature-card {
            background: white;
            border-radius: 25px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(170, 96, 200, 0.1);
            transition: transform 0.3s;
            height: 100%;
            border: 2px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-color);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background-color: var(--bg-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary-color);
            font-size: 2.5rem;
        }
        
        /* Footer */
        footer {
            background-color: white;
            padding: 2rem 0;
            /* margin-top: 5rem; */
            border-top: 1px solid var(--accent-color);
        }
        
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(180deg, rgba(234, 189, 230, 0.4) 0%, rgba(255, 223, 239, 0) 100%);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            z-index: 0;
            animation: blob-bounce 10s infinite ease-in-out alternate;
        }
        
        @keyframes blob-bounce {
            0% { transform: translate(-50px, -50px) rotate(0deg); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            100% { transform: translate(20px, 20px) rotate(20deg); border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-heart-pulse-fill me-2"></i>Klinik Sehat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                        @auth
                            {{-- <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-custom ms-2">Dashboard</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-outline-custom ms-2">Masuk</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <span class="badge rounded-pill bg-white text-primary px-3 py-2 mb-3 shadow-sm" style="color: var(--primary-color)!important">
                        <i class="bi bi-stars me-1"></i> Layanan Kesehatan Digital
                    </span>
                    <h1 class="hero-title">Kesehatanmu, <br>Kini dalam Genggaman</h1>
                    <p class="hero-subtitle">Akses rekam medis kapan saja dengan aman dan nyaman. Tidak perlu ribet, semua kebutuhan informasi kesehatanmu ada di sini.</p>
                    <div class="d-flex gap-3">
                         @if (Route::has('login'))
                            @auth
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-custom btn-lg px-4">Masuk</a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 text-center hero-image-container mt-5 mt-lg-0">
                    <div class="blob" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%;"></div>
                    <div class="floating-icon">
                        <i class="bi bi-hospital" style="font-size: 15rem; text-shadow: 0 10px 30px rgba(170, 96, 200, 0.2);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Sistem -->
    <section class="py-5" style="background-color: white;">
        <div class="container py-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="mb-4" style="color: var(--primary-color); font-weight: 700;">Tentang Sistem</h2>
                    <p class="text-muted fs-5">
                        Sistem Rekam Medis Digital adalah sahabat sehatmu. Kami membantu Kamu dan tenaga medis mengelola informasi kesehatan dengan cara yang lebih praktis, aman, dan efisien. Semua riwayat pengobatanmu tersimpan rapi untuk pelayanan yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Sistem -->
    <section class="py-5" style="background-color: #FFF5F9;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 style="color: var(--primary-color); font-weight: 700;">Layanan Kami</h2>
                <p class="text-muted">Kemudahan yang bisa kamu nikmati</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-file-medical"></i>
                        </div>
                        <h4 style="color: var(--primary-color); font-weight: 700;">Riwayat Kesehatan</h4>
                        <p class="text-muted mb-0">Lihat catatan kesehatan dan hasil pemeriksaan doktermu dengan mudah dan transparan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-calendar2-check"></i>
                        </div>
                        <h4 style="color: var(--primary-color); font-weight: 700;">Daftar Kunjungan</h4>
                        <p class="text-muted mb-0">Ingat kembali kapan terakhir kali kamu berobat atau berkonsultasi di klinik kami.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <h4 style="color: var(--primary-color); font-weight: 700;">Obat & Terapi</h4>
                        <p class="text-muted mb-0">Cek daftar obat dan terapi yang pernah kamu terima agar tidak lupa dan tetap sehat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak / Bantuan -->
    <section class="py-5" style="background-color: white;">
        <div class="container py-4 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="p-5 rounded-4" style="background-color: var(--bg-color); border: 2px dashed var(--primary-color);">
                        <h2 class="mb-3" style="color: var(--primary-color); font-weight: 700;">Butuh Bantuan?</h2>
                        <p class="text-muted mb-4">Tim kami siap membantumu jika mengalami kesulitan atau memiliki pertanyaan seputar penggunaan sistem ini.</p>
                        
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="#" class="btn btn-custom px-4 py-2">
                                <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                            <a href="#" class="btn btn-outline-custom px-4 py-2">
                                <i class="bi bi-envelope me-2"></i>Kirim Email
                            </a>
                        </div>
                        <p class="mt-4 text-muted small mb-0">
                            <strong>Kontak Kami:</strong><br>
                            Email: bantuan@kliniksehat.com  |  Telp: (021) 555-0123
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; {{ date('Y') }} Sistem Rekam Medis. Made with <i class="bi bi-heart-fill text-danger"></i> & Cuteness.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
