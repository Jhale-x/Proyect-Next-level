<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Resultado del pago | Next Level</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/matricula-base.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
    <style>
        .pr-page { min-height: 100vh; background: var(--mt-bg); display: grid; place-items: center; padding: 32px 16px; }
        .pr-card { width: 100%; max-width: 520px; background: var(--mt-white); border-radius: var(--mt-radius); box-shadow: var(--mt-shadow); padding: 32px 28px; text-align: center; }
        .pr-card { overflow: hidden; }
        .pr-brand { background: var(--mt-navy); margin: -32px -28px 24px; padding: 16px; }
        .pr-logo { height: 36px; display: block; margin: 0 auto; }
        .pr-icon { width: 72px; height: 72px; border-radius: 50%; display: grid; place-items: center; margin: 0 auto 16px; font-size: 2rem; }
        .pr-icon--ok { background: var(--mt-green-50); color: var(--mt-green); }
        .pr-icon--error { background: var(--mt-red-50); color: var(--mt-red); }
        .pr-icon--info { background: var(--mt-amber-50); color: #B45309; }
        .pr-card h1 { color: var(--mt-ink); font-size: 1.5rem; margin: 0 0 8px; }
        .pr-card p { margin: 0 0 16px; line-height: 1.55; }
        .pr-datos { text-align: left; background: var(--mt-bg); border-radius: var(--mt-radius-sm); padding: 14px 16px; margin: 20px 0; display: grid; gap: 6px; font-size: .92rem; }
        .pr-datos div { display: flex; justify-content: space-between; gap: 12px; }
        .pr-datos dt { color: var(--mt-muted); }
        .pr-datos dd { margin: 0; font-weight: 700; color: var(--mt-ink); text-align: right; overflow-wrap: anywhere; }
        @media (max-width: 480px) {
            .pr-card { padding: 28px 18px; }
            .pr-brand { margin: -28px -18px 20px; }
            .pr-datos div { flex-direction: column; gap: 0; }
            .pr-datos dd { text-align: left; }
        }
        .pr-acciones { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .pr-msg { color: var(--mt-red); font-size: .9rem; }
    </style>
</head>
@php
    $estado = $ok === true ? 'ok' : ($ok === false ? 'error' : 'info');
    $titulo = ['ok' => '¡Pago aprobado!', 'error' => 'El pago no se completó', 'info' => 'Pago pendiente'][$estado];
    $icono = ['ok' => 'fa-circle-check', 'error' => 'fa-circle-xmark', 'info' => 'fa-clock'][$estado];
    $puedeReintentar = $estado !== 'ok' && $matricula->estado === \App\Models\Matricula::ESTADO_PENDIENTE && !$matricula->esta_vencida
        && app(\App\Services\NiubizService::class)->activo();
@endphp
<body class="mt-page">
    <main class="pr-page">
        <section class="pr-card" aria-live="polite">
            <div class="pr-brand"><img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="pr-logo"></div>
            <div class="pr-icon pr-icon--{{ $estado }}"><i class="fa-solid {{ $icono }}"></i></div>
            <h1>{{ $titulo }}</h1>
            <p>{{ $mensaje ?? ($estado === 'ok' ? 'Tu matrícula está confirmada.' : 'Tu matrícula sigue pendiente de pago.') }}</p>

            <dl class="pr-datos">
                <div><dt>Código de matrícula</dt><dd>{{ $matricula->codigo }}</dd></div>
                <div><dt>Alumno</dt><dd>{{ $matricula->alumno_nombre_completo }}</dd></div>
                <div><dt>Monto</dt><dd>S/ {{ number_format($matricula->monto_pagado ?? $matricula->monto_total, 2) }}</dd></div>
                @if($matricula->id_transaccion)
                    <div><dt>N° de operación</dt><dd>{{ $matricula->id_transaccion }}</dd></div>
                @endif
                @if($matricula->fecha_pago)
                    <div><dt>Fecha de pago</dt><dd>{{ $matricula->fecha_pago->format('d/m/Y H:i') }}</dd></div>
                @endif
                @if($estado === 'ok')
                    <div><dt>Usuario</dt><dd>Tu DNI</dd></div>
                    <div><dt>Contraseña</dt><dd>Fecha de nacimiento (ddmmaaaa)</dd></div>
                @endif
            </dl>

            <div class="pr-acciones">
                @if($puedeReintentar)
                    <button type="button" class="mt-btn mt-btn--primary" id="prReintentar"
                            data-codigo="{{ $matricula->codigo }}" data-monto="{{ $matricula->monto_total }}">
                        <i class="fa-solid fa-rotate-right"></i> Intentar el pago otra vez
                    </button>
                @endif
                <a href="https://wa.me/{{ config('matricula.whatsapp') }}?text={{ rawurlencode("Hola, tengo una consulta sobre el pago de mi matrícula {$matricula->codigo}.") }}"
                   target="_blank" rel="noopener" class="mt-btn mt-btn--whatsapp"><i class="fa-brands fa-whatsapp"></i> Escríbenos</a>
                <a href="{{ route('web.inicio') }}" class="mt-btn mt-btn--ghost"><i class="fa-solid fa-house"></i> Ir al inicio</a>
            </div>
            <p class="pr-msg" id="prMsg" role="alert" hidden></p>
        </section>
    </main>

    @if($puedeReintentar)
        @include('partials.niubiz')
        <script>
            document.getElementById('prReintentar').addEventListener('click', (e) => {
                const b = e.currentTarget, msg = document.getElementById('prMsg');
                msg.hidden = true;
                window.PagoOnline.pagar({
                    codigo: b.dataset.codigo,
                    monto: b.dataset.monto,
                    onError: (t) => { msg.textContent = t; msg.hidden = false; },
                });
            });
        </script>
    @endif
</body>
</html>
