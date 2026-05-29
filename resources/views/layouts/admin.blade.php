<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Theresse Food Menu') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .main-content {
            margin-left: 260px;
        }

        .sidebar-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-radius: 8px;
            margin: 4px 12px;
            transition: all 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
        }

        @media (max-width: 991px) {

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar -->
    <aside class="sidebar bg-dark text-white" id="sidebar">

        <div class="p-4 border-bottom border-secondary">
            <a href="{{ route('home') }}"
               class="text-decoration-none text-white">

                <h5 class="mb-0">🍽️ Theresse Admin</h5>

            </a>
        </div>

        <nav class="py-3">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>

            </a>

            <!-- Foods -->
            <a href="{{ route('admin.foods.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.foods.*') ? 'active' : '' }}">

                <i class="bi bi-grid"></i>
                <span>Food Menu</span>

            </a>

            <!-- Orders -->
            <a href="{{ route('admin.orders.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

                <i class="bi bi-bag"></i>
                <span>Orders</span>

            </a>

            <hr class="border-secondary mx-3">

            <!-- View Store -->
            <a href="{{ route('home') }}" class="sidebar-link">

                <i class="bi bi-house"></i>
                <span>View Store</span>

            </a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="sidebar-link logout-btn">

                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>

                </button>
            </form>

        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content flex-grow-1">

        <!-- Top Navbar -->
        <nav class="navbar navbar-light bg-white shadow-sm sticky-top">

            <div class="container-fluid">

                <button class="btn btn-link d-lg-none"
                        type="button"
                        onclick="document.getElementById('sidebar').classList.toggle('show')">

                    <i class="bi bi-list fs-4"></i>

                </button>

                <div class="ms-auto d-flex align-items-center gap-2">

                    <span class="badge bg-success">
                        Admin
                    </span>

                    <span class="fw-semibold">
                        {{ auth()->user()->name }}
                    </span>

                </div>
            </div>
        </nav>

        <!-- Success Message -->
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show m-3"
                 role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        <!-- Error Message -->
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show m-3"
                 role="alert">

                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        <!-- Page Content -->
        <div class="p-4">

            @yield('content')

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>