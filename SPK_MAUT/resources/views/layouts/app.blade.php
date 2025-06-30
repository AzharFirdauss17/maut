<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css " rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            background-color: #212529;
            color: white;
            height: 100vh;
            position: fixed;
            transition: transform 0.3s ease;
            z-index: 1030;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: white;
            text-decoration: none;
        }

        .sidebar .nav-link {
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #343a40;
        }

        .content {
            margin-left: 240px;
            padding-top: 70px;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -240px;
                height: 100%;
                z-index: 1040;
            }

            .content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar p-3 d-flex flex-column justify-content-between" id="sidebar">
    <div>
        <h5 class="text-white text-center mb-4">NAVIGATION</h5>
        <ul class="nav flex-column">

            @php
                $isAdmin = false;

                // Cek apakah user adalah admin
                if (Auth::user()->user_level && strtolower(Auth::user()->user_level) === 'admin') {
                    $isAdmin = true;
                } elseif (Auth::user()->id_user_level == 1) {
                    $isAdmin = true;
                } elseif (Auth::user()->userLevel && strtolower(Auth::user()->userLevel->nama_level) === 'admin') {
                    $isAdmin = true;
                }
            @endphp

            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>

            <!-- Admin Menu -->
            @if($isAdmin)
                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-shield-alt me-2"></i>Admin Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('kriteria.index') }}">
                        <i class="fas fa-list-ul me-2"></i>Kriteria
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('subkriteria.index') }}">
                        <i class="fas fa-indent me-2"></i>Subkriteria
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('maut.hitung') }}">
                        <i class="fas fa-calculator me-2"></i>Hitung Bobot MAUT
                    </a>
                </li>

                <!-- <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('penilaian.index') }}">
                        <i class="fas fa-chart-bar me-2"></i>Penilaian
                    </a>
                </li> -->

                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('admin.pinjaman.index') }}">
                        <i class="fas fa-money-check-alt me-2"></i>Pengajuan Pinjaman
                    </a>
                </li>
            @else
                <!-- User Menu -->
                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-user-cog me-2"></i>User Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link btn btn-dark w-100 text-start" href="{{ route('loan.create') }}">
                        <i class="fas fa-file-invoice-dollar me-2"></i>Ajukan Pinjaman
                    </a>
                </li>
            @endif

        </ul>
    </div>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" class="mt-auto">
        @csrf
        <button type="submit" class="btn btn-danger w-100">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </button>
    </form>
</div>

<!-- Mobile Toggle Button -->
<button class="btn btn-dark d-md-none position-fixed start-0 bottom-0 m-3 z-3" style="z-index: 1050;" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- Content -->
<div class="content px-4" id="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand">@yield('page-title', 'Dashboard')</span>
            <div class="d-flex ms-auto align-items-center">
                <span class="me-3">Halo, {{ Auth::user()->name ?? 'User' }}</span>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
    }
</script>

</body>
</html>