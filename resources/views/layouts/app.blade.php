<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Sistem Rekam Medis</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #AA60C8;
            --primary-light: #D69ADE;
            --accent-color: #EABDE6;
            --bg-color: #FFDFEF;
            --text-color: #4A4A4A;
            --sidebar-width: 260px;
        }
        
        * {
            font-family: 'Quicksand', sans-serif;
        }
        
        body {
            font-size: 0.95rem;
            background-color: #FFF5F9; /* Versi lebih lembut dari #FFDFEF untuk background utama agar mata nyaman */
            color: var(--text-color);
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(170, 96, 200, 0.1);
            border-bottom: 2px solid var(--accent-color);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.25rem;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 80px 15px 20px;
            background: #fff;
            width: var(--sidebar-width);
            border-right: 2px solid var(--accent-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 15px rgba(170, 96, 200, 0.05);
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        
        .sidebar .nav-link {
            font-weight: 600;
            color: #7a7a7a;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 15px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--bg-color);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 10px rgba(170, 96, 200, 0.3);
        }
        
        .sidebar .nav-link i {
            font-size: 1.25rem;
        }
        
        /* Main Content */
        main {
            margin-left: var(--sidebar-width);
            padding: 80px 30px 30px;
            min-height: 100vh;
        }
        
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(170, 96, 200, 0.08);
            background: #fff;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(170, 96, 200, 0.15);
        }
        
        .card-header {
            background: var(--bg-color);
            border-bottom: 2px solid #fff;
            font-weight: 700;
            padding: 1.25rem 1.5rem;
            color: var(--primary-color);
        }
        
        /* Stats Card */
        .stats-card {
            border: 2px solid var(--bg-color);
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
        }
        
        .stats-card .stats-icon {
            width: 55px;
            height: 55px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: var(--bg-color) !important;
            color: var(--primary-color) !important;
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover .stats-icon {
            transform: rotate(10deg) scale(1.1);
        }
        
        .stats-card .stats-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #888;
            margin-bottom: 0.25rem;
        }
        
        .stats-card .stats-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
        }
        
        /* Buttons */
        .btn {
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 96, 200, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: #fff;
        }

        /* Bootstrap Utility Overrides */
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .border-primary {
            border-color: var(--primary-color) !important;
        }
        
        /* Tables */
        .table thead th {
            background-color: var(--bg-color);
            border-bottom: none;
            color: var(--primary-color);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 1rem;
            first-child: border-top-left-radius: 15px;
            last-child: border-top-right-radius: 15px;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding: 1rem;
            border-color: #f0f0f0;
        }
        
        /* Badges */
        .badge {
            padding: 0.5em 1em;
            border-radius: 10px;
            font-weight: 600;
        }
        
        /* Page Header */
        .page-header h2 {
            color: var(--primary-color);
            font-weight: 800;
        }
        
        .page-header h2 i {
            background: var(--bg-color);
            padding: 8px;
            border-radius: 12px;
            margin-right: 10px;
            font-size: 0.8em;
        }
        
        /* Form Controls */
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #eee;
            padding: 0.8rem 1rem;
            background-color: #fcfcfc;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(214, 154, 222, 0.2);
            background-color: #fff;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        /* Pagination */
        .pagination {
            border-radius: 12px;
            gap: 5px;
        }

        .page-link {
            border-radius: 8px;
            color: var(--primary-color);
            background-color: transparent;
            border: 1px solid var(--accent-color);
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .page-link:hover {
            background-color: var(--bg-color);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(170, 96, 200, 0.3);
        }

        .page-item.disabled .page-link {
            background-color: #f9f9f9;
            border-color: #eee;
            color: #ccc;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            main {
                margin-left: 0;
                padding: 80px 15px 15px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('components.navbar')
    
    <div class="container-fluid p-0">
        <div class="d-flex">
            @include('components.sidebar')
            
            <main class="flex-grow-1">
                <div class="main-content">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show bg-white border-start border-success border-4" role="alert">
                            <i class="bi bi-check-circle-fill text-success me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show bg-white border-start border-danger border-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show bg-white border-start border-danger border-4" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>


