<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #faf9f7;
            font-family: 'Lato', sans-serif;
        }

        .sidebar {
            background-color: #1a1a1a;
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            overflow-y: auto;
            padding-top: 20px;
            border-right: 2px solid #D4AF37;
        }

        .sidebar .brand {
            padding: 20px;
            border-bottom: 1px solid #333;
            margin-bottom: 20px;
        }

        .sidebar .brand h4 {
            margin: 0;
            color: #D4AF37;
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        .sidebar .nav-item {
            margin: 0;
        }

        .sidebar .nav-link {
            color: #999;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #222;
            color: #D4AF37;
            border-left-color: #D4AF37;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background-color: white;
            padding: 20px;
            border-bottom: 2px solid #D4AF37;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .topbar h1 {
            margin: 0;
            font-size: 1.8rem;
            font-family: 'Playfair Display', serif;
            color: #1a1a1a;
            letter-spacing: 1px;
        }

        .card {
            border: 1px solid #E8D5C4;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            border-radius: 0;
        }

        .card-header {
            background-color: #1a1a1a;
            color: #D4AF37;
            border: none;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            letter-spacing: 1px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #1a1a1a;
            border: 2px solid #D4AF37;
            color: #D4AF37;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #D4AF37;
            color: #1a1a1a;
            border-color: #D4AF37;
        }

        .dashboard-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2b2b2b 100%);
            color: white;
            padding: 30px;
            border-radius: 0;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #D4AF37;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.1);
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 100% 100%, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .dashboard-card.secondary {
            background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%);
        }

        .dashboard-card.success {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        }

        .dashboard-card.warning {
            background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);
        }

        .dashboard-card.danger {
            background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%);
        }

        .dashboard-card h5 {
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            letter-spacing: 1px;
            color: #D4AF37;
            position: relative;
            z-index: 1;
        }

        .dashboard-card .number {
            font-size: 2.8rem;
            font-weight: bold;
            color: #D4AF37;
            position: relative;
            z-index: 1;
        }

        table {
            background-color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 0;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border: 1px solid;
        }

        .status-new {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #D4AF37;
        }

        .status-pending {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #999;
        }

        .status-confirmed {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #666;
        }

        .status-processing {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #D4AF37;
        }

        .status-delivered {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #333;
        }

        .status-cancelled {
            background-color: transparent;
            color: #1a1a1a;
            border-color: #999;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <h4><i class="bi bi-speedometer2"></i> Admin Panel</h4>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-tags"></i> Categories
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="bi bi-box"></i> Products
            </a>
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-bag"></i> Orders
            </a>
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
                <i class="bi bi-gear"></i> Settings
            </a>
            <hr style="border-color: #34495e;">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-globe"></i> View Website
            </a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: left;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div>
                <span>Welcome, <strong>{{ auth()->user()->name }}</strong></span>
            </div>
        </div>

        <!-- Flash Messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Content -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
