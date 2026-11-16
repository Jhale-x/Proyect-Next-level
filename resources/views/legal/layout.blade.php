<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') | Next Level</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/matricula-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/accesos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/legal.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
<body class="mt-page ac-body">
    <header class="ac-top">
        <div class="mt-container ac-top__inner">
            <a href="{{ route('web_principal') }}" class="ac-brand">
                <img src="{{ asset('images/next-level-logo.png') }}" alt="Next Level">
                <span>Next Level</span>
            </a>
            <a href="{{ route('web_principal') }}" class="ac-back"><i class="fa-solid fa-arrow-left"></i> <span>Volver al inicio</span></a>
        </div>
    </header>

    <main class="mt-container lg-main">
        <nav class="lg-tabs" aria-label="Documentos legales">
            <a href="{{ route('legal.terminos') }}" @class(['is-active' => request()->routeIs('legal.terminos')])>Términos y Condiciones</a>
            <a href="{{ route('legal.privacidad') }}" @class(['is-active' => request()->routeIs('legal.privacidad')])>Política de Privacidad</a>
        </nav>

        <article class="lg-doc">
            <h1>@yield('titulo')</h1>
            <p class="mt-muted lg-fecha">Última actualización: 16 de noviembre de 2026</p>

            @yield('contenido')

            <section class="lg-contacto">
                <h2>Contacto</h2>
                <p>Si tienes dudas sobre este documento, escríbenos o llámanos:</p>
                <ul>
                    <li><i class="fa-solid fa-envelope"></i> contacto@nextlevel.edu.pe</li>
                    <li><i class="fa-brands fa-whatsapp"></i> <a href="https://wa.me/{{ config('matricula.whatsapp') }}" target="_blank" rel="noopener">{{ config('matricula.telefono') }}</a></li>
                    <li><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6 (al costado de la UNU), Pucallpa</li>
                </ul>
            </section>
        </article>
    </main>
</body>
</html>
