<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Experiencia | Next Level</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/experiencia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/propuesta.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
<body>

    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    ☀️🏊‍♂️ Inicio de Clases: 4 Marzo &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web.inicio') }}" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mantenimiento') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre.nosotros') }}">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mantenimiento') }}">Colegio</a></li>
                        <li><a href="{{ route('academia') }}">Academia</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                <li><a href="{{ route('mantenimiento') }}">INTRANET</a></li>
            </ul>
        </div>
    </nav>

    <div class="mobile-menu-overlay" id="menuOverlay"></div>
    <div class="mobile-side-menu" id="sideMenu">
        <div class="menu-header">
            <span>MENÚ</span>
            <button class="close-menu" id="menuClose" type="button"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="menu-panels-container">
            <div class="menu-panel active" id="mainPanel">
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                    <li class="has-submenu" data-target="submenu-nosotros">
                        <span>NOSOTROS</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li class="has-submenu" data-target="submenu-niveles">
                        <span>NIVELES</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                    <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">INTRANET</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-nosotros">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('mantenimiento') }}">Qué ofrecemos</a></li>
                    <li><a href="{{ route('sobre.nosotros') }}">Sobre nosotros</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-niveles">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('mantenimiento') }}">Colegio</a></li>
                    <li><a href="{{ route('academia') }}">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>
    <header class="exp-hero">
        <div class="exp-hero-overlay">
            <div class="exp-hero-content">
                <span class="welcome-tag">DESCUBRE NUESTRO MUNDO</span>
                <h1 class="welcome-title-hero">LA EXPERIENCIA NEXT LEVEL</h1>
                <div class="welcome-line-hero"></div>
                <p class="welcome-description-hero">
                    Más que un colegio, somos el espacio donde nace su propósito. Aquí el talento se cultiva con valores para formar a los líderes del mañana.
                </p>
            </div>
        </div>
        <img src="{{ asset('images/imagen10.jpg') }}" alt="Fondo" class="hero-bg-img">
    </header>

    <section class="pathway-section">
        <div class="pathway-container">
            <h2 class="section-title-dark-centered">AMBIENTES QUE INSPIRAN</h2>
            <div class="section-line"></div>
            <div class="exp-cards-grid">
                <div class="path-card">
                    <img src="{{ asset('images/imagen10.jpg') }}" alt="Laboratorio">
                    <div class="path-card-overlay">
                        <h3>NATACIÓN</h3>
                        <p>DEPORTE Y FRESCURA TOTAL.</p>
                    </div>
                </div>
                <div class="path-card">
                    <img src="{{ asset('images/imagen10.jpg') }}" alt="Recreo">
                    <div class="path-card-overlay">
                        <h3>DESARROLLO</h3>
                        <p>TALENTO Y RECREACIÓN FÍSICA.</p>
                    </div>
                </div>
                <div class="path-card">
                    <img src="{{ asset('images/imagen10.jpg') }}" alt="Aulas">
                    <div class="path-card-overlay">
                        <h3>DEPORTE</h3>
                        <p>CAMPOS DEPORTIVOS.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="welcome-section">
        <div class="welcome-container">
            <div class="welcome-grid">
                <div class="welcome-text-side">
                    <h2 class="welcome-title">EL DÍA A DÍA EN NEXT LEVEL</h2>
                    <div class="welcome-line"></div>
                    <ul class="welcome-list">
                        <li><i class="fa-solid fa-bolt"></i> <strong>Mañanas de Retos:</strong> Iniciamos el día resolviendo problemas reales.</li>
                        <li><i class="fa-solid fa-users"></i> <strong>Talleres de Liderazgo:</strong> Habilidades blandas para el éxito profesional.</li>
                        <li><i class="fa-solid fa-pen-to-square"></i> <strong>Hábitos de Estudio:</strong> Métodos prácticos para aprender mejor.</li>
                        <li><i class="fa-solid fa-swimmer"></i> <strong>Deporte Integral:</strong> Natación y desarrollo físico constante.</li>
                        <li><i class="fa-solid fa-handshake-simple"></i> <strong>Convivencia Activa:</strong> Fomentamos el respeto y el trabajo en equipo diario.</li>
                        <li><i class="fa-solid fa-palette"></i> <strong>Arte y Cultura:</strong> Espacios para la expresión y creatividad.</li>
                        <li><i class="fa-solid fa-trophy"></i> <strong>Vida Activa:</strong> Deporte y recreación en nuestras canchas propias.</li>
                    </ul>
                </div>
                <div class="welcome-image-side">
                    <div class="image-frame">
                        <img src="{{ asset('images/imagen10.jpg') }}" alt="Vida estudiantil">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info-organic-section">
        <div class="exp-blobs-container">
            <div class="info-blob-card">
                <div class="blob-content">
                    <i class="fa-solid fa-shield-halved"></i>
                    <div class="text-wrapper">
                        <h3>Cámaras 24/7</h3>
                        <p>Monitoreo constante en todos los niveles.</p>
                    </div>
                </div>
            </div>
            <div class="info-blob-card">
                <div class="blob-content">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <div class="text-wrapper">
                        <h3>Control Digital</h3>
                        <p>App para padres con asistencia en tiempo real.</p>
                    </div>
                </div>
            </div>
            <div class="info-blob-card">
                <div class="blob-content">
                    <i class="fa-solid fa-location-crosshairs"></i>
                    <div class="text-wrapper">
                        <h3>Entorno Seguro</h3>
                        <p>Ubicación estratégica y control de accesos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> +51 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6.5 (Al costado de la UNU)</p>
                    <p><i class="fa-solid fa-envelope"></i> contacto@nextlevel.edu.pe</p>
                </div>
            </div>

            <div class="footer-right">
                <div class="footer-column">
                    <a href="{{ route('ciclos') }}">CICLOS</a>
                    <a href="{{ route('galeria') }}">GALERIA</a>
                    <a href="{{ route('contactenos') }}">CONTÁCTANOS</a>
                    <a href="{{ route('sobre.nosotros') }}">SOBRE NOSOTROS</a>
                    <a href="{{ route('nuestros.valores') }}">NUESTROS VALORES</a>
                </div>
                <div class="footer-column">
                    <a href="{{ route('academia') }}">ACADEMIA</a>
                    <a href="{{ route('pagos') }}">PAGOS EN LÍNEA</a>
                    <a href="{{ route('mantenimiento') }}">MATRíCULA 2026</a>
                    <a href="{{ route('mantenimiento') }}">MATRÍCULA ONLINE</a>
                    <a href="{{ route('mantenimiento') }}">LIBRO RECLAMACIONES</a>
                </div>
                <div class="footer-column social-align">
                    <a href="{{ route('mantenimiento') }}">POLÍTICA COOKIES</a>
                    <a href="{{ route('mantenimiento') }}">POLÍTICA PRIVACIDAD</a>
                    <a href="{{ route('mantenimiento') }}">TERMINOS Y CONDICIONES</a>

                    <div class="footer-social-icons">
                        <a href="https://www.tiktok.com/@next_level_novus" target="_blank" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/next_level_novus/" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=61581492196914" target="_blank" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Next Level. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="{{ asset('js/marquee_principal.js') }}"></script>
    <script src="{{ asset('js/nav-scroll.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>
</body>
</html>
