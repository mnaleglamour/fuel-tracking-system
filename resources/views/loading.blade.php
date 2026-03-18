<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading | Petrol Station Sales System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        .loader-wrap {
            text-align: center;
            animation: fadeIn 0.8s ease forwards;
        }

        .logo-icon {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 8px 32px rgba(37,99,235,0.4);
        }

        .logo-icon svg {
            width: 38px;
            height: 38px;
            color: #fff;
        }

        h1 {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        p {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 36px;
        }

        .dots {
            display: inline-flex;
            gap: 10px;
        }

        .dots span {
            width: 12px;
            height: 12px;
            background: #2563eb;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .dots span:nth-child(1) { animation-delay: -0.32s; }
        .dots span:nth-child(2) { animation-delay: -0.16s; background: #10b981; }
        .dots span:nth-child(3) { animation-delay: 0s; background: #f59e0b; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); opacity: 0.4; }
            40% { transform: scale(1); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        setTimeout(function () {
            window.location.href = "{{ route('welcome') }}";
        }, 3000);
    </script>
</head>
<body>
    <div class="loader-wrap">
        <div class="logo-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 22V8l9-6 9 6v14H3z"/>
                <rect x="9" y="14" width="6" height="8"/>
                <line x1="12" y1="6" x2="12" y2="10"/>
            </svg>
        </div>
        <h1>FuelTrack</h1>
        <p>Petrol Station Sales System</p>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</body>
</html>
