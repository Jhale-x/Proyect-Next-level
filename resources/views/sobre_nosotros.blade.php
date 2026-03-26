<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | Next Level</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/sobre_nosotros.css') }}">
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
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre.nosotros') }}" class="active">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mantenimiento') }}">Colegio</a></li>
                        <li><a href="{{ route('academia') }}">Academia</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                <li><a href="{{ route('matricula') }}">MATRICULAS</a></li>
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
                    <li><a href="{{ route('matricula') }}">MATRICULAS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">INTRANET</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-nosotros">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
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
        <section class="hero-sobre">
            <div class="hero-overlay">
                <div class="hero-content">
                    <span class="section-tag">INSTITUCIÓN EDUCATIVA</span>
                    <h1>SOBRE NOSOTROS</h1>
                    <div class="hero-line"></div>
                    <p>
                        Transformamos la educación en una experiencia de alto impacto,
                        formando estudiantes con mentalidad ganadora y visión global.
                    </p>
                </div>
            </div>
            <img src="{{ asset('images/imagen10.jpg') }}" alt="Fondo" class="hero-bg-img">
        </section>

        <section class="sobre-section">
            <div class="container sobre-grid">
                <div class="sobre-text">
                    <span class="upper-title">Nuestra Esencia</span>
                    <h2>NUESTRA IDENTIDAD</h2>
                    <div class="section-line"></div>
                    <p class="p-highlight">
                        En <strong>Next Level</strong>, entendemos que la educación no solo transmite conocimientos, sino que construye carácter, disciplina y liderazgo.
                    </p>
                    <p>
                        Nuestro enfoque integra excelencia académica, tecnología de vanguardia y una sólida formación en valores, preparando a nuestros estudiantes para destacar y competir en un entorno global altamente exigente.
                    </p>
                    <div class="sobre-features">
                        <span><i class="fa-solid fa-check-double"></i> Mentalidad Ganadora</span>
                        <span><i class="fa-solid fa-check-double"></i> Visión Global</span>
                    </div>
                </div>

                <div class="sobre-stats">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-info">
                            <h3>100%</h3>
                            <span>Educación vanguardista desde el primer día</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-user-shield"></i></div>
                        <div class="stat-info">
                            <h3>24/7</h3>
                            <span>Seguimiento formativo y disciplinario</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="stat-info">
                            <h3>100%</h3>
                            <span>Compromiso con el éxito del alumno</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="metodologia-section">
            <div class="container metodologia-grid">
                <div class="metodologia-img">
                    <img src="{{ asset('images/imagen10.jpg') }}" alt="Metodología Next Level">
                    <div class="img-badge">METODOLOGÍA 360°</div>
                </div>
                <div class="metodologia-content-box">
                    <span class="upper-title">NUESTRA FORMA DE ENSEÑAR</span>
                    <h2>NUESTRA METODOLOGÍA</h2>
                    <div class="section-line"></div>

                    <p class="metodologia-intro">
                        Nuestro modelo garantiza resultados sostenibles mediante el acompañamiento constante y el uso de herramientas de vanguardia.
                    </p>

                    <ul class="metodologia-list-new">
                        <li>
                            <div class="list-icon"><i class="fa-solid fa-brain"></i></div>
                            <div class="list-text">
                                <strong>Aprendizaje Basado en Retos</strong>
                                <span>Enfrentamos a los alumnos a situaciones reales.</span>
                            </div>
                        </li>
                        <li>
                            <div class="list-icon"><i class="fa-solid fa-chart-pie"></i></div>
                            <div class="list-text">
                                <strong>Evaluación Continua</strong>
                                <span>Seguimiento personalizado de cada avance.</span>
                            </div>
                        </li>
                        <li>
                            <div class="list-icon"><i class="fa-solid fa-microchip"></i></div>
                            <div class="list-text">
                                <strong>Integración Tecnológica</strong>
                                <span>Uso de plataformas digitales en el aula.</span>
                            </div>
                        </li>
                        <li>
                            <div class="list-icon"><i class="fa-solid fa-users-gear"></i></div>
                            <div class="list-text">
                                <strong>Desarrollo Integral</strong>
                                <span>Equilibrio entre lo académico y lo humano.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

    <section class="mision-vision-section">
    <div class="exp-blobs-container container-blocks">
        <div class="info-blob-card">
            <div class="blob-content">
                <i class="fa-solid fa-bullseye"></i>
                <div class="text-wrapper">
                    <h3>MISIÓN</h3>
                    <p>Formar estudiantes íntegros con alto nivel académico, liderazgo y valores sólidos.</p>
                </div>
            </div>
        </div>

        <div class="info-blob-card">
            <div class="blob-content">
                <i class="fa-solid fa-eye"></i>
                <div class="text-wrapper">
                    <h3>VISIÓN</h3>
                    <p>Consolidarnos como una institución educativa referente por nuestra innovación constante.</p>
                </div>
            </div>
        </div>

        <div class="info-blob-card">
            <div class="blob-content">
                <i class="fa-solid fa-hand-holding-heart"></i>
                    <div class="text-wrapper">
                        <h3>VALORES</h3>
                        <p>Disciplina, respeto, ética, responsabilidad, superación constante y excelencia.</p>
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
                    <a href="{{ route('pagos') }}">MATRÍCULA ONLINE</a>
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
