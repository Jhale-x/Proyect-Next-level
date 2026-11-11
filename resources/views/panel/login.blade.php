<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Ingresar | Panel de Matrículas</title>
    <link rel="icon" href="{{ asset('images/next-level-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('css/panel/panel.css') }}">
</head>
<body class="pm-login-body">
<main class="pm-login">
    <section class="pm-login-side" aria-hidden="true">
        <img src="{{ asset('images/next-level-logo.png') }}" alt="">
        <h2>Panel de Matrículas</h2>
        <p>Revisa las inscripciones, verifica los pagos y envía las credenciales de bienvenida.</p>
        <ul>
            <li><i class="bi bi-search"></i> Busca por código, DNI o nombre</li>
            <li><i class="bi bi-cash-coin"></i> Verifica pagos en un clic</li>
            <li><i class="bi bi-envelope-check"></i> El correo de bienvenida sale solo</li>
        </ul>
    </section>

    <section class="pm-login-card">
        <img class="pm-login-logo" src="{{ asset('images/next-level-logo.png') }}" alt="Next Level">
        <p class="pm-tag">Uso interno</p>
        <h1>Iniciar sesión</h1>
        <p class="pm-muted">Ingresa con la cuenta que te dio la dirección.</p>

        @if(session('error'))
            <div class="pm-login-msg is-error" role="alert"><i class="bi bi-exclamation-triangle"></i> {{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="pm-login-msg is-ok" role="status"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="pm-login-msg is-error" role="alert"><i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('panel.login.post') }}" novalidate>
            @csrf
            <label for="usuario">Usuario</label>
            <div class="pm-field">
                <i class="bi bi-person"></i>
                <input id="usuario" name="usuario" type="text" value="{{ old('usuario') }}" autocomplete="username" required autofocus>
            </div>

            <label for="password">Contraseña</label>
            <div class="pm-field">
                <i class="bi bi-lock"></i>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                <button type="button" class="pm-eye" aria-label="Mostrar contraseña"
                        onclick="const i=document.getElementById('password');i.type=i.type==='password'?'text':'password';this.firstElementChild.className=i.type==='password'?'bi bi-eye':'bi bi-eye-slash'">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <label class="pm-check">
                <input type="checkbox" name="recordar" value="1"> Mantener la sesión iniciada
            </label>

            <button type="submit" class="pm-btn pm-btn-primary w-100">Ingresar <i class="bi bi-arrow-right"></i></button>
        </form>

        <p class="pm-login-foot">¿Olvidaste tu contraseña? Pídele a la dirección que la restablezca.</p>
    </section>
</main>
</body>
</html>
