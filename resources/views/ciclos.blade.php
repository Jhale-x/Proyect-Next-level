<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciclos | Next Level</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/ciclos.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo-Next-Level.png') }}">
</head>

<body>

    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    🚀📚 Ciclos Anual / Semestral / Verano &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web.inicio') }}" class="nav-brand">
                <img src="{{ asset('images/Logo-Letras-Next-Level.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre_nosotros') }}">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('colegio') }}">Colegio</a></li>
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
                    <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                    <li><a href="{{ route('sobre_nosotros') }}">Sobre nosotros</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-niveles">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('colegio') }}">Colegio</a></li>
                    <li><a href="{{ route('academia') }}">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>
    <header class="exp-hero">
        <div class="exp-hero-overlay">
            <div class="exp-hero-content">
                <span class="welcome-tag">PREPARACIÓN DE ALTO NIVEL</span>
                <h1 class="welcome-title-hero">NUESTROS CICLOS</h1>
                <div class="welcome-line-hero"></div>
                <p class="welcome-description-hero">
                    Elige tu ciclo de preparación preuniversitaria segun tu objetivo.
                </p>
            </div>
        </div>
        <img src="{{ asset('#') }}" alt="Fondo" class="hero-bg-img">
    </header>

    <section class="ciclos-section">
        <div class="ciclos-container">

            <div class="ciclos-header">
                <span class="sub-header">PROCESO DE ADMISIÓN 2026</span>
                <h2>EXPLORA NUESTROS PROGRAMAS</h2>
                <p>Selecciona tu universidad de interés para conocer los ciclos disponibles y potenciar tu preparación.</p>
            </div>

            <div class="ciclos-wrapper">
                <div class="ciclo-acordeon">
                    <div class="acordeon-header header-unu">
                        <span>UNU (UCAYALI)</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="acordeon-content">
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Anual UNU</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Semestral UNU</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Verano Pre UNU</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <p class="empty-msg">Próximamente más ciclos.</p>
                    </div>
                </div>

                <div class="ciclo-acordeon">
                    <div class="acordeon-header header-unia">
                        <span>UNIA (INTERCULTURAL)</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="acordeon-content">
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Anual UNIA</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Semestral UNIA</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">Verano Pre UNIA</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <p class="empty-msg">Próximamente más ciclos.</p>
                    </div>
                </div>

                <div class="ciclo-acordeon">
                    <div class="acordeon-header header-otros">
                        <span>OTRAS UNIVERSIDADES</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="acordeon-content">
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">UNMSM (San Marcos)</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">UNI (Ingeniería)</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>
                        <a href="{{ url('mantenimiento') }}" class="ciclo-link">
                        <div class="ciclo-item">
                            <div class="ciclo-info">
                                <span class="ciclo-name">PUCP (Católica)</span>
                                <span class="badge-nuevo">NUEVO</span>
                            </div>
                        </div>
                        </a>

                        <p class="empty-msg">Próximamente más universidades.</p>
                    </div>
                </div>

                <div class="ciclo-acordeon">
                    <div class="acordeon-header header-servicios">
                        <span>OTROS SERVICIOS</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="acordeon-content">
                        <p class="empty-msg">Próximamente nuevos servicios.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="universidades-section-final">
        <div class="univ-container-fixed">
            <div class="univ-grid-wrapper">

                <div class="univ-card">
                    <div class="univ-logo-box">
                        <img src="{{ asset('images/Unu-Next-Level.png') }}" alt="UNU" class="logo-unu">
                    </div>
                    <span class="univ-pre-text">Preparación</span>
                    <h3 class="univ-title">UNU</h3>
                </div>

                <div class="univ-card">
                    <div class="univ-logo-box">
                        <img src="{{ asset('images/Unia-Next-Level.png') }}" alt="UNIA" class="logo-unia">
                    </div>
                    <span class="univ-pre-text">Preparación</span>
                    <h3 class="univ-title">UNIA</h3>
                </div>

                <div class="univ-card">
                    <div class="univ-logo-box">
                        <img src="{{ asset('images/San-Marcos-Next-Level.png') }}" alt="San Marcos" class="logo-sanmarcos">
                    </div>
                    <span class="univ-pre-text">Preparación</span>
                    <h3 class="univ-title">San Marcos</h3>
                </div>

                <div class="univ-card">
                    <div class="univ-logo-box">
                        <img src="{{ asset('images/Uni-Next-Level.png') }}" alt="UNI" class="logo-uni">
                    </div>
                    <span class="univ-pre-text">Preparación</span>
                    <h3 class="univ-title">UNI</h3>
                </div>

                <div class="univ-card">
                    <div class="univ-logo-box">
                        <img src="{{ asset('images/Catolica-Next-Level.png') }}" alt="Católica" class="logo-catolica">
                    </div>
                    <span class="univ-pre-text">Preparación</span>
                    <h3 class="univ-title">Católica</h3>
                </div>

            </div>
        </div>
    </section>

    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/Logo-Footer-Next-Level.png') }}" alt="Next Level Logo" class="footer-logo-img">
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
                    <a href="{{ route('sobre_nosotros') }}">SOBRE NOSOTROS</a>
                    <a href="{{ route('nuestros_valores') }}">NUESTROS VALORES</a>
                </div>
                <div class="footer-column">
                    <a href="{{ route('academia') }}">ACADEMIA</a>
                    <a href="{{ route('pagos') }}">PAGOS EN LÍNEA</a>
                    <a href="{{ route('mantenimiento') }}">MATRíCULA 2026</a>
                    <a href="{{ route('pagos') }}">MATRÍCULA ONLINE</a>
                    <a href="{{ route('mantenimiento') }}">LIBRO RECLAMACIONES</a>
                </div>
                <div class="footer-column social-align">
                    <a href="{{ route('mantenimiento') }}">POLÍTICA COOKIES</a>
                    <a href="{{ route('politica_privacidad') }}">POLÍTICA PRIVACIDAD</a>
                    <a href="{{ route('terminos_condiciones') }}">TÉRMINOS Y CONDICIONES</a>

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
    <script src="{{ asset('js/ciclos.js') }}"></script>

</body>
</html>
