<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            display: flex;
            align-items: center;
            justify-content: center;
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

        .login-container {
            max-width: 900px;
            width: 100%;
            padding: 2rem;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 3rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--wecom-gray);
            font-size: 0.95rem;
        }

        .login-option {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .login-option:hover {
            border-color: var(--wecom-green);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .login-option.active {
            border-color: var(--wecom-green);
            background: var(--wecom-green-light);
        }

        .login-option-icon {
            width: 48px;
            height: 48px;
            background: var(--wecom-green-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--wecom-green);
            margin-bottom: 1rem;
        }

        .login-option h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .login-option p {
            color: var(--wecom-gray);
            font-size: 0.9rem;
            margin: 0;
        }

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
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: var(--wecom-green);
            box-shadow: 0 0 0 3px var(--wecom-green-light);
            color: #333;
        }

        .btn-wecom-primary {
            background: var(--wecom-green);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 4px;
            padding: 0.75rem 2rem;
            transition: all 0.2s ease;
            width: 100%;
        }

        .btn-wecom-primary:hover {
            background: var(--wecom-green-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(7, 193, 96, 0.3);
        }

        .btn-wecom-outline {
            border: 1px solid var(--wecom-green);
            color: var(--wecom-green);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
            background: transparent;
            width: 100%;
        }

        .btn-wecom-outline:hover {
            background: var(--wecom-green-light);
            transform: translateY(-1px);
        }

        .alert {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            color: #333;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            border-color: #ff4d4f;
            background: #fff1f0;
            color: #ff4d4f;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--wecom-gray);
            cursor: pointer;
            padding: 0;
        }

        .password-toggle:hover {
            color: var(--wecom-green);
        }

        .back-link {
            color: var(--wecom-gray);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--wecom-green);
        }

        @media (max-width: 768px) {
            .login-card {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <a href="/" class="back-link">
                    <i class="bi bi-arrow-left me-2"></i>Back to Home
                </a>
                <h1>Login</h1>
                <p>Choose your login type to continue</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="login-option" onclick="selectLoginType('admin')">
                        <div class="login-option-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3>Admin Login</h3>
                        <p>For administrators and managers</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-option" onclick="selectLoginType('user')">
                        <div class="login-option-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <h3>User Login</h3>
                        <p>For employees and staff</p>
                    </div>
                </div>
            </div>

            <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="mt-4" style="display: none;">
                @csrf
                <input type="hidden" name="login_type" id="loginType" value="">

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function selectLoginType(type) {
            const loginOptions = document.querySelectorAll('.login-option');
            loginOptions.forEach(option => option.classList.remove('active'));
            
            if (type === 'admin') {
                loginOptions[0].classList.add('active');
                document.getElementById('email').value = 'aloyceotieno254@gmail.com';
            } else {
                loginOptions[1].classList.add('active');
                document.getElementById('email').value = '';
            }
            
            document.getElementById('loginType').value = type;
            document.getElementById('loginForm').style.display = 'block';
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + 'Icon');
            
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
    </script>
</body>
</html>
