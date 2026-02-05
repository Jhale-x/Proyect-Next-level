<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Level - Portal Educativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* División de colores con animación */
        .split-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            z-index: 0;
        }

        .split-left {
            width: 50%;
            background: #0F2749;
            position: relative;
            overflow: hidden;
        }

        .split-right {
            width: 50%;
            background: #B01030;
            position: relative;
            overflow: hidden;
        }

        /* Efectos decorativos animados */
        .split-left::before,
        .split-right::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: float 8s ease-in-out infinite;
        }

        .split-left::before {
            top: -100px;
            left: -100px;
        }

        .split-right::before {
            bottom: -100px;
            right: -100px;
            animation-delay: 1s;
        }

        .split-left::after,
        .split-right::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            animation: float 10s ease-in-out infinite reverse;
        }

        .split-left::after {
            bottom: -50px;
            right: -50px;
            animation-delay: 0.5s;
        }

        .split-right::after {
            top: -50px;
            left: -50px;
            animation-delay: 1.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.1);
            }
        }

        /* Contenedor principal */
        .container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px 20px;
            justify-content: center;
        }

        /* Título Portal Educativo */
        .portal-title {
            text-align: center;
            margin-bottom: 60px;
            animation: fadeInDown 1s ease-out;
        }

        .portal-title h1 {
            font-size: 56px;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .portal-title p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Contenedor de cards */
        .cards-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            width: 100%;
            flex: 1;
            align-items: center;
        }

        /* Tarjetas (Cards) */
        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }

        .card.colegio {
            margin: 0 auto;
            animation-delay: 0.3s;
        }

        .card.academia {
            margin: 0 auto;
            animation-delay: 0.5s;
        }

        .card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: fadeInScale 1s ease-out;
            animation-fill-mode: both;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .card:hover::before {
            opacity: 1;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(50px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
        }

        .card-image {
            width: 100%;
            height: 180px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border-bottom: 1px solid #e0e0e0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .card.colegio .card-image {
            background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80');
        }

        .card.academia .card-image {
            background-image: url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&q=80');
        }

        .card-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .card-content {
            padding: 30px;
            position: relative;
        }

        .card-badge {
            display: inline-block;
            background: linear-gradient(135deg, #0F2749 0%, #1a4d8f 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .card.academia .card-badge {
            background: linear-gradient(135deg, #B01030 0%, #dc3a5a 100%);
        }

        .card-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .card-description {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #0F2749 0%, #1a4d8f 100%);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(15, 39, 73, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(15, 39, 73, 0.6);
        }

        .btn:active {
            transform: translateY(0);
        }

        .card.academia .btn {
            background: linear-gradient(135deg, #B01030 0%, #dc3a5a 100%);
            box-shadow: 0 4px 15px rgba(176, 16, 48, 0.4);
        }

        .card.academia .btn:hover {
            box-shadow: 0 6px 25px rgba(176, 16, 48, 0.6);
        }

        /* Línea divisoria central decorativa */
        .divider {
            position: fixed;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    rgba(255, 255, 255, 0.3) 20%,
                    rgba(255, 255, 255, 0.5) 50%,
                    rgba(255, 255, 255, 0.3) 80%,
                    transparent 100%);
            transform: translateX(-50%);
            z-index: 2;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .cards-container {
                grid-template-columns: 1fr;
                gap: 50px;
                padding: 0 30px;
            }

            .portal-title h1 {
                font-size: 42px;
            }

            .card-title {
                font-size: 36px;
            }

            .split-left,
            .split-right {
                width: 100%;
            }

            .split-right {
                display: none;
            }

            .divider {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .portal-title h1 {
                font-size: 36px;
            }

            .portal-title p {
                font-size: 16px;
            }

            .cards-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .card {
                padding: 40px 30px;
            }

            .card-title {
                font-size: 32px;
            }

            .card-icon {
                width: 80px;
                height: 80px;
                font-size: 40px;
            }
        }
    </style>
</head>

<body>
    <!-- División de fondos con colores -->
    <div class="split-background">
        <div class="split-left"></div>
        <div class="split-right"></div>
    </div>

    <!-- Línea divisoria central -->
    <div class="divider"></div>

    <div class="container">
        <!-- Título Portal Educativo -->
        <div class="portal-title">
            <h1>Portal Educativo</h1>
            <p>Selecciona tu plataforma de aprendizaje</p>
        </div>

        <div class="cards-container">
            <!-- Card Colegio -->
            <div class="card colegio">
                <div class="card-image"></div>
                <div class="card-content">
                    <span class="card-badge">Educación Escolar</span>
                    <h2 class="card-title">Colegio</h2>
                    <p class="card-description">
                        Accede al portal educativo para estudiantes de nivel escolar. Consulta tus notas,
                        horarios y tareas.
                    </p>
                    <a href="#" class="btn">
                        Ingresar
                    </a>
                </div>
            </div>

            <!-- Card Academia -->
            <div class="card academia">
                <div class="card-image"></div>
                <div class="card-content">
                    <span class="card-badge">Preparación Universitaria</span>
                    <h2 class="card-title">Academia</h2>
                    <p class="card-description">
                        Portal para estudiantes preuniversitarios. Accede a tus simulacros, clases y
                        material de estudio.
                    </p>
                    <a href="#" class="btn">
                        Ingresar
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
