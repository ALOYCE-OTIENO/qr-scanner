<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        :root {
            --primary: #07C160;
            --primary-dark: #06ad57;
            --primary-light: #07C1601a;
            --dark: #1a1a1a;
            --gray: #666;
            --light-gray: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e5e5;
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand i {
            color: var(--primary);
            font-size: 1.75rem;
        }

        .btn-login {
            background: var(--primary);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 193, 96, 0.3);
        }

        .btn-register {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-register:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 8rem 0 4rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: var(--primary-light);
            border-radius: 50%;
            filter: blur(100px);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: var(--primary-light);
            border-radius: 50%;
            filter: blur(80px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            border-radius: 50px;
            border: 1px solid var(--primary);
        }

        .hero-badge i {
            margin-right: 0.5rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--dark);
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.8;
            max-width: 600px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            position: relative;
            z-index: 1;
        }

        .hero-visual i {
            font-size: 15rem;
            color: var(--primary);
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(7, 193, 96, 0.3));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
            background: #ffffff;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-tag {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 50px;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
            letter-spacing: -1px;
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e5e5;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(7, 193, 96, 0.15);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(7, 193, 96, 0.3);
        }

        .feature-card h3 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .feature-card p {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.7;
            margin: 0;
        }

        .feature-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-weight: 600;
            margin-top: 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .feature-link:hover {
            gap: 0.75rem;
        }

        /* Stats Section */
        .stats-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 0;
            background: var(--light-gray);
            text-align: center;
        }

        .cta-box {
            background: white;
            border-radius: 24px;
            padding: 4rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .cta-box h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .cta-box p {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.95rem;
            display: block;
            margin-bottom: 0.75rem;
        }

        .footer-link:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            margin-right: 0.75rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3rem;
            }
            .hero-visual i {
                font-size: 10rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-section {
                padding: 6rem 0 3rem;
            }
            .feature-grid {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                gap: 2rem;
            }
            .stat-item h3 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-battery-charging"></i>
                YUSU POWER
            </a>
            <div class="ms-auto d-flex gap-3">
                <a href="{{ route('login') }}" class="btn btn-login d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-register d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus"></i>
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="hero-badge">
                            <i class="bi bi-battery-charging"></i>
                            Battery Technology Solutions
                        </span>
                        <h1 class="hero-title">
                            YUSU POWER<br>
                            MOUNTAIN<br>
                            SOLUTION LIMITED
                        </h1>
                        <p class="hero-subtitle">
                            Pioneering the future of battery technology with innovative solutions 
                            for a sustainable tomorrow. Powering progress, one battery at a time.
                        </p>
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-register">
                                <i class="bi bi-person-plus me-2"></i>Register
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="hero-visual">
                        <i class="bi bi-battery-charging"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Platform Features</span>
                <h2 class="section-title">Everything You Need</h2>
                <p class="section-subtitle">A complete solution for attendance tracking, job management, and team collaboration</p>
            </div>
            <div class="feature-grid">
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <h3>QR Attendance</h3>
                    <p>Scan QR codes to check in/out with timestamps. Track attendance patterns and status with ease.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3>Job Tracking</h3>
                    <p>Record and monitor job outputs. Track productivity metrics and performance data in real-time.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Team Messaging</h3>
                    <p>Real-time chat with teammates. Send messages, share files, and collaborate securely.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Work Groups</h3>
                    <p>Create team groups for collaboration. Share announcements and coordinate work efficiently.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3>Leave Management</h3>
                    <p>Apply for leave requests including personal, sick, annual, and adjustment leaves with approval workflow.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h3>Task Management</h3>
                    <p>Assign and track tasks with priorities and due dates. Monitor progress and productivity.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <h3>Meeting Scheduling</h3>
                    <p>Schedule meetings and video calls. Invite participants and share details effortlessly.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="feature-card" style="text-decoration: none; color: inherit;">
                    <div class="feature-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h3>Approvals</h3>
                    <p>Submit and review approval requests. Streamline decision-making processes.</p>
                    <span class="feature-link">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Years Experience</p>
                </div>
                <div class="stat-item">
                    <h3>100%</h3>
                    <p>Client Satisfaction</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Support Available</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-box">
                <h2>Ready to Power Your Future?</h2>
                <p>Join our team and be part of the battery technology revolution</p>
                <a href="{{ route('register') }}" class="btn btn-login">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">
                        <i class="bi bi-battery-charging me-2" style="color: var(--primary);"></i>
                        YUSU POWER
                    </h5>
                    <p style="color: rgba(255, 255, 255, 0.7); line-height: 1.7;">
                        Pioneering battery technology solutions for a sustainable future. 
                        Leading innovation in energy storage and management.
                    </p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Quick Links</h5>
                    <a href="#" class="footer-link">Home</a>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Services</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Features</h5>
                    <a href="#" class="footer-link">Attendance</a>
                    <a href="#" class="footer-link">Messaging</a>
                    <a href="#" class="footer-link">Tasks</a>
                    <a href="#" class="footer-link">Reports</a>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Connect With Us</h5>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">
                    © 2024 YUSU POWER MOUNTAIN SOLUTION LIMITED. All rights reserved.
                </p>
                <p class="mb-0 small mt-2">
                    <i class="bi bi-lightning-charge-fill me-1" style="color: var(--primary);"></i>
                    Powering Tomorrow's Technology
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
