<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Level | Ciclos</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/propuesta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/ciclos.css') }}">

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
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Qué ofrecemos</a></li>
                        <li><a href="#">Quiénes Somos</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Colegio</a></li>
                        <li><a href="{{ route('academia') }}">Academia</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                <li><a href="#">MATRICULAS</a></li>
                <li><a href="#">CONCURSOS</a></li>
                <li><a href="{{ route('portal') }}">INTRANET</a></li>
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
                    <li><a href="#">MATRICULAS</a></li>
                    <li><a href="#">CONCURSOS</a></li>
                    <li><a href="{{ route('portal') }}">INTRANET</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-nosotros">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="#">Qué ofrecemos</a></li>
                    <li><a href="#">Quiénes Somos</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-niveles">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="#">Colegio</a></li>
                    <li><a href="{{ route('academia') }}">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>
        <section class="hero-sobre">
            <div class="hero-overlay">
           <!-- <div class="hero-content">
                    <span class="section-tag">PREPARACIÓN DE ALTO NIVEL</span>
                    <h1>NUESTROS CICLOS</h1>
                    <div class="hero-line"></div>
                    <p>
                        Elige tu ciclo de preparación preuniversitaria según tu objetivo.
                    </p>
                </div> -->
            </div>
            <img src="{{ asset('images/imagen10.jpg') }}" alt="Fondo" class="hero-bg-img">
        </section>

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
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Anual UNU</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            </a>
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Semestral UNU</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Verano Pre UNU</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            <p class="empty-msg">Próximamente más ciclos.</p>
                        </div>
                    </div>

                    <div class="ciclo-acordeon">
                        <div class="acordeon-header header-unia">
                            <span>UNIA (INTERCULTURAL)</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="acordeon-content">
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Anual UNIA</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            </a>
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Semestral UNIA</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">Verano Pre UNIA</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>
                            <p class="empty-msg">Próximamente más ciclos.</p>
                        </div>
                    </div>

                    <div class="ciclo-acordeon">
                        <div class="acordeon-header header-otros">
                            <span>OTRAS UNIVERSIDADES</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="acordeon-content">
                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">UNMSM (San Marcos)</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>

                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">UNI (Ingeniería)</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>

                            <div class="ciclo-item">
                                <div class="ciclo-info">
                                    <span class="ciclo-name">PUCP (Católica)</span>
                                    <span class="badge-nuevo">NUEVO</span>
                                </div>
                            </div>

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

    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> +51 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6 (Al costado de la UNU)</p>
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
                    <a href="#">MATRíCULA 2026</a>
                    <a href="#">MATRÍCULA ONLINE</a>
                    <a href="#">LIBRO RECLAMACIONES</a>
                </div>
                <div class="footer-column social-align">
                    <a href="#">POLÍTICA COOKIES</a>
                    <a href="#">POLÍTICA PRIVACIDAD</a>
                    <a href="#">TERMINOS Y CONDICIONES</a>

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
