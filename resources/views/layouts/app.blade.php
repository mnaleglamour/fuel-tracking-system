<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sales Tracking System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Global CDNs: Charts, Tables, Toasts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        :root {
            --primary-navy: #0f172a;
            --secondary-navy: #1e293b;
            --accent-blue: #2563eb;
            --success-green: #10b981;
            --warning-amber: #f59e0b;
            --danger-red: #dc2626;
            --bg-light: #f1f5f9;
            --card-bg: #ffffff;
            --text-muted: #64748b;
            --border-color: #e5e7eb;
            --font-family: 'Inter', 'Segoe UI', 'Roboto', sans-serif;
        }

        [data-theme="dark"] {
            --bg-light: #0f0f23;
            --card-bg: #1a1b2e;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --primary-navy: #f1f5f9;
            --secondary-navy: #e2e8f0;
        }

        .dark-mode-toggle {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s;
            color: var(--text-muted);
        }

        .dark-mode-toggle:hover {
            background: rgba(255,255,255,0.1);
            color: var(--accent-blue);
        }

        body {
            transition: background-color 0.3s ease;
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background: var(--bg-light);
            min-height: 100vh;
            color: var(--secondary-navy);
        }

        .btn-primary {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .btn-success {
            background-color: var(--success-green);
            border-color: var(--success-green);
        }

        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }

        .btn-warning {
            background-color: var(--warning-amber);
            border-color: var(--warning-amber);
        }

        .btn-danger {
            background-color: var(--danger-red);
            border-color: var(--danger-red);
        }

        .text-primary {
            color: var(--accent-blue) !important;
        }

        .bg-primary {
            background-color: var(--primary-navy) !important;
        }

        .table-dark {
            --bs-table-bg: var(--primary-navy);
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 12px;
        }

        .card-header {
            border-bottom: 1px solid var(--border-color);
            background: var(--card-bg);
            font-weight: 600;
        }

        main {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0;
                padding: 15px;
            }
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-navy);
            margin-bottom: 5px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .stat-card {
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: background-color 0.15s;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-weight: 600;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
@include('layouts.sidebar')

    <!-- Top Navbar with Dark Mode Toggle & Notifications -->
    <nav id="topNavbar" class="navbar navbar-expand position-sticky" style="top: 0; z-index: 50; background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid var(--border-color); box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
      <div class="container-fluid px-3">
        <!-- Dark Mode Toggle (Left) -->
        <button class="btn btn-sm btn-link p-2 me-3 mb-1 dark-mode-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">
          <i class="bi bi-moon-stars-fill" id="darkModeIcon" style="font-size: 1.2rem;"></i>
        </button>
        
        <!-- Notifications & Date (Right) -->
        <div class="ms-auto d-flex align-items-center gap-3">
          <!-- Notifications Bell -->
          <div class="position-relative">
            <button class="btn btn-sm btn-link p-2 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
              <i class="bi bi-bell fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge" style="display: none;">
                3
              </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="min-width: 320px; max-height: 400px; overflow-y: auto;">
              <li class="dropdown-header py-2">
                <span class="fw-semibold">Notifications</span>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li><span class="dropdown-item-text text-center text-muted py-3">No new notifications</span></li>
            </ul>
          </div>
          
          <!-- Date -->
          <span class="text-muted small fw-medium" id="currentDate">{{ now()->format('D, M j Y') }}</span>
          
          <!-- User Profile Dropdown -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2 p-2 rounded-3" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar" style="width: 36px; height: 36px; border-radius: 50%; background: var(--accent-blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
              </div>
              <div class="d-none d-md-block text-start small">
                <div class="fw-semibold">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="text-muted">{{ Auth::user()->isAdmin() ? 'Admin' : 'Attendant' }}</div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <main style="margin-left: 250px; padding-top: 90px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px;">
        @yield('content')
    </main>

    <!-- Dark Mode Script -->
    <script>
        // Dark Mode Toggle Function
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.getAttribute('data-theme') === 'dark';
            
            if (isDark) {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                document.getElementById('darkModeIcon').className = 'bi bi-moon-stars-fill';
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('darkModeIcon').className = 'bi bi-sun-fill';
            }
        }

        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.getElementById('darkModeIcon').className = 'bi bi-sun-fill';
            }
        });

        // Update date every minute
        function updateDate() {
            const now = new Date();
            const options = { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
        }
        setInterval(updateDate, 60000);
        updateDate();
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
