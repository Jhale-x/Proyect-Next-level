<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Propuesta Educativa - Next Level</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/propuesta.css') }}">
</head>
<body>

    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    🧑🏻‍🎓 ¡MATRÍCULA 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    📕 INICIO DE CLASES: 4 DE MARZO &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web_principal') }}" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Qué ofrecemos</a></li>
                        <li><a href="#">Quiénes Somos</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Colegio</a></li>
                        <li><a href="#">Academia</a></li>
                    </ul>
                </li>
                <li><a href="#">UBICACIÓN</a></li>
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
                    <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                    <li class="has-submenu" data-target="submenu-nosotros">
                        <span>NOSOTROS</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li class="has-submenu" data-target="submenu-niveles">
                        <span>NIVELES</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li><a href="#">UBICACIÓN</a></li>
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
                    <li><a href="#">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <header class="propuesta-hero">
        <span class="launch-badge">Inauguración Marzo 2026</span>
        <h1>Nuestra Propuesta Educativa</h1>
        <p>En Next Level, nos enfocamos en una formación cercana y de calidad para Pucallpa. Creemos que la base del éxito está en el esfuerzo compartido, el respeto y una enseñanza práctica que prepare a nuestros alumnos para la vida real.</p>
    </header>

    <main class="propuesta-main">
        <div class="modern-grid">
            <div class="feature-card">
                <div class="icon-wrapper color-1"><i class="fa-solid fa-person-walking"></i></div>
                <h3>Metodología Activa</h3>
                <p>Aprendizaje basado en la participación directa. Nuestros alumnos aprenden haciendo y resolviendo retos prácticos.</p>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper color-2"><i class="fa-solid fa-users-rectangle"></i></div>
                <h3>Enseñanza Cercana</h3>
                <p>Garantizamos grupos reducidos que permiten conocer a cada estudiante y acompañar su progreso de forma personalizada.</p>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper color-3"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <h3>Formación en Valores</h3>
                <p>Priorizamos la ética, la disciplina y el respeto mutuo para formar ciudadanos responsables y empáticos.</p>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper color-4"><i class="fa-solid fa-brain"></i></div>
                <h3>Mentalidad Ganadora</h3>
                <p>Fomentamos la autoconfianza y perseverancia, enseñando a gestionar emociones para superar cualquier desafío.</p>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper color-5"><i class="fa-solid fa-book-open"></i></div>
                <h3>Material Didáctico</h3>
                <p>Contamos con guías y recursos de estudio diseñados para facilitar la comprensión de cada materia.</p>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper color-6"><i class="fa-solid fa-chalkboard-user"></i></div>
                <h3>Docentes Motivadores</h3>
                <p>Nuestro equipo está comprometido con inspirar el deseo de aprender y superar metas académicas.</p>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6 (Al costado de la UNU)</p>
                    <p><i class="fa-solid fa-envelope"></i> contacto@nextlevel.edu.pe</p>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-column">
                    <a href="#">UBICACIÓN</a>
                    <a href="#">CONTÁCTANOS</a>
                    <a href="#">ADMISIÓN 2026</a>
                    <a href="#">SOBRE NOSOTROS</a>
                    <a href="#">NUESTROS VALORES</a>
                </div>
                <div class="footer-column">
                    <a href="#">NIVELES</a>
                    <a href="#">ACADEMIA</a>
                    <a href="#">PAGOS EN LÍNEA</a>
                    <a href="#">MATRICULA 2026</a>
                    <a href="#">HORARIO DE CLASE</a>
                </div>
                <div class="footer-column social-align">
                    <a href="{{ route('portal') }}">INTRANET</a>
                    <a href="#">PROTECCIÓN DE DATOS</a>
                    <a href="#">LIBRO DE RECLAMACIONES</a>
                    <div class="footer-social-icons">
                        <a href="https://www.tiktok.com/@next_level_novus" target="_blank" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/next_level_novus/" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/51923317625" target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
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
