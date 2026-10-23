<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Login Card */
        .login-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 255, 136, 0.2);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #00ff88, #00c8ff, #ff0080);
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .login-subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 2rem;
        }

        /* Login Options */
        .login-option {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .login-option:hover {
            transform: translateY(-5px);
            border-color: rgba(0, 255, 136, 0.5);
            box-shadow: 0 15px 30px rgba(0, 255, 136, 0.2);
        }

        .login-option.active {
            border-color: rgba(0, 255, 136, 0.6);
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 200, 255, 0.15) 100%);
            box-shadow: 0 15px 30px rgba(0, 255, 136, 0.3);
        }

        .login-option i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-option h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .login-option small {
            color: #94a3b8;
        }

        /* Form Styling */
        .form-label {
            color: #cbd5e1;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 0.875rem 1rem;
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

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
            font-size: 1.25rem;
            transition: 0.3s;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #00ff88;
        }

        .password-wrapper {
            position: relative;
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #00ff88 100%);
            border: none;
            padding: 1rem 2rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(0, 255, 136, 0.5);
            position: relative;
            overflow: hidden;
            color: #0a0a0a;
            width: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 255, 136, 0.7);
        }

        .btn-outline-custom {
            border: 2px solid rgba(0, 200, 255, 0.8);
            color: #00c8ff;
            padding: 0.875rem 2rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
            background: transparent;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: rgba(0, 200, 255, 0.1);
            border-color: #00c8ff;
            transform: translateY(-2px);
            color: #00c8ff;
        }

        /* Forms */
        .login-form {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .login-form.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Alert */
        .alert {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
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

        /* Back Link */
        .back-link {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
            z-index: 10;
        }

        .back-link:hover {
            color: #00ff88;
        }

        .back-link i {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Animated Particles -->
    <div class="particles" id="particles"></div>

    <!-- Gradient Orbs -->
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>

    <!-- Back Link -->
    <a href="/" class="back-link">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="login-card">
        <h2 class="login-title">Welcome Back</h2>
        <p class="login-subtitle">Login to access your account</p>
        
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        
        <!-- Login Options -->
        <div class="mb-4">
            <div class="login-option active" onclick="selectLoginOption('admin')">
                <div class="d-flex align-items-center">
                    <i class="bi bi-shield-lock me-3"></i>
                    <div>
                        <h5 class="mb-0">Admin Login</h5>
                        <small>For administrators only</small>
                    </div>
                </div>
            </div>
            
            <div class="login-option" onclick="selectLoginOption('user')">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person me-3"></i>
                    <div>
                        <h5 class="mb-0">User Login</h5>
                        <small>For employees and regular users</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Admin Login Form -->
        <form method="POST" action="{{ route('login.post') }}" class="login-form active" id="adminForm">
            @csrf
            <input type="hidden" name="login_type" value="admin">
            <div class="mb-3">
                <label for="admin_email" class="form-label">Admin Email</label>
                <input type="email" class="form-control" id="admin_email" name="email" required autofocus placeholder="Enter admin email">
            </div>
            <div class="mb-3">
                <label for="admin_password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" class="form-control" id="admin_password" name="password" required placeholder="Enter password">
                    <button type="button" class="password-toggle" onclick="togglePassword('admin_password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary-custom">
                <i class="bi bi-shield-lock me-2"></i> Login as Admin
            </button>
        </form>
        
        <!-- User Login Form -->
        <form method="POST" action="{{ route('login.post') }}" class="login-form" id="userForm">
            @csrf
            <input type="hidden" name="login_type" value="user">
            <div class="mb-3">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user_email" name="email" required placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" class="form-control" id="user_password" name="password" required placeholder="Enter your password">
                    <button type="button" class="password-toggle" onclick="togglePassword('user_password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary-custom">
                <i class="bi bi-person me-2"></i> Login as User
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="mb-0" style="color: #94a3b8;">Don't have an account? <a href="{{ route('register') }}" class="btn-outline-custom">Register here</a></p>
        </div>
    </div>
    
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

        function selectLoginOption(type) {
            document.querySelectorAll('.login-option').forEach(option => {
                option.classList.remove('active');
            });
            
            document.querySelectorAll('.login-form').forEach(form => {
                form.classList.remove('active');
            });
            
            if (type === 'admin') {
                document.querySelectorAll('.login-option')[0].classList.add('active');
                document.getElementById('adminForm').classList.add('active');
            } else {
                document.querySelectorAll('.login-option')[1].classList.add('active');
                document.getElementById('userForm').classList.add('active');
            }
        }

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        createParticles();
    </script>
</body>
</html>
