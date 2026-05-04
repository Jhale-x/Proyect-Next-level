<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Qué ofrecemos | Next Level</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/academia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/que_ofrecemos.css') }}">
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
                        <li><a href="{{ route('que_ofrecemos') }}" class="active">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre.nosotros') }}">Sobre nosotros</a></li>
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
                    <li><a href="{{ route('sobre.nosotros') }}">Sobre nosotros</a></li>
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
                <span class="welcome-tag">FORMACIÓN INTEGRAL</span>
                <h1 class="welcome-title-hero">¿QUÉ OFRECEMOS?</h1>
                <div class="welcome-line-hero"></div>
                <p class="welcome-description-hero">
                    Actividades educativas, deportivas y formativas para el desarrollo completo de nuestros estudiantes.
                </p>
            </div>
        </div>
    </header>

    <section class="actividades-section-clean">
        <div class="container-clean">
            <div class="section-header-centered-clean">
                <h2>ACTIVIDADES EDUCATIVAS</h2>
                <div class="linea-decorativa-main"></div>
                <p>Potenciamos el conocimiento con experiencias de aprendizaje innovadoras</p>
            </div>

            <div class="actividades-grid-clean">
                <div class="actividad-card-clean">
                    <div class="icon-blob-clean">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <h3>PLAN LECTOR</h3>
                    <div class="mini-linea-roja-card"></div>
                    <p>Fortalecemos la comprensión lectora con recursos digitales y clubes de debate.</p>
                </div>

                <div class="actividad-card-clean">
                    <div class="icon-blob-clean">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                    <h3>TALLER DE MATEMÁTICAS</h3>
                    <div class="mini-linea-roja-card"></div>
                    <p>Reforzamiento y preparación para concursos de matemáticas y olimpiadas del conocimiento.</p>
                </div>

                <div class="actividad-card-clean">
                    <div class="icon-blob-clean">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h3>ARTE Y CREATIVIDAD</h3>
                    <div class="mini-linea-roja-card"></div>
                    <p>Talleres de pintura, dibujo, música para expresar y desarrollar el talento artístico de nuestros estudiantes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="deportivas-section">
        <div class="container-deportes">
            <div class="section-header-centered">
                <h2 class="title-white">ACTIVIDADES DEPORTIVAS</h2>
                <div class="title-line-red"></div>
            </div>

            <div class="swiper deportivas-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="deporte-card">
                            <div class="deporte-img">
                                <img src="{{ asset('images/Futbol-Next-Level.jpeg') }}" alt="Fútbol">
                            </div>
                            <div class="deporte-content">
                            <h3>FÚTBOL</h3>
                            <p>Escuela de fútbol formativo con entrenadores calificados y participación en ligas escolares.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="deporte-card">
                            <div class="deporte-img">
                            <img src="{{ asset('images/Voley-Next-Level.jpeg') }}" alt="Vóley">
                            </div>
                            <div class="deporte-content">
                                <h3>VÓLEY</h3>
                                <p>Categorías formativas con énfasis en técnica, táctica y espíritu deportivo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="deporte-card">
                            <div class="deporte-img">
                                <img src="{{ asset('images/imagen10.jpg') }}" alt="Natación">
                            </div>
                            <div class="deporte-content">
                                <h3>NATACIÓN</h3>
                                <p>Clases de natación por niveles en nuestra piscina semi-olímpica.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="deporte-card">
                            <div class="deporte-img">
                            <img src="{{ asset('images/imagen10.jpg') }}" alt="Atletismo">
                            </div>
                            <div class="deporte-content">
                                <h3>ATLETISMO</h3>
                                <p>Entrenamiento en diversas disciplinas atléticas para desarrollar resistencia y velocidad.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="deporte-card">
                            <div class="deporte-img">
                                <img src="{{ asset('images/imagen10.jpg') }}" alt="Ajedrez">
                            </div>
                            <div class="deporte-content">
                                <h3>AJEDEREZ</h3>
                                <p>Taller de ajedrez para desarrollar concentración, estrategia y pensamiento analítico.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="formativas-section">
        <div class="container">
            <div class="section-header-centered-clean">
                <h2 class="title-blue">ACTIVIDADES FORMATIVAS</h2>
                <div class="title-line-red"></div>
                <p>Desarrollamos habilidades socioemocionales y liderazgo</p>
            </div>

            <div class="formativas-grid">

                <article class="formativa-card">
                        <div class="formativa-icon-circle">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <div class="formativa-content">
                        <h3>FORMACIÓN EN VALORES</h3>
                        <ul class="formativa-list">
                            <li><i class="fa-regular fa-circle-check"></i> Talleres de liderazgo</li>
                            <li><i class="fa-regular fa-circle-check"></i> Programa de tutoría personalizada</li>
                            <li><i class="fa-regular fa-circle-check"></i> Charlas sobre ética y ciudadanía</li>
                            <li><i class="fa-regular fa-circle-check"></i> Proyectos de responsabilidad social</li>
                        </ul>
                    </div>
                    <div class="formativa-decoration"></div>
                </article>

                <article class="formativa-card">
                    <div class="formativa-icon-circle">
                        <i class="fa-solid fa-people-arrows"></i>
                    </div>
                    <div class="formativa-content">
                        <h3>HABILIDADES SOCIOEMOCIONALES</h3>
                        <ul class="formativa-list">
                            <li><i class="fa-regular fa-circle-check"></i> Inteligencia emocional</li>
                            <li><i class="fa-regular fa-circle-check"></i> Resolución de conflictos</li>
                            <li><i class="fa-regular fa-circle-check"></i> Trabajo en equipo</li>
                            <li><i class="fa-regular fa-circle-check"></i> Comunicación asertiva</li>
                        </ul>
                    </div>
                    <div class="formativa-decoration"></div>
                </article>

                <article class="formativa-card">
                    <div class="formativa-icon-circle">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div class="formativa-content">
                        <h3>ORIENTACIÓN VOCACIONAL</h3>
                        <ul class="formativa-list">
                            <li><i class="fa-regular fa-circle-check"></i> Tests vocacionales</li>
                            <li><i class="fa-regular fa-circle-check"></i> Charlas con profesionales</li>
                            <li><i class="fa-regular fa-circle-check"></i> Visitas a universidades</li>
                            <li><i class="fa-regular fa-circle-check"></i> Feria vocacional anual</li>
                        </ul>
                    </div>
                    <div class="formativa-decoration"></div>
                </article>

                <article class="formativa-card">
                    <div class="formativa-icon-circle">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>
                    <div class="formativa-content">
                        <h3>PROYECTOS SOCIALES</h3>
                        <ul class="formativa-list">
                            <li><i class="fa-regular fa-circle-check"></i> Campañas solidarias</li>
                            <li><i class="fa-regular fa-circle-check"></i> Voluntariado estudiantil</li>
                            <li><i class="fa-regular fa-circle-check"></i> Proyectos ambientales</li>
                            <li><i class="fa-regular fa-circle-check"></i> Apoyo a comunidades</li>
                        </ul>
                    </div>
                    <div class="formativa-decoration"></div>
                </article>
            </div>
        </div>
    </section>

    <section class="talleres-section">
        <div class="container">
            <div class="talleres-container">

                <div class="talleres-content">
                    <span class="academy-label">EXPLORA TUS TALENTOS</span>
                    <h2 class="title-blue">TALLERES EXTRACURRICULARES</h2>
                    <p>
                        Ofrecemos una variedad de talleres para que los estudiantes descubran y desarrollen sus pasiones fuera del horario escolar.
                    </p>

                    <div class="talleres-list">
                        <div class="taller-item">
                            <i class="fa-solid fa-volleyball"></i>
                            <span>Deporte (Fútbol / Vóley)</span>
                        </div>
                        <div class="taller-item">
                            <i class="fa-solid fa-palette"></i>
                            <span>Arte y pintura</span>
                        </div>
                        <div class="taller-item">
                            <i class="fa-solid fa-music"></i>
                            <span>Danza moderna</span>
                        </div>
                        <div class="taller-item">
                            <i class="fa-solid fa-chess-knight"></i>
                            <span>Ajedrez y Lógica</span>
                        </div>
                        <div class="taller-item">
                            <i class="fa-solid fa-scissors"></i>
                            <span>Manualidades</span>
                        </div>
                        <div class="taller-item">
                        <i class="fa-solid fa-masks-theater"></i>
                            <span>Teatro</span>
                        </div>
                    </div>
                </div>

                <div class="talleres-image">
                    <img src="{{ asset('images/imagen10.jpg') }}" alt="Talleres Next Level">
                </div>
            </div>
        </div>
    </section>

    <section class="docencia-section">
        <div class="container">
            <div class="section-header-centered-clean">
                <h2 class="title-blue">CALIDAD DE NUESTROS DOCENTES</h2>
                <div class="title-line-red"></div>
                <p>Aprendemos de los mejores: profesores que inspiran y transforman</p>
            </div>

            <div class="docencia-grid">

                <article class="docencia-card">
                    <div class="docencia-icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h3>ESPECIALIZACIÓN Y EXPERIENCIA</h3>
                    <p>Contamos con docentes de alta formación y amplia experiencia para garantizar una enseñanza de calidad siempre actualizada.</p>
                </article>

                <article class="docencia-card">
                    <div class="docencia-icon">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>VOVACIÓN DE ENSEÑANZA</h3>
                    <p>Buscamos educadores apasionados que logren conectar profundamente con sus alumnos y fomenten en ellos el deseo constante de aprender.</p>
                </article>

                <article class="docencia-card">
                    <div class="docencia-icon">
                        <i class="fa-solid fa-hand-peace"></i>
                    </div>
                    <h3>ACOMPAÑAMIENTO PERSONALIZADO</h3>
                    <p>Más que profesores, son guías que brindan apoyo individualizado para atender las necesidades específicas de cada estudiante.</p>
                </article>
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/marquee_principal.js') }}"></script>
    <script src="{{ asset('js/nav-scroll.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>
    <script src="{{ asset('js/deportivas-slider.js') }}"></script>
</body>

</html>
