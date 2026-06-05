<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ubicación | Next Level</title>
    <meta name="description" content="Visítanos en nuestra sede de Next Level School en Pucallpa. Encuentra nuestra dirección exacta y horarios de atención para informes e inscripciones.">
    <meta name="keywords" content="dirección Next Level, academia Pucallpa, informes Next Level School, ubicación colegio Pucallpa">
    <meta property="og:title" content="Ubicación y Contacto | Next Level">
    <meta property="og:image" content="{{ asset('images/Logo-Next-Level.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/ubicacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/cookies_principal.css') }}">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo-Next-Level.png') }}">
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
                <li><a href="{{ route('ubicacion') }}" class="active">UBICACIÓN</a></li>
                <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                <li><a href="https://intranet.nextlevelschool.edu.pe" target="_blank" rel="noopener noreferrer">INTRANET</a></li>
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
                    <li><a href="{{ route('ubicacion') }}" class="active">UBICACIÓN</a></li>
                    <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                    <li><a href="https://intranet.nextlevelschool.edu.pe" target="_blank" rel="noopener noreferrer">INTRANET</a></li>
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

    <section class="ubicacion-section">
        <div class="welcome-container">
            <div class="ubicacion-grid">
                <div class="ubicacion-info">
                    <h2>¿DÓNDE NOS ENCONTRAMOS?</h2>
                    <div class="section-line"></div>
                    <p>Nos ubicamos en una zona accesible y segura, diseñada para ofrecer un entorno adecuado para el desarrollo académico integral.</p>

                    <div class="info-box">
                        <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6.5 (Al costado de la UNU)</p>
                        <p><i class="fa-solid fa-phone"></i> +51 923 317 626</p>
                        <p><i class="fa-solid fa-envelope"></i> contacto@nextlevel.edu.pe</p>
                        <button onclick="comoLlegar()" class="btn-ruta">
                            Cómo llegar
                        </button>
                    </div>
                </div>

                <div class="ubicacion-mapa">
                    <div id="map" data-token="{{ config('services.mapbox.token') }}"></div>

                    <div id="controlCapas" onclick="toggleCapas()">
                    <img id="miniMapa" src="https://api.mapbox.com/styles/v1/mapbox/satellite-v9/static/-74.579858,-8.392186,16/100x100?access_token={{ config('services.mapbox.token') }}" alt="Miniatura">
                    <span>Cambiar mapa</span>
                    </div>

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
                    <a href="{{ route('politica_cookies') }}">POLÍTICA COOKIES</a>
                    <a href="{{ route('politica_privacidad') }}">POLÍTICA PRIVACIDAD</a>
                    <a href="{{ route('terminos_condiciones') }}">TÉRMINOS Y CONDICIONES</a>

                    <div class="footer-social-icons">
                        <a href="https://www.tiktok.com/@next_level_novus" target="_blank" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/next_level_novus/" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20más%20información." target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
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
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="{{ asset('js/mapbox-gl.js') }}"></script>
    <script src="{{ asset('js/mapa_ruta.js') }}"></script>
    <script src="{{ asset('js/cookie-banner.js') }}"></script>

    <x-cookie-banner />

</body>
</html>
