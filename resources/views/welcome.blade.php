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

        /* Top Marquee */
        .top-marquee {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 50%, var(--primary) 100%);
            background-size: 200% 100%;
            animation: gradientMove 8s ease infinite;
            color: white;
            padding: 1rem 0;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 20px rgba(7, 193, 96, 0.3);
            z-index: 1000;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .marquee-wrapper {
            display: flex;
            align-items: center;
            overflow: hidden;
            width: 100%;
        }

        .marquee-content {
            display: flex;
            animation: scroll 25s linear infinite;
            white-space: nowrap;
            will-change: transform;
        }

        .marquee-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 3rem;
            font-size: 1rem;
            font-weight: 500;
            border-right: 2px solid rgba(255, 255, 255, 0.2);
        }

        .marquee-item:last-child {
            border-right: none;
        }

        .marquee-item i {
            font-size: 1.4rem;
            opacity: 1;
            animation: iconPulse 2s ease-in-out infinite;
        }

        .marquee-item:nth-child(2) i { animation-delay: 0.2s; }
        .marquee-item:nth-child(3) i { animation-delay: 0.4s; }
        .marquee-item:nth-child(4) i { animation-delay: 0.6s; }
        .marquee-item:nth-child(5) i { animation-delay: 0.8s; }
        .marquee-item:nth-child(6) i { animation-delay: 1s; }
        .marquee-item:nth-child(7) i { animation-delay: 1.2s; }
        .marquee-item:nth-child(8) i { animation-delay: 1.4s; }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }

        .marquee-item span {
            color: rgba(255, 255, 255, 0.95);
        }

        .marquee-item strong {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .top-marquee:hover .marquee-content {
            animation-play-state: paused;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e5e5;
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            position: relative;
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
            background: linear-gradient(135deg, rgba(7, 193, 96, 0.95) 0%, rgba(6, 173, 87, 0.95) 100%),
                        url('https://images.unsplash.com/photo-1563217849-f0f782778568?w=1920&q=80') center/cover no-repeat;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(7, 193, 96, 0.9) 0%, rgba(6, 173, 87, 0.85) 100%);
            z-index: 0;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-badge i {
            margin-right: 0.5rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: white;
            letter-spacing: -1px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.8;
            max-width: 600px;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
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

        /* About Section */
        .about-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, rgba(7, 193, 96, 0.05) 0%, rgba(255, 255, 255, 0.95) 100%),
                        url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1920&q=80') center/cover no-repeat;
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(7, 193, 96, 0.05) 0%, rgba(255, 255, 255, 0.95) 100%);
            z-index: 0;
        }

        .about-content {
            position: relative;
            z-index: 1;
        }

        .features-section > .container {
            position: relative;
            z-index: 1;
        }

        .about-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            height: 100%;
            border: 2px solid rgba(7, 193, 96, 0.2);
        }

        .about-flag {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }

        .flag-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(7, 193, 96, 0.1) 100%);
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .flag-item i {
            font-size: 1.25rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2.4rem;
            top: 0.5rem;
            width: 1.5rem;
            height: 1.5rem;
            background: var(--primary);
            border: 4px solid white;
            border-radius: 50%;
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .timeline-year {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .timeline-text {
            color: #333;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
            background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)),
                        url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920&q=80') center/cover no-repeat;
            position: relative;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.98));
            z-index: 0;
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
            transition: 0.3s;
            font-size: 0.95rem;
            display: block;
            margin-bottom: 0.75rem;
            cursor: pointer;
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
            .marquee-item {
                padding: 0 1.5rem;
                font-size: 0.85rem;
            }
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #e5e5e5;
            padding: 1.5rem 2rem;
        }

        .modal-title {
            font-weight: 700;
            color: var(--dark);
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-detail-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
        }

        .feature-detail-list li {
            padding: 0.75rem 0;
            padding-left: 2rem;
            position: relative;
            color: var(--gray);
            line-height: 1.7;
        }

        .feature-detail-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: 700;
        }

        .btn-close-modal {
            background: var(--primary);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-close-modal:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Top Marquee -->
    <div class="top-marquee">
        <div class="marquee-wrapper">
            <div class="marquee-content">
                <div class="marquee-item">
                    <i class="bi bi-trophy-fill"></i>
                    <span><strong>30+ Years</strong> of Excellence in Battery Technology</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-globe2"></i>
                    <span><strong>Global Presence:</strong> China HQ & 10+ African Countries</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-award-fill"></i>
                    <span><strong>Award-Winning</strong> Innovation in Energy Storage</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <span><strong>Cutting-Edge</strong> Battery Solutions for Tomorrow</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-shield-check"></i>
                    <span><strong>ISO Certified</strong> Quality & Safety Standards</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-people-fill"></i>
                    <span><strong>500+ Skilled</strong> Professionals Worldwide</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-rocket-takeoff"></i>
                    <span><strong>1000+ Projects</strong> Successfully Delivered</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-star-fill"></i>
                    <span><strong>Trusted by</strong> Industry Leaders Worldwide</span>
                </div>
                <!-- Duplicate for seamless loop -->
                <div class="marquee-item">
                    <i class="bi bi-trophy-fill"></i>
                    <span><strong>30+ Years</strong> of Excellence in Battery Technology</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-globe2"></i>
                    <span><strong>Global Presence:</strong> China HQ & 10+ African Countries</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-award-fill"></i>
                    <span><strong>Award-Winning</strong> Innovation in Energy Storage</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <span><strong>Cutting-Edge</strong> Battery Solutions for Tomorrow</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-shield-check"></i>
                    <span><strong>ISO Certified</strong> Quality & Safety Standards</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-people-fill"></i>
                    <span><strong>500+ Skilled</strong> Professionals Worldwide</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-rocket-takeoff"></i>
                    <span><strong>1000+ Projects</strong> Successfully Delivered</span>
                </div>
                <div class="marquee-item">
                    <i class="bi bi-star-fill"></i>
                    <span><strong>Trusted by</strong> Industry Leaders Worldwide</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
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

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">About Us</span>
                <h2 class="section-title">Our Story</h2>
                <p class="section-subtitle">From China to Africa - Leading the battery technology revolution across continents</p>
            </div>
            <div class="row g-4 about-content">
                <div class="col-lg-6">
                    <div class="about-card">
                        <h3 class="fw-bold mb-3" style="font-size: 1.5rem; color: var(--dark);">YUSU POWER MOUNTAIN SOLUTION LIMITED</h3>
                        <p class="mb-3" style="line-height: 1.8; color: #333; font-size: 1.05rem;">
                            Founded in China as a pioneer in battery technology, YUSU POWER MOUNTAIN SOLUTION LIMITED has grown into a global leader in energy storage solutions. With decades of expertise in advanced battery manufacturing and innovation, we have expanded our operations to bring cutting-edge technology to emerging markets.
                        </p>
                        <p class="mb-3" style="line-height: 1.8; color: #333; font-size: 1.05rem;">
                            Our African expansion marks a significant milestone in our journey to power sustainable development across the continent. With established branches in Kenya and plans for further expansion, we are committed to delivering world-class battery solutions tailored to the unique needs of African markets.
                        </p>
                        <div class="about-flag">
                            <div class="flag-item">
                                <i class="bi bi-flag-fill" style="color: #dc143c;"></i>
                                China (HQ)
                            </div>
                            <div class="flag-item">
                                <i class="bi bi-flag-fill" style="color: #006400;"></i>
                                Kenya
                            </div>
                            <div class="flag-item">
                                <i class="bi bi-globe"></i>
                                Africa
                            </div>
                        </div>
                        <h6 class="fw-bold mb-2 mt-4" style="color: var(--primary); font-size: 1.1rem;">Our Mission</h6>
                        <p class="mb-0" style="line-height: 1.7; color: #333; font-size: 1.05rem;">
                            To provide innovative, sustainable, and reliable battery solutions that power progress and improve lives across Africa and beyond.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card">
                        <h3 class="fw-bold mb-4" style="font-size: 1.5rem; color: var(--dark);">Our Journey</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-year">1990s</div>
                                <div class="timeline-text">
                                    Founded in China as a small battery manufacturing unit with a vision for innovation and quality.
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">2000s</div>
                                <div class="timeline-text">
                                    Expanded production capacity and became a leading battery supplier in the Chinese market.
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">2010s</div>
                                <div class="timeline-text">
                                    Invested in R&D for advanced battery technologies and established international partnerships.
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">2020s</div>
                                <div class="timeline-text">
                                    Expanded to Africa with Kenya as our first regional hub, bringing advanced battery solutions to the continent.
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">Present</div>
                                <div class="timeline-text">
                                    Operating across multiple African countries with plans for further expansion, delivering excellence in energy storage.
                                </div>
                            </div>
                        </div>
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
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <h3>QR Attendance</h3>
                    <p>Scan QR codes to check in/out with timestamps. Track attendance patterns and status with ease.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#qrAttendanceModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3>Job Tracking</h3>
                    <p>Record and monitor job outputs. Track productivity metrics and performance data in real-time.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#jobTrackingModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Team Messaging</h3>
                    <p>Real-time chat with teammates. Send messages, share files, and collaborate securely.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#teamMessagingModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Work Groups</h3>
                    <p>Create team groups for collaboration. Share announcements and coordinate work efficiently.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#workGroupsModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3>Leave Management</h3>
                    <p>Apply for leave requests including personal, sick, annual, and adjustment leaves with approval workflow.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#leaveManagementModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h3>Task Management</h3>
                    <p>Assign and track tasks with priorities and due dates. Monitor progress and productivity.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#taskManagementModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <h3>Meeting Scheduling</h3>
                    <p>Schedule meetings and video calls. Invite participants and share details effortlessly.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#meetingSchedulingModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h3>Approvals</h3>
                    <p>Submit and review approval requests. Streamline decision-making processes.</p>
                    <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#approvalsModal">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>30+</h3>
                    <p>Years Experience</p>
                </div>
                <div class="stat-item">
                    <h3>10+</h3>
                    <p>African Countries</p>
                </div>
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Employees</p>
                </div>
                <div class="stat-item">
                    <h3>1000+</h3>
                    <p>Projects Delivered</p>
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
                    <span class="footer-link">Home</span>
                    <span class="footer-link">About Us</span>
                    <span class="footer-link">Services</span>
                    <span class="footer-link">Contact</span>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Features</h5>
                    <span class="footer-link" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#qrAttendanceModal">Attendance</span>
                    <span class="footer-link" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#teamMessagingModal">Messaging</span>
                    <span class="footer-link" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#taskManagementModal">Tasks</span>
                    <span class="footer-link" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#jobTrackingModal">Reports</span>
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

    <!-- Feature Modals -->
    <!-- QR Attendance Modal -->
    <div class="modal fade" id="qrAttendanceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">QR Attendance System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Our QR Attendance system allows employees to check in and out by scanning a QR code at the company gate, providing an efficient and contactless way to track attendance.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Browser-based QR scanning - no app required</li>
                        <li>Automatic timestamp recording for check-in/out</li>
                        <li>Real-time attendance status tracking</li>
                        <li>Attendance history and reports</li>
                        <li>Geo-location verification (optional)</li>
                        <li>Admin dashboard for monitoring</li>
                    </ul>
                    <h6 class="fw-bold mb-2">How It Works:</h6>
                    <p class="text-muted">
                        A unique QR code is displayed at the company entrance. Employees scan it using their smartphone camera or the built-in browser scanner to log their attendance. The system automatically records the time and date, making attendance tracking seamless and accurate.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Tracking Modal -->
    <div class="modal fade" id="jobTrackingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Job Tracking System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Track and monitor job outputs with our comprehensive job tracking system. Monitor productivity, analyze performance metrics, and make data-driven decisions.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Record daily job outputs and tasks completed</li>
                        <li>Track productivity metrics and KPIs</li>
                        <li>Generate performance reports</li>
                        <li>Compare individual and team performance</li>
                        <li>Visual charts and analytics</li>
                        <li>Export data for further analysis</li>
                    </ul>
                    <h6 class="fw-bold mb-2">Benefits:</h6>
                    <p class="text-muted">
                        Managers can easily track employee productivity, identify top performers, and address areas needing improvement. Employees can monitor their own progress and set productivity goals.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Messaging Modal -->
    <div class="modal fade" id="teamMessagingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Team Messaging</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Communicate seamlessly with your team through our real-time messaging system. Send messages, share files, and collaborate efficiently.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Real-time direct messaging</li>
                        <li>Group messaging for team collaboration</li>
                        <li>File sharing and attachments</li>
                        <li>Message history and search</li>
                        <li>Read receipts and status indicators</li>
                        <li>Private replies in group chats</li>
                    </ul>
                    <h6 class="fw-bold mb-2">How It Works:</h6>
                    <p class="text-muted">
                        Start a conversation with any colleague or create group chats for projects. Send text messages, share documents, and collaborate in real-time. Messages are organized by conversation for easy reference.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Work Groups Modal -->
    <div class="modal fade" id="workGroupsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Work Groups</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Create and manage work groups for better team coordination. Share announcements, coordinate projects, and keep everyone aligned.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Create unlimited work groups</li>
                        <li>Add/remove group members</li>
                        <li>Group messaging and discussions</li>
                        <li>Announcement groups for company-wide updates</li>
                        <li>Group admin controls</li>
                        <li>Member notifications</li>
                    </ul>
                    <h6 class="fw-bold mb-2">Use Cases:</h6>
                    <p class="text-muted">
                        Create groups for departments, projects, or teams. Use announcement groups for company-wide communications. Group members can collaborate through messaging and stay updated on relevant discussions.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Management Modal -->
    <div class="modal fade" id="leaveManagementModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Leave Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Streamline your leave management process with our comprehensive system. Apply for various types of leave and track approval status.
                    </p>
                    <h6 class="fw-bold mb-2">Leave Types:</h6>
                    <ul class="feature-detail-list">
                        <li>Personal leave - for personal matters</li>
                        <li>Sick leave - for health-related absences</li>
                        <li>Annual leave - for vacation and holidays</li>
                        <li>Adjustment leave - for schedule adjustments</li>
                    </ul>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Automatic leave days calculation</li>
                        <li>Date validation (prevents past dates)</li>
                        <li>Approval workflow with notifications</li>
                        <li>Leave balance tracking</li>
                        <li>Leave history and reports</li>
                        <li>Admin approval dashboard</li>
                    </ul>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Management Modal -->
    <div class="modal fade" id="taskManagementModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Task Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Assign, track, and manage tasks efficiently. Keep your team organized and ensure deadlines are met with our task management system.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Create and assign tasks to team members</li>
                        <li>Set task priorities (low, medium, high, urgent)</li>
                        <li>Define due dates and deadlines</li>
                        <li>Track task status (pending, in progress, completed)</li>
                        <li>Task descriptions and details</li>
                        <li>Notifications for task assignments</li>
                    </ul>
                    <h6 class="fw-bold mb-2">Benefits:</h6>
                    <p class="text-muted">
                        Managers can delegate tasks effectively and monitor progress. Team members receive clear assignments with priorities and deadlines. The system ensures accountability and transparency in task completion.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Meeting Scheduling Modal -->
    <div class="modal fade" id="meetingSchedulingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Meeting Scheduling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Schedule and manage meetings effortlessly. Invite participants, set agendas, and keep everyone informed about upcoming meetings.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Schedule meetings with date and time</li>
                        <li>Invite multiple participants</li>
                        <li>Meeting types: regular, video call, training</li>
                        <li>Meeting location and description</li>
                        <li>Participant notifications</li>
                        <li>Meeting history and calendar view</li>
                    </ul>
                    <h6 class="fw-bold mb-2">How It Works:</h6>
                    <p class="text-muted">
                        Create a meeting, select the date and time, add location details, and invite participants. The system automatically sends notifications to all invitees. Participants can view meeting details and prepare accordingly.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Approvals Modal -->
    <div class="modal fade" id="approvalsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approvals System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <p class="text-muted mb-3">
                        Streamline decision-making processes with our approvals system. Submit requests for approval and track their status in real-time.
                    </p>
                    <h6 class="fw-bold mb-2">Key Features:</h6>
                    <ul class="feature-detail-list">
                        <li>Submit approval requests</li>
                        <li>Assign approvers for each request</li>
                        <li>Track approval status (pending, approved, rejected)</li>
                        <li>Add request details and descriptions</li>
                        <li>Notifications for approvers and requesters</li>
                        <li>Approval history and reports</li>
                    </ul>
                    <h6 class="fw-bold mb-2">Use Cases:</h6>
                    <p class="text-muted">
                        Use for expense approvals, project authorizations, resource requests, or any process requiring management approval. The system ensures transparency and keeps all stakeholders informed throughout the approval process.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Got It</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
