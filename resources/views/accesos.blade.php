<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesos | Next Level</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/matricula-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/accesos.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
<body class="mt-page ac-body">
    <header class="ac-top">
        <div class="mt-container ac-top__inner">
            <a href="{{ route('web_principal') }}" class="ac-brand">
                <img src="{{ asset('images/next-level-logo.png') }}" alt="Next Level">
                <span>Next Level</span>
            </a>
            <a href="{{ route('web_principal') }}" class="ac-back"><i class="fa-solid fa-arrow-left"></i> Volver al inicio</a>
        </div>
    </header>

    <main class="mt-container ac-main">
        <h1>Accesos</h1>
        <p class="mt-muted ac-lead">Elige cómo quieres ingresar.</p>

        <div class="ac-grid">
            <section class="ac-card">
                <span class="ac-icon"><i class="fa-solid fa-user-graduate"></i></span>
                <h2>Estudiantes y familias</h2>
                <p>La plataforma de estudiantes estará disponible al inicio de clases. Ingresarás con el usuario y la contraseña que te enviamos por correo al verificar tu pago.</p>
                <p class="ac-note"><i class="fa-solid fa-key"></i> Usuario: tu DNI · Contraseña: tu fecha de nacimiento (ddmmaaaa)</p>
                <div class="ac-actions">
                    <a href="{{ route('matricula') }}" class="mt-btn mt-btn--primary"><i class="fa-solid fa-pen-to-square"></i> Matricularme</a>
                    <a href="https://wa.me/{{ config('matricula.whatsapp') }}" target="_blank" rel="noopener" class="mt-btn mt-btn--ghost"><i class="fa-brands fa-whatsapp"></i> {{ config('matricula.telefono') }}</a>
                </div>
            </section>

            <section class="ac-card">
                <span class="ac-icon is-navy"><i class="fa-solid fa-user-tie"></i></span>
                <h2>Personal administrativo</h2>
                <p>Revisa las matrículas, verifica los pagos y administra los ciclos desde el panel de matrículas.</p>
                <div class="ac-actions">
                    <a href="{{ route('panel.login') }}" class="mt-btn mt-btn--primary"><i class="fa-solid fa-right-to-bracket"></i> Panel de matrículas</a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
