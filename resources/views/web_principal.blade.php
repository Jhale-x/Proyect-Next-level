<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Level - Centro Educativo</title>
    <style>
        :root {
            --rojo-principal: #DC143C;
            --rojo-oscuro: #B01030;
            --azul-noche: #1B3A6B;
            --azul-oscuro: #0F2749;
            --blanco: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--blanco);
            overflow-x: hidden;
        }

        /* Barra de contacto superior */
        .contact-bar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: var(--blanco);
            padding: 8px 0;
            font-size: 14px;
        }

        .contact-bar-container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--blanco);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item:hover {
            color: var(--rojo-principal);
        }

        .contact-item svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        /* Navegación principal */
        .main-nav {
            background: linear-gradient(135deg, var(--azul-noche) 0%, var(--azul-oscuro) 100%);
            box-shadow: 0 4px 20px rgba(15, 39, 73, 0.4);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0;
        }

        .nav-menu li a {
            color: var(--blanco);
            text-decoration: none;
            padding: 18px 28px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: block;
            position: relative;
            border-bottom: 3px solid transparent;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--rojo-principal);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-menu li a:hover::after,
        .nav-menu li a.active::after {
            width: 80%;
        }

        .nav-menu li a:hover,
        .nav-menu li a.active {
            background: rgba(220, 20, 60, 0.1);
            color: var(--blanco);
        }

        /* Hero Section */
        .hero-section {
            background:

                url('/images/img2.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: scroll;
            padding: 80px 10px 150px;
            text-align: center;
            color: var(--blanco);
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
            background: radial-gradient(circle at center, transparent 0%, rgba(15, 39, 73, 0.4) 100%);
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            animation: fadeInUp 1.2s ease-out;
            padding-left: 50%;
            text-align: right;
        }

        .hero-content .subtitle {
            font-size: 70px;
            font-weight: 800;
            margin-bottom: 30px;
            color: var(--blanco);
            text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.7);
            letter-spacing: 2px;
            line-height: 1.3;
        }

        .hero-content .description {
            font-size: 24px;
            margin-bottom: 40px;
            color: var(--blanco);
            font-weight: 400;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        }

        .cta-button {
            display: inline-block;
            padding: 18px 45px;
            background: linear-gradient(135deg, var(--rojo-principal), var(--rojo-oscuro));
            color: var(--blanco);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(220, 20, 60, 0.5);
            border: 2px solid var(--blanco);
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(220, 20, 60, 0.7);
            background: linear-gradient(135deg, var(--rojo-oscuro), var(--rojo-principal));
        }

        /* Sección de Valores */
        .valores-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, var(--azul-noche) 0%, var(--azul-oscuro) 100%);
            color: var(--blanco);
        }

        .valores-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 45px;
            font-weight: 800;
            color: var(--blanco);
            margin-bottom: 60px;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 120px;
            height: 5px;
            background: var(--rojo-principal);
            margin: 20px auto 0;
            border-radius: 3px;
        }

        .valores-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .valor-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            border: 2px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .valor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--rojo-principal);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .valor-card:hover::before {
            transform: scaleX(1);
        }

        .valor-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--rojo-principal);
        }

        .valor-icon {
            font-size: 60px;
            margin-bottom: 20px;
            color: var(--rojo-principal);
        }

        .valor-card h3 {
            font-size: 26px;
            font-weight: 700;
            color: var(--blanco);
            margin-bottom: 15px;
        }

        .valor-card p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            font-size: 16px;
        }

        /* Sección de Información */
        .info-section {
            padding: 80px 20px;
            background: var(--blanco);
        }

        .info-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title-dark {
            text-align: center;
            font-size: 45px;
            font-weight: 800;
            color: var(--azul-noche);
            margin-bottom: 60px;
            position: relative;
        }

        .section-title-dark::after {
            content: '';
            display: block;
            width: 120px;
            height: 5px;
            background: var(--rojo-principal);
            margin: 20px auto 0;
            border-radius: 3px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }

        .info-card {
            background: linear-gradient(135deg, var(--azul-noche), var(--azul-oscuro));
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(27, 58, 107, 0.3);
            border: 2px solid transparent;
            color: var(--blanco);
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(220, 20, 60, 0.4);
            border-color: var(--rojo-principal);
        }

        .info-number {
            font-size: 50px;
            font-weight: 800;
            color: var(--rojo-principal);
            margin-bottom: 15px;
        }

        .info-card h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .info-card p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--azul-oscuro) 0%, var(--azul-noche) 100%);
            color: var(--blanco);
            padding: 40px 20px;
            text-align: center;
            border-top: 4px solid var(--rojo-principal);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .footer-social {
            margin-top: 20px;
        }

        .social-link {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background: var(--rojo-principal);
            color: var(--blanco);
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .social-link:hover {
            background: var(--rojo-oscuro);
            transform: translateY(-3px);
        }

        /* Animaciones */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .top-bar-container h1 {
                font-size: 32px;
                letter-spacing: 2px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-menu li a {
                padding: 12px 18px;
                font-size: 14px;
            }

            .hero-content .subtitle {
                font-size: 32px;
            }

            .hero-content .description {
                font-size: 18px;
            }

            .section-title,
            .section-title-dark {
                font-size: 32px;
            }

            .valores-grid,
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="contact-bar">
        <div class="contact-bar-container">
            <a href="tel:+51923377626" class="contact-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
                </svg>
                923 377 626
            </a>
            <a href="mailto:contacto@nextlevel.edu.pe" class="contact-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                </svg>
                contacto@nextlevel.edu.pe
            </a>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="#" class="active">INICIO</a></li>
                <li><a href="#">NOSOTROS</a></li>
                <li><a href="#">NIVELES</a></li>
                <li><a href="#">UBICACIÓN</a></li>
                <li><a href="#">MATRICULAS</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="/intranet">PORTAL ACADÉMICO</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <p class="subtitle">Elevando la Educación al Siguiente Nivel</p>
            <p class="description">Formando líderes del mañana con excelencia, valores y compromiso</p>
        </div>
    </section>

    <section class="valores-section">
        <div class="valores-container">
            <h2 class="section-title">Nuestros Valores</h2>
            <div class="valores-grid">
                <div class="valor-card">
                    <div class="valor-icon">🎓</div>
                    <h3>Excelencia Académica</h3>
                    <p>Compromiso con la calidad educativa y el desarrollo integral de nuestros
                        estudiantes</p>
                </div>
                <div class="valor-card">
                    <div class="valor-icon">💡</div>
                    <h3>Innovación</h3>
                    <p>Métodos educativos modernos y tecnología de vanguardia para el aprendizaje</p>
                </div>
                <div class="valor-card">
                    <div class="valor-icon">🤝</div>
                    <h3>Valores Humanos</h3>
                    <p>Formación en ética,
                        respeto y responsabilidad social</p>
                </div>
            </div>
        </div>
    </section>
    < !-- Sección de Información -->
        <section class="info-section">
            <div class="info-container">
                <h2 class="section-title-dark">¿Por Qué Elegirnos?</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-number">15+</div>
                        <h3>Años de Experiencia</h3>
                        <p>Trayectoria consolidada en educación de calidad</p>
                    </div>
                    <div class="info-card">
                        <div class="info-number">98%</div>
                        <h3>Tasa de Éxito</h3>
                        <p>Estudiantes que alcanzan sus metas académicas</p>
                    </div>
                    <div class="info-card">
                        <div class="info-number">50+</div>
                        <h3>Profesores Calificados</h3>
                        <p>Equipo docente comprometido y especializado</p>
                    </div>
                </div>
            </div>
        </section>
        < !-- Footer -->
            <footer class="footer">
                <div class="footer-content">
                    <p><strong>Colegio y Academia NEXT LEVEL</strong></p>
                    <p>Educación en el Próximo Nivel</p>
                    <p>📍 Carretera Federico Basadre Km. 6 (Al costado de la UNU)</p>
                    <p>📞 Más información: 923 317 626</p>
                    <div class="footer-social"><a href="#" class="social-link">Facebook</a><a href="#"
                            class="social-link">WhatsApp</a><a href="#" class="social-link">Instagram</a></div>
                    <p style="margin-top: 30px; opacity: 0.7;">© 2026 Next Level. Todos los derechos
                        reservados.</p>
                </div>
            </footer>
</body>

</html>
