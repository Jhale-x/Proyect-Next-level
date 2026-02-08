<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Level - Centro Educativo</title>
    <style>
        /* Fuentes del sitio */
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&family=Montserrat:wght@600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap');

        /* Variables globales de color */
        :root {
            --rojo-principal: #DC143C;
            --rojo-oscuro: #B01030;
            --azul-noche: #1B3A6B;
            --azul-oscuro: #0F2749;
            --blanco: #FFFFFF;
            --texto-oscuro: #0E1A2B;
        }

        /* Reset base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0b1c32;
            color: var(--texto-oscuro);
            overflow-x: hidden;
            min-height: 100vh;
        }

        h2,
        h3 {
            font-family: 'Playfair Display', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Capa visual sobre todo el sitio */
        .page-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 20, 35, 0.28) 0%, rgba(10, 20, 35, 0.1) 55%, rgba(10, 20, 35, 0.35) 100%);
            pointer-events: none;
            z-index: 1;
        }

        /* Barra de contacto superior */
        .contact-bar {
            background: linear-gradient(135deg, #1d4064 0%, #1b354f 100%);
            color: var(--blanco);
            padding: 6px 0;
            font-size: 14px;
            position: relative;
            z-index: 2;
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
            background: linear-gradient(135deg, rgba(8, 35, 74, 0.95) 0%, rgba(9, 48, 96, 0.9) 100%);
            box-shadow: 0 4px 20px rgba(15, 39, 73, 0.4);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(6px);
        }

        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            padding: 0 10px 0 0;
            gap: 20px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--blanco);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            white-space: nowrap;
            margin-left: -80px;
        }

        .brand-logo img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 22px;
            margin: 0;
            align-items: center;
            justify-content: center;
        }

        .nav-menu li a {
            color: var(--blanco);
            text-decoration: none;
            padding: 18px 22px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            transition: color 0.3s ease;
            display: block;
            position: relative;
            border-bottom: 3px solid transparent;
            letter-spacing: 0.8px;
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
            color: var(--blanco);
        }

        /* Hero principal con carrusel */
        .hero-section {

            padding: 90px 10px 160px;
            min-height: 90vh;
            text-align: center;
            color: var(--blanco);
            position: relative;
            overflow: hidden;
        }

        /* Contenedor de slides */
        .hero-slider {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        /* Slide individual */
        .hero-slide {
            position: absolute;
            inset: 0;
            background-position: center bottom;
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.2s ease;
            transform: scale(1.02);
        }

        .hero-slide--chica {
            background-position: center 75%;
        }

        .hero-slide--profes {
            background-size: 115% auto;
        }

        .hero-slide.is-active {
            opacity: 1;
        }

        .hero-controls {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 2;
            pointer-events: none;
        }

        .hero-control {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.6);
            background: rgba(12, 26, 48, 0.55);
            color: var(--blanco);
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s ease, border-color 0.3s ease;
            pointer-events: auto;
        }

        .hero-control:hover {
            transform: scale(1.05);
            background: rgba(220, 20, 60, 0.7);
            border-color: rgba(220, 20, 60, 0.8);
        }

        /* Brillo suave sobre el hero */
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0));
            mix-blend-mode: screen;
        }

        .hero-captions {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            width: 100%;
            opacity: 0;
            transition: opacity 0.6s ease;
            pointer-events: none;
        }

        .hero-captions.is-visible {
            opacity: 1;
            pointer-events: auto;
        }

        .hero-captions-right {
            position: absolute;
            top: 50%;
            right: 6%;
            transform: translateY(-50%);
            max-width: 520px;
            text-align: right;
        }

        .hero-captions-right .hero-content {
            margin: 0;
            text-align: right;
        }

        .hero-captions-right .subtitle,
        .hero-captions-right .description {
            color: #0f2749;
            text-shadow: 0 3px 10px rgba(255, 255, 255, 0.6);
        }

        .hero-content {
            max-width: 980px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .hero-content .subtitle {
            font-family: 'Montserrat', 'Manrope', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 64px;
            font-weight: 900;
            margin: 0 auto 12px;
            color: var(--blanco);
            text-shadow: 0 6px 14px rgba(0, 0, 0, 0.55);
            letter-spacing: 0.4px;
            line-height: 1.1;
            max-width: 980px;
            text-align: center;
        }

        .hero-content .description {
            font-family: 'Montserrat', 'Manrope', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 20px;
            margin: 0 auto 38px;
            color: var(--blanco);
            font-weight: 500;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
            letter-spacing: 0.2px;
            max-width: 820px;
            text-align: center;
        }

        /* Sección de Valores */
        .valores-section {
            padding: 80px 20px;
            background: rgba(8, 20, 38, 0.6);
            color: var(--blanco);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(6px);
            margin-top: 0;
        }

        .valores-section::before {
            content: '';
            position: absolute;
            top: -120px;
            left: -120px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
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
            background: rgba(8, 20, 38, 0.9);
            color: var(--blanco);
            padding: 40px 20px;
            text-align: center;
            border-top: 4px solid var(--rojo-principal);
            backdrop-filter: blur(6px);
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

        /* Animacion de entrada al hacer scroll */
        .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition: all 0.8s ease;
        }

        .reveal.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* Boton flotante de regreso arriba */
        .scroll-top {
            position: fixed;
            right: 24px;
            bottom: 24px;
            background: var(--azul-noche);
            color: var(--blanco);
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            box-shadow: 0 10px 20px rgba(15, 39, 73, 0.35);
            cursor: pointer;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 5;
        }

        .scroll-top.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .nav-container {
                padding: 10px 20px;
                gap: 12px;
            }

            .brand-logo {
                margin-left: 0;
            }

            .hero-content .subtitle {
                font-size: 52px;
            }

            .hero-content .description {
                font-size: 18px;
            }
        }

        @media (max-width: 992px) {
            .hero-section {
                padding: 80px 16px 140px;
                min-height: 80vh;
            }

            .nav-menu {
                flex-wrap: wrap;
                gap: 10px;
            }

            .nav-menu li a {
                padding: 12px 14px;
                font-size: 13px;
            }

            .hero-captions-right {
                position: relative;
                top: auto;
                right: auto;
                transform: none;
                margin: 0 auto;
                text-align: center;
                max-width: 720px;
            }

            .hero-captions-right .hero-content {
                text-align: center;
            }

            .hero-captions-right .subtitle,
            .hero-captions-right .description {
                color: var(--blanco);
                text-shadow: 0 6px 14px rgba(0, 0, 0, 0.55);
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-menu li a {
                padding: 12px 18px;
                font-size: 14px;
            }

            .hero-content .subtitle {
                font-size: 36px;
                line-height: 1.15;
            }

            .hero-content .description {
                font-size: 15px;
            }

            .hero-controls {
                padding: 0 16px;
            }

            .hero-control {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .nav-container {
                grid-template-columns: 1fr;
                justify-items: center;
                padding: 5px 16px;
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

        @media (max-width: 480px) {
            .contact-bar-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                padding: 6px 16px;
            }

            .hero-section {
                padding: 70px 14px 120px;
                min-height: 75vh;
            }

            .hero-content .subtitle {
                font-size: 30px;
            }

            .hero-content .description {
                font-size: 14px;
            }

            .hero-control {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .section-title,
            .section-title-dark {
                font-size: 28px;
            }

        }
    </style>
</head>

<body>
    <!-- Overlay decorativo global -->
    <div class="page-overlay"></div>
    <!-- Barra superior de contacto -->
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

    <!-- Navegacion principal -->
    <nav class="main-nav">
        <div class="nav-container">
            <div class="brand-logo">
                <img src="/images/next-level-logo.png" alt="Logo Next Level">
                <span>NEXT LEVEL</span>
            </div>
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

    <!-- Hero con carrusel de imagenes -->
    <section class="hero-section">
        <div class="hero-slider" aria-hidden="true">
            <div class="hero-slide is-active" style="background-image: url('/images/escuela2.jpeg');"
                data-caption="escuela"></div>
            <div class="hero-slide hero-slide--chica" style="background-image: url('/images/chica.jpeg');"
                data-caption="chica"></div>
            <div class="hero-slide hero-slide--profes" style="background-image: url('/images/profes.jpeg');"
                data-caption="profes"></div>
        </div>
        <div class="hero-controls" aria-label="Controles del carrusel">
            <button class="hero-control hero-prev" type="button" aria-label="Imagen anterior">&#8249;</button>
            <button class="hero-control hero-next" type="button" aria-label="Imagen siguiente">&#8250;</button>
        </div>
        <div class="hero-captions" data-caption="escuela">
            <div class="hero-content">
                <p class="subtitle">Elevando la Educación al Siguiente Nivel</p>
                <p class="description">Formando líderes del mañana con excelencia, valores y compromiso</p>
            </div>
        </div>
        <div class="hero-captions hero-captions-right" data-caption="profes">
            <div class="hero-content">
                <p class="subtitle">Docentes que Inspiran</p>
                <p class="description">Equipo humano comprometido con tu crecimiento y tu futuro</p>
            </div>
        </div>
        <div class="hero-captions" data-caption="chica">
            <div class="hero-content">
                <p class="subtitle">Tu historia empieza hoy</p>
                <p class="description">Acompañamos cada sueño con educación de calidad</p>
            </div>
        </div>
    </section>

    <!-- Valores institucionales -->
    <section class="valores-section" id="valores">
        <div class="valores-container">
            <h2 class="section-title reveal">Nuestros Valores</h2>
            <div class="valores-grid">
                <div class="valor-card reveal">
                    <div class="valor-icon">🎓</div>
                    <h3>Excelencia Académica</h3>
                    <p>Compromiso con la calidad educativa y el desarrollo integral de nuestros
                        estudiantes</p>
                </div>
                <div class="valor-card reveal">
                    <div class="valor-icon">💡</div>
                    <h3>Innovación</h3>
                    <p>Métodos educativos modernos y tecnología de vanguardia para el aprendizaje</p>
                </div>
                <div class="valor-card reveal">
                    <div class="valor-icon">🤝</div>
                    <h3>Valores Humanos</h3>
                    <p>Formación en ética,
                        respeto y responsabilidad social</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Seccion de informacion destacada -->
    <section class="info-section" id="porque">
        <div class="info-container">
            <h2 class="section-title-dark reveal">¿Por Qué Elegirnos?</h2>
            <div class="info-grid">
                <div class="info-card reveal">
                    <div class="info-number">15+</div>
                    <h3>Años de Experiencia</h3>
                    <p>Trayectoria consolidada en educación de calidad</p>
                </div>
                <div class="info-card reveal">
                    <div class="info-number">98%</div>
                    <h3>Tasa de Éxito</h3>
                    <p>Estudiantes que alcanzan sus metas académicas</p>
                </div>
                <div class="info-card reveal">
                    <div class="info-number">50+</div>
                    <h3>Profesores Calificados</h3>
                    <p>Equipo docente comprometido y especializado</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer institucional -->
    <footer class="footer" id="contacto">
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
    <!-- Boton flotante de regreso arriba -->
    <button class="scroll-top" type="button" aria-label="Volver arriba">↑</button>
    <script>
        // Revela elementos al entrar en el viewport
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            }
        );

        revealElements.forEach((element) => observer.observe(element));

        // Muestra u oculta el boton de scroll
        const scrollTopButton = document.querySelector('.scroll-top');

        const toggleScrollButton = () => {
            if (window.scrollY > 400) {
                scrollTopButton.classList.add('show');
            } else {
                scrollTopButton.classList.remove('show');
            }
        };

        window.addEventListener('scroll', toggleScrollButton);
        toggleScrollButton();

        // Scroll suave al inicio
        scrollTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Carrusel automatico del hero
        const heroSlides = document.querySelectorAll('.hero-slide');
        const heroCaptions = document.querySelectorAll('.hero-captions');
        const prevButton = document.querySelector('.hero-prev');
        const nextButton = document.querySelector('.hero-next');
        let heroIndex = 0;
        let heroTimer = null;

        const updateHeroCaption = () => {
            if (heroCaptions.length === 0 || heroSlides.length === 0) {
                return;
            }

            const activeSlide = heroSlides[heroIndex];
            const activeCaptionKey = activeSlide ? activeSlide.dataset.caption : null;

            heroCaptions.forEach((caption) => {
                const isVisible = caption.dataset.caption === activeCaptionKey;
                caption.classList.toggle('is-visible', isVisible);
            });
        };

        const goToSlide = (index) => {
            if (heroSlides.length === 0) {
                return;
            }

            heroSlides[heroIndex].classList.remove('is-active');
            heroIndex = (index + heroSlides.length) % heroSlides.length;
            heroSlides[heroIndex].classList.add('is-active');
            updateHeroCaption();
        };

        const startHeroTimer = () => {
            if (heroSlides.length <= 1) {
                return;
            }

            if (heroTimer) {
                clearInterval(heroTimer);
            }

            heroTimer = setInterval(() => {
                goToSlide(heroIndex + 1);
            }, 6000);
        };

        if (prevButton && nextButton) {
            prevButton.addEventListener('click', () => {
                goToSlide(heroIndex - 1);
                startHeroTimer();
            });

            nextButton.addEventListener('click', () => {
                goToSlide(heroIndex + 1);
                startHeroTimer();
            });
        }

        startHeroTimer();

        updateHeroCaption();
    </script>
</body>

</html>
