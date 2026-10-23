<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YUSU POWER MOUNTAIN SOLUTION LIMITED')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: 
                radial-gradient(ellipse at 20% 20%, rgba(0, 255, 136, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(0, 200, 255, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 40% 80%, rgba(255, 0, 128, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(255, 170, 0, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, #0a0a0a 0%, #1a0a2e 20%, #0d1b2a 40%, #1b263b 60%, #2d1b4e 80%, #0a0a0a 100%);
            min-height: 100vh;
            overflow-x: hidden;
            color: white;
            background-attachment: fixed;
        }

        /* Animated Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: 
                linear-gradient(45deg, rgba(0, 255, 136, 0.03) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(0, 200, 255, 0.03) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(255, 0, 128, 0.03) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(255, 170, 0, 0.03) 75%);
            background-size: 60px 60px;
            animation: pattern-move 20s linear infinite;
        }

        @keyframes pattern-move {
            0% { background-position: 0 0, 0 0, 0 0, 0 0; }
            100% { background-position: 60px 60px, 60px 60px, 60px 60px, 60px 60px; }
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #00ff88;
            border-radius: 50%;
            animation: float 15s infinite;
            opacity: 0.8;
            box-shadow: 0 0 10px #00ff88;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100vh) rotate(720deg);
                opacity: 0;
            }
        }

        /* Gradient Orbs */
        .gradient-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            animation: orb-move 20s ease-in-out infinite;
        }

        .orb-1 {
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(0, 255, 136, 0.4) 0%, rgba(0, 200, 255, 0.2) 50%, transparent 70%);
            top: -250px;
            right: -250px;
        }

        .orb-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 0, 128, 0.3) 0%, rgba(128, 0, 255, 0.2) 50%, transparent 70%);
            bottom: -250px;
            left: -250px;
            animation-delay: -10s;
        }

        @keyframes orb-move {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(50px, -50px) scale(1.1); }
            50% { transform: translate(-50px, 50px) scale(0.9); }
            75% { transform: translate(-50px, -50px) scale(1.05); }
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.95) 0%, rgba(26, 10, 46, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(0, 255, 136, 0.2);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 200, 255, 0.2) 100%);
            border: 1px solid rgba(0, 255, 136, 0.3);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .nav-link .dropdown-toggle {
            color: rgba(255,255,255,0.7);
        }

        .sidebar .nav-link .dropdown-toggle:hover,
        .sidebar .nav-link .dropdown-toggle.active {
            color: white;
        }

        .sidebar .collapse .nav-link {
            margin: 3px 0;
            padding: 10px 15px 10px 30px;
            font-size: 0.9rem;
        }

        .main-content {
            padding: 30px;
        }

        /* Cards */
        .card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 255, 136, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: 700;
        }

        .card-body {
            color: #cbd5e1;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 24px;
            padding: 2rem;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.3);
        }

        .stat-card.purple { 
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 200, 255, 0.2) 100%);
            border-color: rgba(0, 255, 136, 0.3);
        }
        .stat-card.blue { 
            background: linear-gradient(135deg, rgba(0, 200, 255, 0.2) 0%, rgba(255, 0, 128, 0.2) 100%);
            border-color: rgba(0, 200, 255, 0.3);
        }
        .stat-card.green { 
            background: linear-gradient(135deg, rgba(255, 0, 128, 0.2) 0%, rgba(255, 170, 0, 0.2) 100%);
            border-color: rgba(255, 0, 128, 0.3);
        }
        .stat-card.orange { 
            background: linear-gradient(135deg, rgba(255, 170, 0, 0.2) 0%, rgba(0, 255, 136, 0.2) 100%);
            border-color: rgba(255, 170, 0, 0.3);
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-card p {
            margin: 0;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Table */
        .table {
            border-radius: 16px;
            overflow: hidden;
            color: #cbd5e1;
        }

        .table thead {
            background: rgba(15, 23, 42, 0.8);
        }

        .table thead th {
            color: #00ff88;
            font-weight: 700;
            border-bottom: 2px solid rgba(0, 255, 136, 0.2);
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(0, 255, 136, 0.05);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #00ff88 100%);
            border: none;
            color: #0a0a0a;
            font-weight: 700;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(0, 255, 136, 0.5);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 255, 136, 0.7);
        }

        .btn-outline-primary {
            border: 2px solid rgba(0, 200, 255, 0.8);
            color: #00c8ff;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
        }

        .btn-outline-primary:hover {
            background: rgba(0, 200, 255, 0.1);
            border-color: #00c8ff;
            transform: translateY(-3px);
            color: #00c8ff;
        }

        .btn-success {
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 100%);
            border: none;
            color: #0a0a0a;
            font-weight: 700;
            border-radius: 50px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff0080 0%, #ffaa00 100%);
            border: none;
            color: white;
            font-weight: 700;
            border-radius: 50px;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffaa00 0%, #ff0080 100%);
            border: none;
            color: white;
            font-weight: 700;
            border-radius: 50px;
        }

        /* Alert */
        .alert {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            color: white;
        }

        .alert-success {
            border-color: rgba(0, 255, 136, 0.3);
            background: rgba(0, 255, 136, 0.1);
        }

        .alert-danger {
            border-color: rgba(255, 0, 128, 0.3);
            background: rgba(255, 0, 128, 0.1);
        }

        .alert-info {
            border-color: rgba(0, 200, 255, 0.3);
            background: rgba(0, 200, 255, 0.1);
        }

        /* Form */
        .form-label {
            color: #cbd5e1;
            font-weight: 600;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: rgba(0, 255, 136, 0.6);
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.2);
            color: white;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        /* Page Title */
        h1 {
            font-weight: 800;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h2, h3, h4, h5, h6 {
            color: white;
        }

        a {
            color: #00c8ff;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            color: #00ff88;
        }

        /* Badge */
        .badge {
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Animated Particles -->
    <div class="particles" id="particles"></div>

    <!-- Gradient Orbs -->
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>

    @if(auth()->check())
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white" style="font-weight: 800; background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            <i class="bi bi-lightning-charge-fill me-2"></i>YUSU POWER
                        </h4>
                        <p class="text-white-50 small">Welcome, {{ auth()->user()->name }}</p>
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
                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-danger w-100 text-start" style="background: none; border: none; cursor: pointer;">
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

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                
                const colors = ['#00ff88', '#00c8ff', '#ff0080', '#ffaa00'];
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.boxShadow = `0 0 10px ${colors[Math.floor(Math.random() * colors.length)]}`;
                
                particlesContainer.appendChild(particle);
            }
        }

        createParticles();
    </script>
</body>
</html>
