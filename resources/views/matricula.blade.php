<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Matrícula 100% online | Next Level</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/matricula-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/Matricula.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/chatbot.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
@php
    $pago = config('matricula.pago');
    $soles = fn ($m) => $m !== null ? 'S/ ' . number_format($m, 2) : null;
@endphp
<body class="mt-page">
    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2027 abierta! &nbsp;&nbsp;&nbsp;&nbsp; 💳 5% de descuento pagando al contado &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web_principal') }}" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>
            <button class="mobile-menu-toggle" id="menuOpen" type="button" aria-label="Abrir menú">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="nav-menu">
                <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Qué ofrecemos</a></li>
                        <li><a href="#">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li><a href="#pagos">PAGOS</a></li>
                <li><a href="{{ route('matricula') }}" class="active">MATRÍCULAS</a></li>
                <li><a href="{{ route('portal') }}">INTRANET</a></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-menu-overlay" id="menuOverlay"></div>
    <div class="mobile-side-menu" id="sideMenu">
        <div class="menu-header">
            <span>MENÚ</span>
            <button class="close-menu" id="menuClose" type="button" aria-label="Cerrar menú"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="menu-panel active">
            <ul class="mobile-nav-list">
                <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                <li><a href="{{ route('matricula') }}">MATRÍCULAS</a></li>
                <li><a href="{{ route('portal') }}">INTRANET</a></li>
            </ul>
        </div>
    </div>

    <main>
        {{-- ================= HERO + VERIFICACIÓN ================= --}}
        <section class="mt-hero" style="--mt-hero-img: url('{{ asset('images/imagen10.jpg') }}')">
            <div class="mt-container mt-hero__grid">
                <div class="mt-hero__copy">
                    <span class="mt-eyebrow"><i class="fa-solid fa-circle-check"></i> Matrícula 2027 · 100% online</span>
                    <h1>Asegura tu vacante<br><span>en menos de 10 minutos</span></h1>
                    <p class="mt-hero__lead">Matricúlate en el Colegio o en la Academia preuniversitaria desde tu celular. Verifica tu DNI, elige tu programa y paga de forma segura.</p>
                    <ul class="mt-hero__perks">
                        <li><i class="fa-solid fa-tag"></i> 5% de descuento al contado</li>
                        <li><i class="fa-solid fa-user-shield"></i> Datos validados con RENIEC</li>
                        <li><i class="fa-solid fa-envelope-open-text"></i> Credenciales por correo</li>
                    </ul>
                </div>

                <div class="mt-card mt-verify" id="verificar">
                    <h2>Comienza tu matrícula</h2>
                    <p class="mt-muted">Ingresa el DNI del estudiante o de su apoderado.</p>

                    @if(session('error'))
                        <div class="mt-alert mt-alert--error" role="alert"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mt-alert mt-alert--error" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('matricula.verificar.post') }}" method="POST" id="enrollmentForm" novalidate>
                        @csrf
                        <div class="mt-segmented" role="radiogroup" aria-label="Tipo de documento">
                            <label><input type="radio" name="tipo_doc" value="dni" checked> <span>DNI</span></label>
                            <label class="is-disabled" title="Próximamente"><input type="radio" name="tipo_doc" value="ce" disabled> <span>Carné de extranjería <small>Pronto</small></span></label>
                        </div>

                        <div class="mt-field">
                            <label for="documento">Número de DNI</label>
                            <input type="text" name="documento" id="documento" inputmode="numeric" maxlength="8"
                                   placeholder="Ej. 70001234" value="{{ old('documento') }}" autocomplete="off" required>
                        </div>

                        <div class="mt-field">
                            <label for="codigo">
                                Código de verificación (CV)
                                <button type="button" class="mt-help" id="helpIcon" aria-expanded="false" aria-controls="helpTooltip">
                                    <i class="fa-solid fa-circle-question"></i> ¿Dónde lo encuentro?
                                </button>
                            </label>
                            <div class="mt-cv">
                                <span class="mt-cv__dni" id="cvPreview">________</span>
                                <span class="mt-cv__dash">–</span>
                                <input type="text" name="codigo" id="codigo" inputmode="numeric" maxlength="1"
                                       placeholder="0" value="{{ old('codigo') }}" autocomplete="off" required aria-describedby="helpTooltip">
                            </div>
                            <div class="mt-tooltip" id="helpTooltip" hidden>
                                <img src="{{ asset('images/DNI-Next-Level.png') }}" alt="Ubicación del código de verificación en el DNI">
                                <p>Es el <strong>dígito después del guion</strong> junto a tu número de DNI. Ej.: 12345678-<strong>5</strong></p>
                            </div>
                        </div>

                        <button type="submit" class="mt-btn mt-btn--primary mt-btn--block" id="btnVerify">
                            Verificar y continuar <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>

                    <div class="mt-divider"><span>o</span></div>
                    <button type="button" class="mt-btn mt-btn--ghost mt-btn--block" onclick="window.abrirChatbot && window.abrirChatbot('matrícula')">
                        <i class="fa-regular fa-comments"></i> Matricúlate por chat con nuestro asistente
                    </button>
                </div>
            </div>
        </section>

        {{-- ================= CÓMO FUNCIONA ================= --}}
        <section class="mt-section">
            <div class="mt-container">
                <header class="mt-section__head">
                    <span class="mt-kicker">Así de simple</span>
                    <h2>¿Cómo funciona la matrícula?</h2>
                </header>
                <ol class="mt-steps">
                    <li><span class="mt-steps__n">1</span><i class="fa-solid fa-id-card"></i><h3>Verifica tu DNI</h3><p>Validamos tu identidad con RENIEC usando tu DNI y su código de verificación.</p></li>
                    <li><span class="mt-steps__n">2</span><i class="fa-solid fa-graduation-cap"></i><h3>Elige tu programa</h3><p>Colegio o Academia, sede, turno y ciclo. Verás el precio al instante.</p></li>
                    <li><span class="mt-steps__n">3</span><i class="fa-solid fa-user-pen"></i><h3>Completa tus datos</h3><p>Datos del estudiante y, si es menor de edad, de su apoderado.</p></li>
                    <li><span class="mt-steps__n">4</span><i class="fa-solid fa-wallet"></i><h3>Paga y listo</h3><p>Al verificar tu pago te enviamos por correo tu usuario y contraseña de acceso.</p></li>
                </ol>
            </div>
        </section>

        {{-- ================= MODALIDADES ================= --}}
        <section class="mt-section mt-section--tint">
            <div class="mt-container">
                <header class="mt-section__head">
                    <span class="mt-kicker">Programas</span>
                    <h2>Elige tu modalidad</h2>
                </header>
                <div class="mt-programs">
                    <article class="mt-program">
                        <div class="mt-program__icon"><i class="fa-solid fa-school"></i></div>
                        <h3>Colegio</h3>
                        <p>Primaria y Secundaria con enfoque en ciencias y valores. Turnos mañana y tarde.</p>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Primaria: 1° a 6° grado</li>
                            <li><i class="fa-solid fa-check"></i> Secundaria: 1° a 5° grado</li>
                            <li><i class="fa-solid fa-check"></i> Secciones A – E</li>
                        </ul>
                        @if($soles($desdeColegio))
                            <p class="mt-program__price">Matrícula desde <strong>{{ $soles($desdeColegio) }}</strong></p>
                        @endif
                        <a href="#verificar" class="mt-btn mt-btn--outline">Matricular en Colegio</a>
                    </article>
                    <article class="mt-program mt-program--featured">
                        <span class="mt-badge">Preuniversitario</span>
                        <div class="mt-program__icon"><i class="fa-solid fa-building-columns"></i></div>
                        <h3>Academia</h3>
                        <p>Preparación para UNU, UNIA, San Marcos, UNI y PUCP. Ciclos verano, semestral y anual.</p>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Turnos mañana, tarde y noche</li>
                            <li><i class="fa-solid fa-check"></i> Simulacros tipo admisión</li>
                            <li><i class="fa-solid fa-check"></i> Ciclos según tu universidad</li>
                        </ul>
                        @if($soles($desdeAcademia))
                            <p class="mt-program__price">Matrícula desde <strong>{{ $soles($desdeAcademia) }}</strong></p>
                        @endif
                        <a href="#verificar" class="mt-btn mt-btn--primary">Matricular en Academia</a>
                    </article>
                </div>
            </div>
        </section>

        {{-- ================= PAGOS ================= --}}
        <section class="mt-section" id="pagos">
            <div class="mt-container">
                <header class="mt-section__head">
                    <span class="mt-kicker">Pagos</span>
                    <h2>Formas de pago</h2>
                    <p class="mt-muted">Paga dentro de las 24 horas siguientes a tu registro e indica tu código de matrícula.</p>
                </header>
                <div class="mt-pay">
                    <div class="mt-card mt-pay__qr">
                        <h3><i class="fa-solid fa-qrcode"></i> Paga con QR</h3>
                        <p class="mt-muted">Yape, Plin, BBVA o cualquier billetera digital.</p>
                        <img src="{{ asset($pago['qr']) }}" alt="Código QR de pago" loading="lazy">
                    </div>
                    <div class="mt-card mt-pay__bank">
                        <h3><i class="fa-solid fa-building-columns"></i> Transferencia {{ $pago['banco'] }}</h3>
                        <dl>
                            <div><dt>N° de cuenta</dt><dd>{{ $pago['cuenta'] }}</dd></div>
                            <div><dt>CCI</dt><dd>{{ $pago['cci'] }}</dd></div>
                            <div><dt>Titular</dt><dd>{{ $pago['titular'] }}</dd></div>
                        </dl>
                        <p class="mt-note"><i class="fa-solid fa-envelope"></i> <span>Cuando verifiquemos tu pago recibirás un correo con tu <strong>usuario (DNI)</strong> y <strong>contraseña (fecha de nacimiento)</strong>.</span></p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= PREGUNTAS FRECUENTES ================= --}}
        <section class="mt-section mt-section--tint">
            <div class="mt-container mt-faq-grid">
                <header class="mt-section__head mt-section__head--left">
                    <span class="mt-kicker">Dudas</span>
                    <h2>Preguntas frecuentes</h2>
                    <p class="mt-muted">¿No encuentras tu respuesta? Escríbenos por WhatsApp al {{ config('matricula.telefono') }}.</p>
                    <div class="mt-video">
                        <iframe src="https://www.youtube.com/embed/oKoNDgJk6SQ" title="Video Next Level" loading="lazy"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </header>
                <div class="mt-faq">
                    <details open>
                        <summary>¿Qué necesito para matricularme?</summary>
                        <p>El DNI del estudiante con su código de verificación (CV), un correo, un celular y la fecha de nacimiento. Si el estudiante es menor de edad, también los datos del apoderado.</p>
                    </details>
                    <details>
                        <summary>¿Qué es el código de verificación (CV)?</summary>
                        <p>Es el dígito que aparece después del guion junto a tu número de DNI. Lo usamos para confirmar tu identidad con RENIEC.</p>
                    </details>
                    <details>
                        <summary>¿Cuánto tiempo tengo para pagar?</summary>
                        <p>24 horas desde que registras tu matrícula. Si no pagas en ese plazo, tu código vence y deberás registrarte de nuevo.</p>
                    </details>
                    <details>
                        <summary>¿Cuándo recibo mis credenciales?</summary>
                        <p>Apenas verifiquemos tu pago te enviamos un correo de bienvenida. Tu usuario es tu DNI y tu contraseña es tu fecha de nacimiento (ddmmaaaa).</p>
                    </details>
                    <details>
                        <summary>¿Puedo matricularme por chat?</summary>
                        <p>Sí. Nuestro asistente te guía paso a paso con las mismas opciones del formulario. Pulsa el botón del chat en la esquina inferior.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> +51 {{ config('matricula.telefono') }}</p>
                    <p><i class="fa-solid fa-location-dot"></i> Pucallpa, Perú</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© {{ date('Y') }} Next Level. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    @include('partials.chatbot')

    <script src="{{ asset('js/marquee_principal.js') }}"></script>
    <script src="{{ asset('js/nav-scroll.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>
    @include('partials.culqi')
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('enrollmentForm');
        const doc = document.getElementById('documento');
        const cv = document.getElementById('codigo');
        const preview = document.getElementById('cvPreview');
        const btn = document.getElementById('btnVerify');
        const help = document.getElementById('helpIcon');
        const tip = document.getElementById('helpTooltip');

        const soloDigitos = (el, max) => el.addEventListener('input', () => {
            el.value = el.value.replace(/\D/g, '').slice(0, max);
            if (el === doc) {
                preview.textContent = (el.value + '________').slice(0, 8);
                if (el.value.length === 8) cv.focus();
            }
        });
        soloDigitos(doc, 8);
        soloDigitos(cv, 1);
        preview.textContent = (doc.value + '________').slice(0, 8);

        help.addEventListener('click', () => {
            tip.hidden = !tip.hidden;
            help.setAttribute('aria-expanded', String(!tip.hidden));
        });

        form.addEventListener('submit', (e) => {
            const errores = [];
            if (!/^\d{8}$/.test(doc.value)) errores.push(doc);
            if (!/^\d$/.test(cv.value)) errores.push(cv);
            [doc, cv].forEach(el => el.classList.toggle('is-invalid', errores.includes(el)));
            if (errores.length) {
                e.preventDefault();
                errores[0].focus();
                return;
            }
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Verificando con RENIEC...';
        });
    });
    </script>
</body>
</html>
