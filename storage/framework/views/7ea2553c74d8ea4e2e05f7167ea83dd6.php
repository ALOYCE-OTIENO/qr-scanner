<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
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
        }

        /* Animated Particle Background */
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
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
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
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(0, 255, 136, 0.5) 0%, rgba(0, 200, 255, 0.3) 40%, transparent 70%);
            top: -300px;
            right: -300px;
        }

        .orb-2 {
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(255, 0, 128, 0.4) 0%, rgba(128, 0, 255, 0.3) 40%, transparent 70%);
            bottom: -300px;
            left: -300px;
            animation-delay: -10s;
        }

        .orb-3 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 170, 0, 0.4) 0%, rgba(255, 69, 0, 0.3) 40%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -5s;
        }

        @keyframes orb-move {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(80px, -80px) scale(1.15); }
            50% { transform: translate(-80px, 80px) scale(0.85); }
            75% { transform: translate(-80px, -80px) scale(1.1); }
        }

        /* Additional Gradient Layers */
        .gradient-layer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: 
                linear-gradient(135deg, rgba(0, 255, 136, 0.05) 0%, transparent 50%),
                linear-gradient(225deg, rgba(0, 200, 255, 0.05) 0%, transparent 50%),
                linear-gradient(315deg, rgba(255, 0, 128, 0.05) 0%, transparent 50%),
                linear-gradient(45deg, rgba(255, 170, 0, 0.05) 0%, transparent 50%);
            animation: gradient-shift 30s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Navbar */
        .navbar {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 255, 136, 0.3);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(10, 10, 10, 0.98);
            box-shadow: 0 4px 30px rgba(0, 255, 136, 0.2);
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 5s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 0 80px;
            position: relative;
        }

        .hero-content {
            color: white;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 200, 255, 0.2) 100%);
            border: 2px solid rgba(0, 255, 136, 0.5);
            border-radius: 50px;
            color: #00ff88;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            animation: badge-pulse 2s ease-in-out infinite;
        }

        @keyframes badge-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(0, 255, 136, 0.5); }
            50% { box-shadow: 0 0 0 15px rgba(0, 255, 136, 0); }
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 25%, #ff0080 50%, #ffaa00 75%, #00ff88 100%);
            background-size: 300% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-flow 8s ease infinite;
        }

        @keyframes gradient-flow {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: #cbd5e1;
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.8;
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #00ff88 100%);
            border: none;
            padding: 1.25rem 3.5rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(0, 255, 136, 0.5);
            position: relative;
            overflow: hidden;
            color: #0a0a0a;
            font-size: 1.1rem;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 255, 136, 0.7);
        }

        .btn-outline-custom {
            border: 2px solid rgba(0, 200, 255, 0.8);
            color: #00c8ff;
            padding: 1.25rem 3.5rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
            background: transparent;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }

        .btn-outline-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, #00c8ff 0%, #0080ff 100%);
            transition: 0.4s;
            z-index: -1;
        }

        .btn-outline-custom:hover::before {
            width: 100%;
        }

        .btn-outline-custom:hover {
            color: #0a0a0a;
            border-color: #00c8ff;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 200, 255, 0.5);
        }

        /* Feature Cards */
        .feature-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #00ff88, #00c8ff, #ff0080);
            transform: scaleX(0);
            transition: 0.4s;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-15px);
            border-color: rgba(0, 255, 136, 0.5);
            box-shadow: 0 25px 50px rgba(0, 255, 136, 0.3);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 200, 255, 0.2) 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
            color: #00ff88;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: rotateY(180deg);
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 100%);
            color: #0a0a0a;
        }

        .feature-title {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .feature-text {
            color: #94a3b8;
            font-size: 1rem;
            line-height: 1.8;
        }

        /* Services Section */
        .service-card {
            background: linear-gradient(135deg, rgba(255, 0, 128, 0.15) 0%, rgba(0, 200, 255, 0.15) 100%);
            border: 1px solid rgba(255, 0, 128, 0.3);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: scale(1.05);
            border-color: rgba(255, 0, 128, 0.6);
            box-shadow: 0 20px 40px rgba(255, 0, 128, 0.3);
        }

        .service-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, #ff0080 0%, #00c8ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        /* Stats Section */
        .stats-card {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 200, 255, 0.2) 100%);
            border: 2px solid rgba(0, 255, 136, 0.4);
            border-radius: 24px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.4s ease;
        }

        .stats-card:hover {
            transform: translateY(-10px);
            border-color: rgba(0, 255, 136, 0.7);
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.4);
        }

        .stats-number {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stats-label {
            color: #cbd5e1;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* Testimonials */
        .testimonial-card {
            background: linear-gradient(135deg, rgba(255, 170, 0, 0.15) 0%, rgba(255, 0, 128, 0.15) 100%);
            border: 1px solid rgba(255, 170, 0, 0.3);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 170, 0, 0.6);
        }

        .testimonial-quote {
            font-size: 4rem;
            color: #ffaa00;
            line-height: 1;
        }

        /* Contact Section */
        .contact-card {
            background: linear-gradient(135deg, rgba(13, 27, 42, 0.8) 0%, rgba(27, 38, 59, 0.8) 100%);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s ease;
        }

        .contact-card:hover {
            border-color: rgba(0, 255, 136, 0.6);
            transform: translateY(-5px);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #0a0a0a;
            margin-bottom: 1rem;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.95) 0%, rgba(26, 10, 46, 0.95) 100%);
            border-top: 1px solid rgba(0, 255, 136, 0.3);
            padding: 4rem 0 2rem;
            color: #cbd5e1;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: #00ff88;
        }

        /* Battery Icon Animation */
        .battery-icon {
            font-size: 10rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 25%, #ff0080 50%, #ffaa00 75%, #00ff88 100%);
            background-size: 300% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: battery-float 4s ease-in-out infinite, battery-glow 3s ease-in-out infinite;
        }

        @keyframes battery-float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        @keyframes battery-glow {
            0%, 100% { filter: drop-shadow(0 0 30px rgba(0, 255, 136, 0.6)); }
            50% { filter: drop-shadow(0 0 50px rgba(0, 200, 255, 0.6)); }
        }

        /* Section Title */
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-subtitle {
            color: #94a3b8;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        /* Scroll Animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .battery-icon {
                font-size: 6rem;
            }
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Gradient Layer -->
    <div class="gradient-layer"></div>

    <!-- Animated Particles -->
    <div class="particles" id="particles"></div>

    <!-- Gradient Orbs -->
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="gradient-orb orb-3"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-lightning-charge-fill me-2"></i>
                YUSU POWER
            </a>
            <div class="ms-auto d-flex gap-3">
                <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-custom btn-sm d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary-custom btn-sm d-flex align-items-center gap-2">
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
                            <i class="bi bi-battery-charging me-2"></i>
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
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary-custom">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Login
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-custom">
                                <i class="bi bi-person-plus me-2"></i>
                                Register
                            </a>
                        </div>

                        <!-- Large Icon Buttons -->
                        <div class="d-flex gap-4 mt-5 justify-content-center justify-content-lg-start">
                            <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">
                                <div class="feature-card" style="width: 120px; padding: 1.5rem; text-align: center; cursor: pointer;">
                                    <i class="bi bi-box-arrow-in-right" style="font-size: 2.5rem; color: #00ff88;"></i>
                                    <p class="small mt-2 mb-0" style="color: #cbd5e1;">Login</p>
                                </div>
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">
                                <div class="feature-card" style="width: 120px; padding: 1.5rem; text-align: center; cursor: pointer;">
                                    <i class="bi bi-person-plus" style="font-size: 2.5rem; color: #00c8ff;"></i>
                                    <p class="small mt-2 mb-0" style="color: #cbd5e1;">Register</p>
                                </div>
                            </a>
                            <a href="<?php echo e(route('door.checkin')); ?>" class="text-decoration-none">
                                <div class="feature-card" style="width: 120px; padding: 1.5rem; text-align: center; cursor: pointer;">
                                    <i class="bi bi-door-open" style="font-size: 2.5rem; color: #ff0080;"></i>
                                    <p class="small mt-2 mb-0" style="color: #cbd5e1;">Check In</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <i class="bi bi-battery-charging battery-icon"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Why Choose Us?</h2>
                <p class="section-subtitle">Excellence in every battery solution we deliver</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card scroll-reveal">
                        <div class="feature-icon">
                            <i class="bi bi-lightning"></i>
                        </div>
                        <h3 class="feature-title">Advanced Technology</h3>
                        <p class="feature-text">
                            Cutting-edge battery solutions designed for maximum efficiency and 
                            performance in challenging environments.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card scroll-reveal">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="feature-title">Quality Assurance</h3>
                        <p class="feature-text">
                            Rigorous testing and quality control processes ensure every product 
                            meets international standards.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card scroll-reveal">
                        <div class="feature-icon">
                            <i class="bi bi-leaf"></i>
                        </div>
                        <h3 class="feature-title">Sustainable Solutions</h3>
                        <p class="feature-text">
                            Environmentally friendly battery technologies that minimize 
                            ecological impact while maximizing energy output.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Services</h2>
                <p class="section-subtitle">Comprehensive battery solutions for every need</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="service-card scroll-reveal">
                        <div class="service-icon">
                            <i class="bi bi-battery-full"></i>
                        </div>
                        <h4 class="feature-title">Battery Manufacturing</h4>
                        <p class="feature-text">Custom battery production for various applications</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card scroll-reveal">
                        <div class="service-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4 class="feature-title">Battery Testing</h4>
                        <p class="feature-text">Comprehensive testing and certification services</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card scroll-reveal">
                        <div class="service-icon">
                            <i class="bi bi-recycle"></i>
                        </div>
                        <h4 class="feature-title">Battery Recycling</h4>
                        <p class="feature-text">Eco-friendly recycling and disposal solutions</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card scroll-reveal">
                        <div class="service-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h4 class="feature-title">Technical Support</h4>
                        <p class="feature-text">24/7 expert support and maintenance services</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-card scroll-reveal">
                        <div class="stats-number">500+</div>
                        <div class="stats-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card scroll-reveal">
                        <div class="stats-number">50+</div>
                        <div class="stats-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card scroll-reveal">
                        <div class="stats-number">100%</div>
                        <div class="stats-label">Client Satisfaction</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card scroll-reveal">
                        <div class="stats-number">24/7</div>
                        <div class="stats-label">Support Available</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">What Our Clients Say</h2>
                <p class="section-subtitle">Trusted by industry leaders worldwide</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card scroll-reveal">
                        <div class="testimonial-quote">"</div>
                        <p class="feature-text mt-3">
                            YUSU POWER has transformed our energy systems with their innovative 
                            battery solutions. Exceptional quality and service.
                        </p>
                        <div class="mt-4">
                            <strong style="color: #ffaa00;">John Carter</strong>
                            <p class="small text-muted">CEO, TechCorp</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card scroll-reveal">
                        <div class="testimonial-quote">"</div>
                        <p class="feature-text mt-3">
                            The sustainability focus of YUSU POWER aligns perfectly with our 
                            environmental goals. Highly recommended!
                        </p>
                        <div class="mt-4">
                            <strong style="color: #ffaa00;">Sarah Mitchell</strong>
                            <p class="small text-muted">Director, GreenEnergy</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card scroll-reveal">
                        <div class="testimonial-quote">"</div>
                        <p class="feature-text mt-3">
                            Outstanding technical support and reliable products. YUSU POWER 
                            is our go-to partner for all battery needs.
                        </p>
                        <div class="mt-4">
                            <strong style="color: #ffaa00;">Michael Chen</strong>
                            <p class="small text-muted">CTO, InnovateLab</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-subtitle">We'd love to hear from you</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="contact-card scroll-reveal">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4 class="feature-title">Location</h4>
                        <p class="feature-text">Mountain View, Energy District</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card scroll-reveal">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h4 class="feature-title">Email</h4>
                        <p class="feature-text">info@yusupower.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card scroll-reveal">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h4 class="feature-title">Phone</h4>
                        <p class="feature-text">+254 700 000 000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="feature-card text-center py-5 scroll-reveal">
                <h2 class="feature-title mb-3" style="font-size: 2.5rem;">
                    Ready to Power Your Future?
                </h2>
                <p class="feature-text mb-4" style="font-size: 1.2rem;">
                    Join our team and be part of the battery technology revolution
                </p>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary-custom">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Apply Now
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="mb-3" style="color: #00ff88;">
                        <i class="bi bi-lightning-charge-fill me-2"></i>
                        YUSU POWER
                    </h4>
                    <p class="small">
                        Pioneering battery technology solutions for a sustainable future.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Home</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">About Us</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Services</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="footer-link fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="footer-link fs-4"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="footer-link fs-4"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="footer-link fs-4"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(34, 197, 94, 0.2);">
            <div class="text-center">
                <p class="mb-0">
                    © 2024 YUSU POWER MOUNTAIN SOLUTION LIMITED. All rights reserved.
                </p>
                <p class="mb-0 small">
                    <i class="bi bi-lightning-charge-fill me-1"></i>
                    Powering Tomorrow's Technology
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                
                // Random colors
                const colors = ['#00ff88', '#00c8ff', '#ff0080', '#ffaa00'];
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.boxShadow = `0 0 10px ${colors[Math.floor(Math.random() * colors.length)]}`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll reveal animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');
            
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const revealPoint = 150;
                
                if (elementTop < windowHeight - revealPoint) {
                    element.classList.add('active');
                }
            });
        }

        // Initialize
        createParticles();
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/welcome.blade.php ENDPATH**/ ?>