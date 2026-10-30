<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YUSU POWER MOUNTAIN SOLUTION LIMITED')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            color: #333;
        }

        /* WeCom Green Color */
        :root {
            --wecom-green: #07C160;
            --wecom-green-light: #07C1601a;
            --wecom-green-hover: #06ad57;
            --wecom-gray: #999999;
            --wecom-gray-light: #f7f7f7;
            --wecom-border: #e5e5e5;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid var(--wecom-border);
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .sidebar .nav-link:hover {
            background: var(--wecom-gray-light);
            color: var(--wecom-green);
        }
        
        .sidebar .nav-link.active {
            color: var(--wecom-green);
            background: var(--wecom-green-light);
            font-weight: 600;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar .nav-link .dropdown-toggle {
            color: #333;
        }

        .sidebar .nav-link .dropdown-toggle:hover,
        .sidebar .nav-link .dropdown-toggle.active {
            color: var(--wecom-green);
        }

        .sidebar .collapse .nav-link {
            margin: 3px 0;
            padding: 10px 15px 10px 40px;
            font-size: 0.9rem;
        }

        .main-content {
            padding: 2rem;
            background: #f5f5f5;
        }

        /* Cards */
        .card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--wecom-border);
            color: #333;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }

        .card-body {
            color: #333;
            padding: 1.5rem;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 8px;
            padding: 1.5rem;
            color: #333;
            border: 1px solid var(--wecom-border);
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: var(--wecom-green);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--wecom-green);
        }

        .stat-card p {
            margin: 0;
            color: var(--wecom-gray);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .stat-card i {
            font-size: 1.5rem;
            color: var(--wecom-green);
            margin-bottom: 0.5rem;
        }

        /* Table */
        .table {
            color: #333;
            margin-bottom: 0;
        }

        .table thead {
            background: var(--wecom-gray-light);
        }

        .table thead th {
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid var(--wecom-border);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--wecom-border);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: var(--wecom-gray-light);
        }

        .table tbody td {
            vertical-align: middle;
        }

        /* Buttons */
        .btn-primary {
            background: var(--wecom-green);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 4px;
            padding: 0.6rem 1.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--wecom-green-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(7, 193, 96, 0.3);
        }

        .btn-outline-primary {
            border: 1px solid var(--wecom-green);
            color: var(--wecom-green);
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--wecom-green-light);
            border-color: var(--wecom-green);
            color: var(--wecom-green);
        }

        .btn-success {
            background: var(--wecom-green);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 4px;
        }

        .btn-success:hover {
            background: var(--wecom-green-hover);
        }

        .btn-danger {
            background: #ff4d4f;
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 4px;
        }

        .btn-danger:hover {
            background: #ff7875;
        }

        .btn-warning {
            background: #faad14;
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 4px;
        }

        .btn-warning:hover {
            background: #ffc53d;
        }

        .btn-sm {
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
        }

        /* Alert */
        .alert {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            color: #333;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            border-color: var(--wecom-green);
            background: var(--wecom-green-light);
            color: var(--wecom-green);
        }

        .alert-danger {
            border-color: #ff4d4f;
            background: #fff1f0;
            color: #ff4d4f;
        }

        .alert-info {
            border-color: #1890ff;
            background: #e6f7ff;
            color: #1890ff;
        }

        /* Form */
        .form-label {
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-control {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 4px;
            color: #333;
            transition: all 0.2s ease;
            padding: 0.6rem 1rem;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: var(--wecom-green);
            box-shadow: 0 0 0 3px var(--wecom-green-light);
            color: #333;
        }

        .form-control::placeholder {
            color: var(--wecom-gray);
        }

        .form-select {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 4px;
            color: #333;
        }

        .form-select:focus {
            border-color: var(--wecom-green);
            box-shadow: 0 0 0 3px var(--wecom-green-light);
        }

        /* Page Title */
        h1 {
            font-weight: 600;
            color: #333;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        h2, h3, h4, h5, h6 {
            color: #333;
            font-weight: 600;
        }

        a {
            color: var(--wecom-green);
            text-decoration: none;
            transition: 0.2s;
        }

        a:hover {
            color: var(--wecom-green-hover);
        }

        /* Badge */
        .badge {
            border-radius: 4px;
            padding: 0.35rem 0.75rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-success {
            background: var(--wecom-green-light);
            color: var(--wecom-green);
        }

        .badge-danger {
            background: #fff1f0;
            color: #ff4d4f;
        }

        .badge-warning {
            background: #fffbe6;
            color: #faad14;
        }

        .badge-info {
            background: #e6f7ff;
            color: #1890ff;
        }

        /* Pagination */
        .pagination .page-link {
            color: #333;
            border: 1px solid var(--wecom-border);
            margin: 0 2px;
            border-radius: 4px;
        }

        .pagination .page-link:hover {
            background: var(--wecom-gray-light);
            color: var(--wecom-green);
        }

        .pagination .page-item.active .page-link {
            background: var(--wecom-green);
            border-color: var(--wecom-green);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .stat-card h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @if(auth()->check())
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 p-3">
                        <h4 class="mb-1" style="font-weight: 600; color: #333;">
                            <i class="bi bi-chat-dots-fill me-2" style="color: var(--wecom-green);"></i>YUSU POWER
                        </h4>
                        <p class="small" style="color: var(--wecom-gray);">Welcome, {{ auth()->user()->name }}</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}" href="{{ route('attendance.index') }}">
                                <i class="bi bi-calendar-check"></i> Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('job-output.*') ? 'active' : '' }}" href="{{ route('job-output.index') }}">
                                <i class="bi bi-clipboard-data"></i> Job Output
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                                <i class="bi bi-people"></i> Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="{{ request()->routeIs('reports.*') ? 'true' : 'false' }}">
                                <i class="bi bi-file-earmark-bar-graph"></i> Reports
                            </a>
                            <div class="collapse {{ request()->routeIs('reports.*') ? 'show' : '' }}" id="reportsMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.attendance.*') ? 'active' : '' }}" href="{{ route('reports.attendance.index') }}">
                                            <i class="bi bi-calendar-check"></i> Attendance
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.job-output.*') ? 'active' : '' }}" href="{{ route('reports.job-output.index') }}">
                                            <i class="bi bi-clipboard-data"></i> Job Output
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('reports.employee-performance') ? 'active' : '' }}" href="{{ route('reports.employee-performance') }}">
                                            <i class="bi bi-trophy"></i> Performance
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('qr.*') ? 'active' : '' }}" href="{{ route('qr.scan') }}">
                                <i class="bi bi-qr-code-scan"></i> QR Scanner
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('qr.door') ? 'active' : '' }}" href="{{ route('qr.door') }}">
                                <i class="bi bi-qr-code"></i> Door QR Code
                            </a>
                        </li>
                        @endif
                        
                        <!-- WeCom Features -->
                        <li class="nav-item mt-3">
                            <small class="text-muted ms-3" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">WeCom</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}" href="{{ route('messages.index') }}">
                                <i class="bi bi-chat-dots"></i> Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('groups.*') ? 'active' : '' }}" href="{{ route('groups.index') }}">
                                <i class="bi bi-people"></i> Work Groups
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('approvals.*') ? 'active' : '' }}" href="{{ route('approvals.index') }}">
                                <i class="bi bi-file-earmark-check"></i> Approvals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">
                                <i class="bi bi-list-check"></i> Tasks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
                                <i class="bi bi-bell"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('directory.index') ? 'active' : '' }}" href="{{ route('directory.index') }}">
                                <i class="bi bi-person-badge"></i> Directory
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link w-100 text-start" style="background: none; border: none; cursor: pointer; color: #ff4d4f;">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <main class="col-md-10 ms-sm-auto main-content">
                @yield('content')
            </main>
        </div>
    </div>
    @else
    <div class="container">
        @yield('content')
    </div>
    @endif
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
