<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Panel de Matrículas') | Next Level</title>
    <link rel="icon" href="{{ asset('images/next-level-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('css/panel/panel.css') }}">
</head>
<body class="pm-body">
@php($personal = auth('matricula')->user())
<header class="pm-topbar">
    <div class="pm-wrap pm-topbar-inner">
        <a href="{{ route('panel.index') }}" class="pm-brand">
            <img src="{{ asset('images/next-level-logo.png') }}" alt="Next Level">
            <span>
                <strong>Next Level</strong>
                <small>Panel de Matrículas</small>
            </span>
        </a>

        <button class="pm-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#pmNav" aria-controls="pmNav" aria-expanded="false" aria-label="Abrir menú">
            <i class="bi bi-list"></i>
        </button>

        <nav class="pm-nav collapse" id="pmNav">
            <a href="{{ route('panel.index') }}" class="{{ request()->routeIs('panel.index', 'panel.show') ? 'active' : '' }}">
                <i class="bi bi-journal-check"></i> Matrículas
            </a>
            <a href="{{ route('panel.ciclos.index') }}" class="{{ request()->routeIs('panel.ciclos.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Ciclos
            </a>
            <a href="{{ route('panel.cuenta') }}" class="{{ request()->routeIs('panel.cuenta') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Mi cuenta
            </a>
            <span class="pm-user"><i class="bi bi-person-circle"></i> {{ $personal->nombre }}</span>
            <form action="{{ route('panel.logout') }}" method="POST">
                @csrf
                <button type="submit" class="pm-logout"><i class="bi bi-box-arrow-right"></i> Salir</button>
            </form>
        </nav>
    </div>
</header>

<main class="pm-wrap pm-main">
    @if(session('success'))
        <div class="alert alert-success pm-alert"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger pm-alert"><i class="bi bi-exclamation-triangle"></i> {{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger pm-alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @yield('content')
</main>

<footer class="pm-footer">
    <div class="pm-wrap">Colegio y Academia Next Level · Pucallpa · Panel de uso interno</div>
</footer>

{{-- Confirmación propia del panel (los formularios con data-confirmar la usan en lugar del confirm() del navegador) --}}
<div class="modal fade" id="pmConfirmar" tabindex="-1" aria-labelledby="pmConfirmarTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pm-modal">
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title fs-5 fw-bold" id="pmConfirmarTitulo">Confirmar acción</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="pmConfirmarTexto"></div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="pm-btn pm-btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="pm-btn pm-btn-primary" id="pmConfirmarSi">Sí, continuar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        const el = document.getElementById('pmConfirmar');
        const modal = new bootstrap.Modal(el);
        const btnSi = document.getElementById('pmConfirmarSi');
        let pendiente = null;

        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (!form.dataset.confirmar) return;
            e.preventDefault();
            pendiente = form;
            const peligro = form.dataset.confirmarTipo === 'peligro';
            document.getElementById('pmConfirmarTexto').textContent = form.dataset.confirmar;
            btnSi.textContent = peligro ? 'Sí, eliminar' : 'Sí, continuar';
            if (form.dataset.confirmar.startsWith('¿Cancelar')) btnSi.textContent = 'Sí, cancelar';
            btnSi.className = 'pm-btn ' + (peligro ? 'pm-btn-danger' : 'pm-btn-primary');
            modal.show();
        });

        btnSi.addEventListener('click', () => {
            if (!pendiente) return;
            btnSi.disabled = true;
            pendiente.submit();   // submit() no vuelve a disparar el evento, así que no pide confirmar otra vez
        });
        el.addEventListener('hidden.bs.modal', () => { pendiente = null; btnSi.disabled = false; });
        el.addEventListener('shown.bs.modal', () => btnSi.focus());
    })();
</script>
</body>
</html>
