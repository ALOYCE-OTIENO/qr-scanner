<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
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

        /* Navbar */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--wecom-border);
            padding: 0.75rem 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            color: var(--wecom-green);
            font-size: 1.5rem;
        }

        /* Hero Section */
        .hero-section {
            min-height: calc(100vh - 65px);
            display: flex;
            align-items: center;
            padding: 4rem 0;
            background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
        }

        .hero-content {
            color: #333;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.25rem;
            background: var(--wecom-green-light);
            color: var(--wecom-green);
            font-weight: 500;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-radius: 4px;
        }

        .hero-badge i {
            margin-right: 0.5rem;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--wecom-gray);
            margin-bottom: 2rem;
            font-weight: 400;
            line-height: 1.7;
        }

        /* WeCom-style Buttons */
        .btn-wecom-primary {
            background: var(--wecom-green);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
            color: white;
            font-size: 0.95rem;
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
            font-size: 0.95rem;
        }

        .btn-wecom-outline:hover {
            background: var(--wecom-green-light);
            transform: translateY(-1px);
        }

        /* Feature Cards */
        .feature-card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 2rem;
            transition: all 0.2s ease;
            height: 100%;
        }

        .feature-card:hover {
            border-color: var(--wecom-green);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: var(--wecom-green-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.5rem;
            color: var(--wecom-green);
        }

        .feature-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }

        .feature-text {
            color: var(--wecom-gray);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Section Styling */
        .section {
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #333;
        }

        .section-subtitle {
            color: var(--wecom-gray);
            font-size: 1rem;
            margin-bottom: 2.5rem;
        }

        /* Stats Section */
        .stats-card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.2s ease;
        }

        .stats-card:hover {
            border-color: var(--wecom-green);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--wecom-green);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--wecom-gray);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Contact Section */
        .contact-card {
            background: #ffffff;
            border: 1px solid var(--wecom-border);
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.2s ease;
        }

        .contact-card:hover {
            border-color: var(--wecom-green);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .contact-icon {
            width: 48px;
            height: 48px;
            background: var(--wecom-green-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--wecom-green);
            margin-bottom: 1rem;
        }

        .contact-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .contact-text {
            color: var(--wecom-gray);
            font-size: 0.9rem;
        }

        /* Footer */
        .footer {
            background: #ffffff;
            border-top: 1px solid var(--wecom-border);
            padding: 3rem 0 2rem;
            color: var(--wecom-gray);
        }

        .footer-link {
            color: var(--wecom-gray);
            text-decoration: none;
            transition: 0.2s;
            font-size: 0.9rem;
        }

        .footer-link:hover {
            color: var(--wecom-green);
        }

        .footer h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-chat-dots-fill"></i>
                YUSU POWER
            </a>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-wecom-outline d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-wecom-primary d-flex align-items-center gap-2">
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
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('login') }}" class="btn btn-wecom-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-wecom-outline">
                                <i class="bi bi-person-plus me-2"></i>
                                Register
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <i class="bi bi-battery-charging" style="font-size: 12rem; color: var(--wecom-green);"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Why Choose Us?</h2>
                <p class="section-subtitle">Excellence in every battery solution we deliver</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
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
                    <div class="feature-card">
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
                    <div class="feature-card">
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

    <!-- Stats Section -->
    <section class="section" style="background: var(--wecom-gray-light);">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">500+</div>
                        <div class="stats-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">50+</div>
                        <div class="stats-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">100%</div>
                        <div class="stats-label">Client Satisfaction</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">24/7</div>
                        <div class="stats-label">Support Available</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-subtitle">We'd love to hear from you</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4 class="contact-title">Location</h4>
                        <p class="contact-text">Mountain View, Energy District</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h4 class="contact-title">Email</h4>
                        <p class="contact-text">info@yusupower.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h4 class="contact-title">Phone</h4>
                        <p class="contact-text">+254 700 000 000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section">
        <div class="container">
            <div class="feature-card text-center py-5">
                <h2 class="feature-title mb-3" style="font-size: 2rem;">
                    Ready to Power Your Future?
                </h2>
                <p class="feature-text mb-4" style="font-size: 1.1rem;">
                    Join our team and be part of the battery technology revolution
                </p>
                <a href="{{ route('register') }}" class="btn btn-wecom-primary">
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
                    <h5 class="mb-3">
                        <i class="bi bi-chat-dots-fill me-2" style="color: var(--wecom-green);"></i>
                        YUSU POWER
                    </h5>
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
            <hr class="my-4" style="border-color: var(--wecom-border);">
            <div class="text-center">
                <p class="mb-0">
                    © 2024 YUSU POWER MOUNTAIN SOLUTION LIMITED. All rights reserved.
                </p>
                <p class="mb-0 small">
                    <i class="bi bi-lightning-charge-fill me-1" style="color: var(--wecom-green);"></i>
                    Powering Tomorrow's Technology
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
