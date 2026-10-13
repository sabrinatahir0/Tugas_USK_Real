<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JWD Sertifikasi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" style="background-color: #2cb7cf;">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark fs-4" href="{{ route('dashboard') }}">JWD App Sabrina</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('skema.index') }}">Data Skema</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('peserta.index') }}">Data Peserta</a>
                    </li>
                </ul>

                <!-- User Session / Logout -->
                <div class="navbar-nav ms-auto align-items-center gap-2">
                    @auth
                        <span class="text-dark fw-semibold me-2">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm shadow-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="container pb-5">

        {{-- Alert Notifikasi Berhasil (Login, Logout, CRUD) --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Notifikasi Gagal (Salah Pass/Email, Gagal CRUD) --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Jika Ada Error Validasi Form (Tanpa Titik / Bullet) --}}
        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show shadow-sm mb-4" role="alert">
                
                <div class="mt-2">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Dynamic Content --}}
        @yield('content')

    </main>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>