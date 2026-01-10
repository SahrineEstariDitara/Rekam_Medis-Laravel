<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Rekam Medis</title>
    
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
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Quicksand', sans-serif;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(214, 154, 222, 0.4) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(170, 96, 200, 0.3) 0%, transparent 25%);
        }
        
        .login-card {
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(170, 96, 200, 0.15);
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }
        
        .login-header {
            background: var(--bg-color);
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 2px dashed #fff;
        }
        
        .form-control {
            border-radius: 15px;
            padding: 12px 20px;
            border: 2px solid #eee;
            background-color: #fcfcfc;
        }
        
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(214, 154, 222, 0.2);
            background-color: #fff;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 15px;
            padding: 12px;
            font-weight: 700;
            margin-top: 1rem;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(170, 96, 200, 0.4);
        }
        
        .demo-account {
            background: #fff;
            border-radius: 15px;
            padding: 15px;
            margin-top: 20px;
            border: 2px dashed var(--accent-color);
            font-size: 0.85rem;
            color: #666;
        }
        
        .icon-circle {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card">
                    <div class="login-header">
                        <div class="text-start mb-3">
                            <a href="{{ url('/') }}" class="text-decoration-none text-muted small fw-bold">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="icon-circle">
                            <i class="bi bi-hospital-fill" style="font-size: 2.5rem;"></i>
                        </div>
                        <h4 class="fw-bold" style="color: var(--primary-color)">Selamat Datang!</h4>
                        <p class="text-muted mb-0 small">Sistem Rekam Medis</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 pt-4">
                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4" style="background-color: #ffe6e6; color: #dc3545;">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold small text-muted ps-2">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="hello@example.com"
                                       required 
                                       autofocus>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold small text-muted ps-2">Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       placeholder="••••••••"
                                       required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                Login <i class="bi bi-arrow-right-short"></i>
                            </button>
                        </form>
                        
                        <div class="demo-account text-center">
                            <h6 class="fw-bold mb-2" style="color: var(--primary-color)">Demo Accounts</h6>
                            <div class="d-grid gap-1">
                                <div><span class="badge bg-danger bg-opacity-10 text-danger mb-1">Admin</span> admin@example.com</div>
                                <div><span class="badge bg-warning bg-opacity-10 text-warning text-dark mb-1">Staff</span> staff@example.com</div>
                                <div><span class="badge bg-info bg-opacity-10 text-info mb-1">Dokter</span> dokter1@example.com</div>
                                <div><span class="badge bg-success bg-opacity-10 text-success">Pasien</span> pasien1@example.com</div>
                            </div>
                            <div class="mt-2 small text-muted">Password: <strong>password</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

