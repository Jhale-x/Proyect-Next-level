<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Next Level - Centro Educativo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <a href="#" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <ul class="nav-menu">
                <li><a href="#" class="active">INICIO</a></li>
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

    <section class="hero-full-width">
        <div class="hero-slide active">
            <div class="hero-main-content">
                <img src="{{ asset('images/imagen10.jpg') }}" alt="Next Level Educación" class="main-image">
                <div class="diagonal-white">
                    <h1>Llevamos tu potencial al siguiente nivel.</h1>
                    <p>Desarrollando mentes curiosas y futuros brillantes desde la etapa temprana.</p>
                </div>
                <div class="diagonal-blue">
                    <h2>Proyección Superior: El Futuro se Construye Aquí.</h2>
                    <p>No solo transmitimos conocimiento; impulsamos una mentalidad de crecimiento constante en cada
                        etapa académica.</p>
                </div>
            </div>
        </div>

        <div class="hero-slide">
            <div class="hero-main-content">
                <img src="{{ asset('images/imagen10.jpg') }}" alt="Innovación" class="main-image">
                <div class="diagonal-white">
                    <h1>Donde el aprendizaje no tiene límites.</h1>
                    <p>Aprendizaje basado en retos con impacto en el mundo real.</p>
                </div>
                <div class="diagonal-blue">
                    <h2>Innovación Constante: Preparados para el Mañana.</h2>
                    <p>Potenciamos tus habilidades para dominar cualquier reto profesional</p>
                </div>
            </div>
        </div>

        <div class="hero-slide">
            <div class="hero-main-content">
                <img src="{{ asset('images/imagen10.jpg') }}" alt="Valores" class="main-image">
                <div class="diagonal-white">
                    <h1>Formación en Valores y Ética.</h1>
                    <p>Creamos ciudadanos responsables, empáticos y comprometidos con su sociedad.</p>
                </div>
                <div class="diagonal-blue">
                    <h2>Mentalidad Ganadora : Forjando líderes reales.</h2>
                    <p>Nuestro enfoque integral garantiza un crecimiento tanto profesional como personal.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pathway-section">
        <div class="pathway-container">
            <div class="pathway-grid">

                <div class="pathway-content">
                    <h2 class="pathway-title">Elige tu camino al éxito</h2>
                    <p class="pathway-description">
                        ¿Buscas una educación escolar innovadora o potenciar tus conocimientos para la universidad?
                        Contamos con la metodología exacta para lo que necesitas hoy.
                    </p>
                    <ul class="pathway-list">
                        <li><i class="fa-regular fa-circle-check"></i> Plan curricular actualizado.</li>
                        <li><i class="fa-regular fa-circle-check"></i> Docentes especializados por área.</li>
                        <li><i class="fa-regular fa-circle-check"></i> Seguimiento personalizado.</li>
                    </ul>

                    <div class="pathway-actions">
                        <a href="https://wa.me/51923317626" target="_blank" class="btn-whatsapp-pathway">
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
                            <img src="{{ asset('images/imagen10.jpg') }}" alt="Colegio">
                            <div class="path-card-overlay">
                                <h3>COLEGIO</h3>
                                <p>FORMATO NIÑOS UNIVERSITARIOS</p>
                            </div>
                        </div>

                        <div class="path-card path-card-bottom">
                            <img src="{{ asset('images/imagen10.jpg') }}" alt="Academia">
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

    <section class="info-organic-section">
        <div class="info-container">
            <div class="info-header">
                <h2 class="section-title-dark">¡Construimos el Futuro Educativo Contigo!</h2>
                <p class="info-intro">Ocho razones por las que somos la mejor opción para iniciar este camino escolar en
                    marzo.</p>
                <div class="title-underline"></div>
            </div>

            <div class="carrusel-wrapper">
                <button class="carrusel-btn prev" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>

                <div class="carrusel-container">
                    <div class="info-grid-carrusel" id="carruselTrack">
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-1"><i class="fa-solid fa-rocket"></i></div>
                            </div>
                            <h3>Enfoque Innovador</h3>
                            <p>Educación de vanguardia basada en proyectos y tecnología aplicada.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-2"><i class="fa-solid fa-seedling"></i></div>
                            </div>
                            <h3>Crecimiento Conjunto</h3>
                            <p>Iniciamos este camino en marzo, creando una comunidad donde el alumno es protagonista.
                            </p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-3"><i class="fa-solid fa-hand-holding-heart"></i></div>
                            </div>
                            <h3>Valores y Liderazgo</h3>
                            <p>Formación ética y liderazgo para los retos del mañana.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-4"><i class="fa-solid fa-school"></i></div>
                            </div>
                            <h3>Infraestructura</h3>
                            <p>Ambientes modernos y seguros diseñados para potenciar el aprendizaje.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-5"><i class="fa-solid fa-user-graduate"></i></div>
                            </div>
                            <h3>Plana Docente</h3>
                            <p>Profesores con amplia trayectoria académica y compromiso humano.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-6"><i class="fa-solid fa-language"></i></div>
                            </div>
                            <h3>Inglés Intensivo</h3>
                            <p>Dominio del idioma inglés como herramienta clave para el mundo global.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-7"><i class="fa-solid fa-palette"></i></div>
                            </div>
                            <h3>Talleres Creativos</h3>
                            <p>Desarrollo artístico y deportivo para una formación integral.</p>
                        </div>
                        <div class="info-blob-card">
                            <div class="blob-wrapper">
                                <div class="blob-shape shape-8"><i class="fa-solid fa-lock"></i></div>
                            </div>
                            <h3>Seguridad 24/7</h3>
                            <p>Tranquilidad total para los padres con sistemas de seguridad avanzados.</p>
                        </div>
                    </div>
                </div>

                <button class="carrusel-btn next" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <section class="valores-modern-section">
        <div class="valores-overlay">
            <div class="valores-container">
                <h2 class="section-title-light">Nuestros Valores</h2>

                <div class="valores-grid-custom">
                    <div class="valor-item">
                        <div class="icon-circle">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3>Excelencia Académica</h3>
                        <p>Compromiso con la calidad educativa y el desarrollo integral de nuestros estudiantes</p>
                    </div>

                    <div class="valor-item">
                        <div class="icon-circle">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h3>Innovación</h3>
                        <p>Métodos educativos modernos y tecnología de vanguardia para el aprendizaje</p>
                    </div>

                    <div class="valor-item">
                        <div class="icon-circle">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h3>Valores Humanos</h3>
                        <p>Formación en ética, respeto y responsabilidad social</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="docentes-carousel-section">
        <div class="info-container">
            <div class="info-header">
                <h2 class="section-title-dark">Nuestro Cuerpo de Docentes</h2>
                <p class="info-intro">Liderazgo y trayectoria al servicio de la formación de nuestros alumnos.</p>
                <div class="title-underline"></div>
            </div>

            <div class="docentes-carrusel-wrapper">
                <button class="doc-nav-btn prev" id="docPrevBtn"><i class="fa-solid fa-chevron-left"></i></button>

                <div class="docentes-overflow">
                    <div class="docentes-track" id="docentesTrack">
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                        <div class="docente-card-modern">
                            <div class="docente-img-box"><img src="{{ asset('images/imagen10.jpg') }}"
                                    alt="Docente"></div>
                            <div class="docente-content">
                                <h3>Nombre del Docente</h3>
                                <span class="doc-tag">Especialidad</span>
                                <p>Docente con amplia trayectoria en formación académica y valores para el éxito de
                                    nuestros alumnos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="doc-nav-btn next" id="docNextBtn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6 (Al costado de la UNU)
                    </p>
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
                    <a href="#">INTRANET</a>
                    <a href="#">PROTECCIÓN DE DATOS</a>
                    <a href="#">LIBRO DE RECLAMACIONES</a>

                    <div class="footer-social-icons">
                        <a href="https://www.tiktok.com/@next_level_novus" target="_blank" class="social-icon"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/next_level_novus/" target="_blank" class="social-icon"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/51923317625" target="_blank" class="social-icon"><i
                                class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=61581492196914" target="_blank"
                            class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
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
    <script src="{{ asset('js/carrusel-docentes.js') }}"></script>
</body>

</html>
