<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Next Level | Colegio y Academia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
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
                <li><a href="{{ route('web.inicio') }}" class="active">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre_nosotros') }}">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">&#9662;</span></a>
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

    <section class="hero-full-width">
        <div class="hero-slide active">
            <div class="hero-main-content">
                <img src="{{ asset('images/Inicio-Portada-3-Next-Level.jpeg') }}" alt="Next Level Educación" class="main-image">
            </div>
        </div>

        <div class="hero-slide">
            <div class="hero-main-content">
                <img src="{{ asset('images/Inicio-Portada-2-Next-Level.jpeg') }}" alt="Innovación" class="main-image">
            </div>
        </div>

        <div class="hero-slide">
            <div class="hero-main-content">
                <img src="{{ asset('images/Inicio-Portada-1-Next-Level.jpeg') }}" alt="Valores" class="main-image">
            </div>
        </div>
    </section>

    <section class="welcome-section">
        <div class="welcome-container">
            <div class="welcome-grid reorder-mobile">
                <div class="welcome-image-side">
                    <div class="image-frame">
                        <img src="{{ asset('images/Talento-Next-Level.jpeg') }}" alt="Educación Next Level">
                    </div>
                    <div class="experience-badge">
                        <span class="number">2026</span>
                        <span class="text">Matrícula</span>
                    </div>
                </div>

                <div class="welcome-text-side">
                    <span class="welcome-tag">BIENVENIDOS A NEXT LEVEL</span>
                    <h2 class="welcome-title">POTENCIAMOS EL TALENTO DE LA NUEVA GENERACIÓN</h2>
                    <div class="welcome-line"></div>
                    <p class="welcome-description">
                        En <strong>Next Level</strong>, transformamos la educación tradicional en una experiencia dinámica y centrada en el alumno. Nuestro compromiso es brindar las herramientas necesarias para que cada estudiante descubra su propósito y alcance su máximo potencial académico y personal.
                    </p>
                    <ul class="welcome-list">
                        <li><i class="fa-solid fa-circle-check"></i> Formación basada en valores sólidos.</li>
                        <li><i class="fa-solid fa-circle-check"></i> Infraestructura moderna y tecnológica.</li>
                        <li><i class="fa-solid fa-circle-check"></i> Docentes altamente calificados.</li>
                    </ul>
                    <a href="{{ route('experiencia') }}" class="btn-welcome">CONOCE MÁS</a>
                </div>
            </div>
        </div>
    </section>

    <section class="pathway-section">
        <div class="pathway-container">
            <div class="pathway-grid">

                <div class="pathway-content">
                    <h2 class="pathway-title">ELIGE TU CAMINO AL ÉXITO</h2>
                    <div class="welcome-line"></div>
                    <p class="pathway-description">
                        ¿Buscas una educación escolar innovadora o potenciar tus conocimientos para la universidad? Contamos con la metodología exacta para lo que necesitas hoy.
                    </p>
                    <ul class="pathway-list">
                        <li><i class="fa-solid fa-circle-check"></i> Plan curricular actualizado.</li>
                        <li><i class="fa-solid fa-circle-check"></i> Docentes especializados por área.</li>
                        <li><i class="fa-solid fa-circle-check"></i> Seguimiento personalizado.</li>
                    </ul>

                    <div class="pathway-actions">
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." target="_blank" class="btn-whatsapp-pathway">
                            <i class="fa-brands fa-whatsapp"></i> Chatea con nosotros
                        </a>
                        <a href="{{ route('propuesta_educativa') }}" class="btn-proposal-pathway">
                            <i class="fa-regular fa-square-plus"></i> Ver Propuesta Educativa
                        </a>
                    </div>
                </div>

                <div class="pathway-visuals">
                    <div class="cards-wrapper">
                        <div class="path-card path-card-top">
                            <img src="{{ asset('images/Colegio-Next-Level.jpeg') }}" alt="Colegio">
                            <div class="path-card-overlay">
                                <h3>COLEGIO</h3>
                                <p>FORMATO NIÑOS UNIVERSITARIOS</p>
                            </div>
                        </div>

                        <div class="path-card path-card-bottom">
                            <img src="{{ asset('images/Academia-Next-Level.jpeg') }}" alt="Academia">
                            <div class="path-card-overlay">
                                <h3>ACADEMIA</h3>
                                <p>RUMBO A LA UNIVERSIDAD</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="valores-modern-section">
        <div class="valores-overlay"></div>
    </section>


    <section class="alumnos-carousel-section">
        <div class="info-container">
            <div class="info-header">
                <h2 class="section-title-dark">VOCES QUE INSPIRAN</h2>
                <p class="info-intro">Ellos comparten su experiencia y cómo Next Level está transformando su futuro.</p>
                <div class="title-underline"></div>
            </div>

            <div class="alumnos-carrusel-wrapper">
                <div class="alumnos-overflow">
                    <div class="alumnos-track" id="alumnosTrack">
                        <div class="alumno-card-modern">
                            <div class="alumno-video-box">
                                <video controls preload="metadata">
                                    <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="alumno-content">
                                <span class="alumno-tag">COLEGIO</span>
                                <p class="testimonio-text"><span class="quote">"</span>Next Level me ha preparado no solo académicamente, sino también para la vida. Los profesores realmente se preocupan por nuestro éxito.<span class="quote">"</span></p>
                            </div>
                        </div>
                        <div class="alumno-card-modern">
                            <div class="alumno-video-box">
                                <video controls preload="metadata">
                                    <source src="{{ asset('videos/video2.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="alumno-content">
                                <span class="alumno-tag">ACADEMIA</span>
                                <p class="testimonio-text"><span class="quote">"</span>La metodología de enseñanza es increíble. Aprendemos de manera práctica y siempre nos motivan a dar lo mejor de nosotros.<span class="quote">"</span></p>
                            </div>
                        </div>
                        <div class="alumno-card-modern">
                            <div class="alumno-video-box">
                                <video controls preload="metadata">
                                    <source src="{{ asset('videos/video3.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="alumno-content">
                                <span class="alumno-tag">ACADEMIA</span>
                                <p class="testimonio-text"><span class="quote">"</span>Estoy muy agradecida con Next Level. Las instalaciones y el ambiente me hacen sentir motivada para venir a estudiar cada día.<span class="quote">"</span></p>
                            </div>
                        </div>
                        <div class="alumno-card-modern">
                            <div class="alumno-video-box">
                                <video controls preload="metadata">
                                    <source src="{{ asset('videos/video4.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="alumno-content">
                                <span class="alumno-tag">COLEGIO</span>
                                <p class="testimonio-text"><span class="quote">"</span>Gracias a la preparación en Next Level, me siento seguro para enfrentar los retos universitarios. ¡Es la mejor decisión!<span class="quote">"</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info-organic-section">
        <div class="carrusel-wrapper">
            <div class="carrusel-container">
                <div class="info-grid-carrusel" id="carruselTrack">
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-rocket"></i>
                            <div class="text-wrapper">
                                <h3>Enfoque Innovador</h3>
                                <p>Educación de vanguardia basada en proyectos y tecnología aplicada.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-seedling"></i>
                            <div class="text-wrapper">
                                <h3>Crecimiento Conjunto</h3>
                                <p>Iniciamos este camino en marzo, creando una comunidad activa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            <div class="text-wrapper">
                                <h3>Valores y Liderazgo</h3>
                                <p>Formación ética y liderazgo para los retos del mañana.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-school"></i>
                            <div class="text-wrapper">
                                <h3>Infraestructura</h3>
                                <p>Ambientes modernos y seguros diseñados para el aprendizaje.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-user-graduate"></i>
                            <div class="text-wrapper">
                                <h3>Plana Docente</h3>
                                <p>Profesores con amplia trayectoria académica y compromiso humano.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-language"></i>
                            <div class="text-wrapper">
                                <h3>Inglés Intensivo</h3>
                                <p>Dominio del idioma inglés como herramienta clave global.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-palette"></i>
                            <div class="text-wrapper">
                                <h3>Talleres Creativos</h3>
                                <p>Desarrollo artístico y deportivo para formación integral.</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-blob-card">
                        <div class="blob-content">
                            <i class="fa-solid fa-lock"></i>
                            <div class="text-wrapper">
                                <h3>Seguridad 24/7</h3>
                                <p>Tranquilidad total para los padres con sistemas avanzados.</p>
                            </div>
                        </div>
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
    <script src="{{ asset('js/hero-slider.js') }}"></script>
    <script src="{{ asset('js/carrusel-pilares.js') }}"></script>
    <script src="{{ asset('js/carrusel-alumnos.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>

</body>
</html>
