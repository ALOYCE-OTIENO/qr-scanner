<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
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
            padding: 2rem 0;
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

        .register-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
        }

        .register-card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 3rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-icon {
            width: 64px;
            height: 64px;
            background: var(--wecom-green-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--wecom-green);
            margin: 0 auto 1.5rem;
        }

        .register-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: var(--wecom-gray);
            font-size: 0.95rem;
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

        .login-link {
            color: var(--wecom-green);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link:hover {
            color: var(--wecom-green-hover);
        }

        @media (max-width: 768px) {
            .register-card {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <a href="/" class="back-link">
                    <i class="bi bi-arrow-left me-2"></i>Back to Home
                </a>
                <div class="register-icon">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h1>Create Account</h1>
                <p>Join YUSU POWER MOUNTAIN SOLUTION LIMITED</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                </div>

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
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="bi bi-eye" id="password_confirmationIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="mb-0" style="color: var(--wecom-gray);">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="login-link">Login here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
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
