<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Tracking System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .welcome-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        }

        .image-section {
            flex: 1;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 64, 175, 0.8)), url("welcome.jpg") center/cover;
            position: relative;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            color: #ffffff;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            pointer-events: none;
        }

        .image-content {
            position: relative;
            z-index: 1;
        }

        .image-content .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .image-content .logo i {
            font-size: 48px;
            color: #3b82f6;
        }

        .image-content .logo h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
        }

        .image-content h2 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .image-content p {
            font-size: 18px;
            line-height: 1.8;
            opacity: 0.95;
            margin-bottom: 30px;
        }

        .features {
            list-style: none;
            padding: 0;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .features li i {
            color: #10b981;
            font-size: 20px;
        }

        .auth-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 50px;
            background: #ffffff;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .auth-card h3 {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .auth-card p {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 40px;
        }

        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn-custom {
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.5);
            color: #fff;
        }

        .btn-register {
            background: #ffffff;
            color: #2563eb;
            border: 2px solid #2563eb;
        }

        .btn-register:hover {
            background: #2563eb;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        }

        .divider {
            margin: 30px 0;
            color: #cbd5e1;
            font-size: 14px;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #e5e7eb;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        @media (max-width: 968px) {
            .welcome-container {
                flex-direction: column;
            }

            .image-section {
                min-height: 300px;
                padding: 40px 30px;
            }

            .image-content h2 {
                font-size: 32px;
            }

            .image-content p {
                font-size: 16px;
            }

            .auth-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 576px) {
            .btn-group-custom {
                gap: 12px;
            }

            .btn-custom {
                padding: 14px 24px;
                font-size: 15px;
            }

            .auth-card h3 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>

<div class="welcome-container">
    <div class="image-section">
        <div class="image-content">
            <div class="logo">
                <i class="bi bi-fuel-pump-fill"></i>
                <h1>Petrol Station</h1>
            </div>
            <h2>Professional Fuel Sales Management</h2>
            <p>Comprehensive tracking, reporting, and analytics system designed for modern petrol stations.</p>
            
            <ul class="features">
                <li><i class="bi bi-check-circle-fill"></i> Real-time sales monitoring</li>
                <li><i class="bi bi-check-circle-fill"></i> Shift management & tracking</li>
                <li><i class="bi bi-check-circle-fill"></i> Stock level alerts</li>
                <li><i class="bi bi-check-circle-fill"></i> Government CAP price integration</li>
                <li><i class="bi bi-check-circle-fill"></i> Comprehensive reporting</li>
            </ul>
        </div>
    </div>

    <div class="auth-section">
        <div class="auth-card">
            <h3>Welcome Back</h3>
            <p>Access your sales tracking dashboard</p>

            <div class="btn-group-custom">
                <a href="{{ route('login') }}" class="btn-custom btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login to Dashboard
                </a>
                <a href="{{ route('register') }}" class="btn-custom btn-register">
                    <i class="bi bi-person-plus"></i>
                    Create New Account
                </a>
            </div>

            <div class="divider">or</div>

            <p style="font-size: 14px; color: #94a3b8; margin-top: 20px;">
                Secure access for administrators and attendants
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
