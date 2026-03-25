<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Mantenimiento</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .message {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 48px 72px;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            position: relative;
            overflow: hidden;
        }

        .icon {
            width: 80px;
            height: 80px;
            margin-bottom: 24px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .message h1 {
            font-size: 2.8rem;
            color: #db0808;
            margin-bottom: 16px;
            letter-spacing: 1px;
        }

        .message p {
            font-size: 1.25rem;
            color: #475569;
            margin-bottom: 0;
        }

        .ribbon {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 12px;
            background: linear-gradient(90deg, #db0808 0%, #db0808 100%);
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
    </style>
</head>

<body>
    <div class="message">
        <div class="ribbon"></div>
        <svg class="icon" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="32" cy="32" r="30" stroke="#db0808" stroke-width="4" fill="#fef9c3" />
            <path d="M32 18v16" stroke="#db0808" stroke-width="4" stroke-linecap="round" />
            <circle cx="32" cy="44" r="3" fill="#db0808" />
        </svg>
        <h1>PÁGINA EN DESARROLLO</h1>
        <p>Estamos trabajando en terminar la página web.<br>¡Muy pronto estará disponible!</p>
    </div>
</body>

</html>
