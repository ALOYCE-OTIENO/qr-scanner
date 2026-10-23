<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Door Check-In - YUSU POWER MOUNTAIN SOLUTION LIMITED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode"></script>
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

        /* Check-in Card */
        .checkin-card {
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

        .checkin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #00ff88, #00c8ff, #ff0080);
        }

        .checkin-icon {
            font-size: 5rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 1rem;
            animation: icon-float 3s ease-in-out infinite;
        }

        @keyframes icon-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .checkin-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .checkin-subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 2rem;
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

        /* Button */
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

        /* QR Code Info */
        .qr-info {
            background: rgba(0, 255, 136, 0.1);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .qr-info p {
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .qr-info small {
            color: #94a3b8;
        }

        /* Scanner */
        #reader {
            width: 100%;
            max-width: 400px;
            margin: 0 auto 1.5rem;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid rgba(0, 255, 136, 0.3);
        }

        #reader video {
            width: 100%;
            border-radius: 14px;
        }

        .scan-container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .scan-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 10;
        }

        .scan-btn {
            background: linear-gradient(135deg, #ff0080 0%, #ffaa00 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.4s ease;
            cursor: pointer;
            width: 100%;
        }

        .scan-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 0, 128, 0.5);
        }

        .scan-btn.active {
            background: linear-gradient(135deg, #ffaa00 0%, #ff0080 100%);
        }

        .qr-scanned {
            background: rgba(0, 255, 136, 0.2);
            border: 2px solid rgba(0, 255, 136, 0.5);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .qr-scanned p {
            color: #00ff88;
            margin: 0;
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

    <!-- Back Link -->
    <a href="/" class="back-link">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="checkin-card">
        <div class="checkin-icon">
            <i class="bi bi-door-open"></i>
        </div>
        <h2 class="checkin-title">Door Check-In</h2>
        <p class="checkin-subtitle">Scan the company gate QR code and enter your employee ID</p>
        
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="qr-info">
            <p><i class="bi bi-info-circle me-2" style="color: #00ff88;"></i><strong>Instructions:</strong></p>
            <small>1. Scan the QR code displayed at the company entrance</small><br>
            <small>2. Enter your Employee ID (e.g., EMP001, EMP002, etc.)</small><br>
            <small>3. Click Check In/Check Out to record your attendance</small>
        </div>

        <!-- QR Scanner -->
        <div class="scan-container">
            <div id="reader"></div>
            <div class="text-center mt-3">
                <button type="button" class="scan-btn" id="startScanBtn" onclick="startScanner()">
                    <i class="bi bi-camera me-2"></i> Start Camera Scanner
                </button>
            </div>
        </div>

        <div id="qrScanned" class="qr-scanned" style="display: none;">
            <p><i class="bi bi-check-circle me-2"></i>QR Code Scanned Successfully!</p>
        </div>
        
        <form method="POST" action="{{ route('door.checkin.post') }}">
            @csrf
            <div class="mb-3">
                <label for="qr_data" class="form-label">Door QR Code Data</label>
                <input type="text" class="form-control" id="qr_data" name="qr_data" placeholder="Scan door QR code or enter manually" required>
                <small class="text-muted" style="color: #64748b;">Scan with camera above or enter manually</small>
            </div>
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee ID</label>
                <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter your employee ID (e.g., EMP001)" required>
            </div>
            <button type="submit" class="btn btn-primary-custom">
                <i class="bi bi-box-arrow-in-right me-2"></i> Check In / Check Out
            </button>
        </form>
        
        <div class="text-center mt-4">
            <a href="/login" style="color: #94a3b8; text-decoration: none;">Need to login?</a>
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

        // QR Scanner
        let html5QrcodeScanner = null;

        function startScanner() {
            const reader = document.getElementById('reader');
            const startBtn = document.getElementById('startScanBtn');
            
            html5QrcodeScanner = new Html5Qrcode("reader", {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                aspectRatio: 1.0
            });

            html5QrcodeScanner.start(
                { facingMode: "environment" },
                {
                    success: (decodedText, decodedResult) => {
                        document.getElementById('qr_data').value = decodedText;
                        document.getElementById('qrScanned').style.display = 'block';
                        html5QrcodeScanner.stop();
                        startBtn.innerHTML = '<i class="bi bi-camera me-2"></i> Scan Again';
                        startBtn.classList.remove('active');
                    },
                    failure: (error) => {
                        console.error('Scanning failed:', error);
                    }
                }
            ).then(() => {
                startBtn.innerHTML = '<i class="bi bi-stop-circle me-2"></i> Stop Scanner';
                startBtn.classList.add('active');
            }).catch((err) => {
                console.error('Camera error:', err);
                alert('Unable to access camera. Please ensure you have granted camera permissions.');
            });
        }

        function stopScanner() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(() => {
                    const startBtn = document.getElementById('startScanBtn');
                    startBtn.innerHTML = '<i class="bi bi-camera me-2"></i> Start Camera Scanner';
                    startBtn.classList.remove('active');
                });
            }
        }

        // Toggle scanner
        document.getElementById('startScanBtn').addEventListener('click', function() {
            if (this.classList.contains('active')) {
                stopScanner();
            } else {
                startScanner();
            }
        });

        createParticles();
    </script>
</body>
</html>
