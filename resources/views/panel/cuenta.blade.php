@extends('panel.layout')

@section('title', 'Mi cuenta')

@section('content')
<div class="pm-head">
    <div>
        <h1>Mi cuenta</h1>
        <p class="pm-muted mb-0">Datos de tu acceso al panel de matrículas.</p>
    </div>
</div>

<div class="pm-grid">
    <div class="pm-col">
        <section class="pm-card">
            <h2><i class="bi bi-person-circle"></i> Datos</h2>
            <dl class="pm-dl">
                <dt>Nombre</dt><dd>{{ $personal->nombre }}</dd>
                <dt>Usuario</dt><dd><code>{{ $personal->usuario }}</code></dd>
                <dt>Último acceso</dt><dd>{{ $personal->ultimo_acceso?->format('d/m/Y H:i') ?? '—' }}</dd>
            </dl>
        </section>
    </div>

    <div class="pm-col">
        <section class="pm-card">
            <h2><i class="bi bi-shield-lock"></i> Cambiar contraseña</h2>
            <form action="{{ route('panel.cuenta.clave') }}" method="POST" class="pm-form">
                @csrf
                @method('PUT')
                <label class="form-label" for="clave_actual">Contraseña actual</label>
                <input id="clave_actual" type="password" name="clave_actual" class="form-control" autocomplete="current-password" required>

                <label class="form-label" for="clave_nueva">Nueva contraseña</label>
                <input id="clave_nueva" type="password" name="clave_nueva" class="form-control" autocomplete="new-password" minlength="8" required>
                <small class="pm-muted">Mínimo 8 caracteres, con letras y números.</small>

                <label class="form-label" for="clave_nueva_confirmation">Repite la nueva contraseña</label>
                <input id="clave_nueva_confirmation" type="password" name="clave_nueva_confirmation" class="form-control" autocomplete="new-password" required>

                <button class="pm-btn pm-btn-primary mt-3"><i class="bi bi-check2"></i> Guardar contraseña</button>
            </form>
        </section>
    </div>
</div>
@endsection
