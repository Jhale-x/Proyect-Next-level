@extends('panel.layout')

@section('title', $ciclo->exists ? 'Editar ciclo' : 'Nuevo ciclo')

@section('content')
@php
    $academia = (int) old('id_modalidad', $ciclo->id_modalidad) === 2;
    $sel = fn ($campo) => old($campo, $ciclo->{$campo});
@endphp

<a href="{{ route('panel.ciclos.index') }}" class="pm-back"><i class="bi bi-arrow-left"></i> Volver a ciclos</a>

<div class="pm-head">
    <div>
        <h1>{{ $ciclo->exists ? $ciclo->nombre : 'Nuevo ciclo' }}</h1>
        <p class="pm-muted mb-0">
            @if($ciclo->exists)
                <code>{{ $ciclo->codigo }}</code> · {{ $ciclo->matriculas_count }} {{ $ciclo->matriculas_count === 1 ? 'matrícula registrada' : 'matrículas registradas' }}
            @else
                Al guardarlo se crea su cuota de matrícula y aparece en la matrícula en línea si está activo.
            @endif
        </p>
    </div>
    @if($ciclo->exists)
        <div class="d-flex flex-wrap gap-2">
            <form action="{{ route('panel.ciclos.duplicar', $ciclo->id_ciclo) }}" method="POST" data-confirmar="Se creará una copia desactivada de este ciclo con sus cuotas. ¿Continuar?">
                @csrf
                <button class="pm-btn pm-btn-light"><i class="bi bi-copy"></i> Duplicar</button>
            </form>
            <form action="{{ route('panel.ciclos.estado', $ciclo->id_ciclo) }}" method="POST">
                @csrf
                @method('PATCH')
                <button class="pm-btn {{ $ciclo->activo ? 'pm-btn-danger-light' : 'pm-btn-green' }}">
                    <i class="bi {{ $ciclo->activo ? 'bi-eye-slash' : 'bi-eye' }}"></i> {{ $ciclo->activo ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
        </div>
    @endif
</div>

@if($ciclo->exists)
    @if(!$ciclo->activo)
        <div class="alert alert-secondary pm-alert"><i class="bi bi-eye-slash"></i> Este ciclo está <strong>desactivado</strong>: no aparece en la matrícula en línea.</div>
    @elseif($ciclo->fecha_fin->lt(today()))
        <div class="alert alert-warning pm-alert"><i class="bi bi-calendar-x"></i> Este ciclo ya <strong>finalizó</strong> ({{ $ciclo->fecha_fin->format('d/m/Y') }}): no aparece en la matrícula en línea. Cambia la fecha de fin o duplícalo para una nueva campaña.</div>
    @elseif(!$monto)
        <div class="alert alert-warning pm-alert"><i class="bi bi-exclamation-triangle"></i> Este ciclo <strong>no tiene cuotas</strong>: no aparece en la matrícula en línea hasta que le agregues una cuota de matrícula.</div>
    @else
        <div class="alert alert-success pm-alert"><i class="bi bi-check-circle"></i> Visible en la matrícula en línea. El alumno paga <strong>S/ {{ number_format($monto['total'], 2) }}</strong>: matrícula de S/ {{ number_format($monto['importe'], 2) }} menos el 5 % de descuento al contado.</div>
    @endif
@endif

<div class="pm-grid {{ $ciclo->exists ? '' : 'pm-grid-1' }}">
    <section class="pm-card">
        <h2><i class="bi bi-calendar3"></i> Datos del ciclo</h2>
        <form action="{{ $ciclo->exists ? route('panel.ciclos.update', $ciclo->id_ciclo) : route('panel.ciclos.store') }}" method="POST" class="pm-form" id="formCiclo">
            @csrf
            @if($ciclo->exists) @method('PUT') @endif

            <label class="form-label">Modalidad</label>
            <div class="pm-segment">
                @foreach($modalidades as $id => $nombre)
                    <label><input type="radio" name="id_modalidad" value="{{ $id }}" @checked((int) $sel('id_modalidad') === $id)><span>{{ $nombre }}</span></label>
                @endforeach
            </div>

            <label class="form-label" for="nombre">Nombre</label>
            <input id="nombre" name="nombre" class="form-control" maxlength="150" required value="{{ $sel('nombre') }}" placeholder="Ej.: UNU - Ciclo Verano (Mañana)">

            <div class="pm-form-2">
                <div>
                    <label class="form-label" for="codigo">Código</label>
                    <input id="codigo" name="codigo" class="form-control" maxlength="50" value="{{ $sel('codigo') }}" placeholder="Se genera solo si lo dejas vacío">
                </div>
                <div>
                    <label class="form-label" for="id_sede">Sede</label>
                    <select id="id_sede" name="id_sede" class="form-select" required>
                        @foreach($catalogo['sedes'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_sede') == $o['id'])>{{ $o['nombre'] }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="fecha_inicio">Fecha de inicio</label>
                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control" required value="{{ old('fecha_inicio', $ciclo->fecha_inicio?->format('Y-m-d')) }}">
                </div>
                <div>
                    <label class="form-label" for="fecha_fin">Fecha de fin</label>
                    <input id="fecha_fin" type="date" name="fecha_fin" class="form-control" required value="{{ old('fecha_fin', $ciclo->fecha_fin?->format('Y-m-d')) }}">
                </div>
                <div>
                    <label class="form-label" for="id_entorno">Entorno</label>
                    <select id="id_entorno" name="id_entorno" class="form-select" required>
                        @foreach($catalogo['entornos'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_entorno') == $o['id'])>{{ $o['nombre'] }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="id_turno">Turno</label>
                    <select id="id_turno" name="id_turno" class="form-select" required>
                        @foreach($catalogo['turnos'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_turno') == $o['id'])>{{ $o['nombre'] }} · {{ $o['detalle'] }}</option>@endforeach
                    </select>
                </div>
                <div data-solo="2" @unless($academia) hidden @endunless>
                    <label class="form-label" for="id_universidad">Universidad</label>
                    <select id="id_universidad" name="id_universidad" class="form-select">
                        <option value="">Elegir…</option>
                        @foreach($catalogo['universidades'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_universidad') == $o['id'])>{{ $o['nombre'] }}</option>@endforeach
                    </select>
                </div>
                <div data-solo="2" @unless($academia) hidden @endunless>
                    <label class="form-label" for="id_tipo_ciclo">Tipo de ciclo</label>
                    <select id="id_tipo_ciclo" name="id_tipo_ciclo" class="form-select">
                        <option value="">Elegir…</option>
                        @foreach($catalogo['tiposCiclo'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_tipo_ciclo') == $o['id'])>{{ $o['nombre'] }}{{ $o['detalle'] ? ' · ' . $o['detalle'] : '' }}</option>@endforeach
                    </select>
                </div>
                <div data-solo="1" @if($academia) hidden @endif>
                    <label class="form-label" for="id_nivel">Nivel</label>
                    <select id="id_nivel" name="id_nivel" class="form-select">
                        <option value="">Elegir…</option>
                        @foreach($catalogo['niveles'] as $o)<option value="{{ $o['id'] }}" @selected($sel('id_nivel') == $o['id'])>{{ $o['nombre'] }}</option>@endforeach
                    </select>
                </div>
                @unless($ciclo->exists)
                    <div>
                        <label class="form-label" for="monto_matricula">Monto de la matrícula (S/)</label>
                        <input id="monto_matricula" type="number" step="0.01" min="0" name="monto_matricula" class="form-control" required value="{{ old('monto_matricula') }}" placeholder="Ej.: 500.00">
                        <small class="pm-muted">Antes del 5 % de descuento al contado.</small>
                    </div>
                @endunless
            </div>

            <label class="pm-switch">
                <input type="hidden" name="activo" value="0">
                <input type="checkbox" name="activo" value="1" @checked(old('activo', $ciclo->activo))>
                <span>Activo (se muestra en la matrícula en línea)</span>
            </label>

            <button class="pm-btn pm-btn-primary mt-2"><i class="bi bi-check2"></i> {{ $ciclo->exists ? 'Guardar cambios' : 'Crear ciclo' }}</button>
        </form>
    </section>

    @if($ciclo->exists)
        <section class="pm-card">
            <h2><i class="bi bi-cash-stack"></i> Cuotas</h2>
            <p class="pm-muted small">La cuota llamada <strong>«Matrícula»</strong> es la que se cobra al matricularse. Las demás son las pensiones del ciclo.</p>

            @if($duplicadas)
                <div class="alert alert-warning pm-alert py-2 small"><i class="bi bi-exclamation-triangle"></i> Hay cuotas repetidas (marcadas en amarillo). Puedes eliminar las sobrantes.</div>
            @endif

            <div class="pm-cuota-leyenda small pm-muted"><span>Nombre</span><span>N°</span><span>Monto (S/)</span><span>Vencimiento</span><span></span></div>
            <div class="pm-cuotas">
                @forelse($ciclo->cuotas as $cuota)
                    <form action="{{ route('panel.cuotas.update', $cuota->id_cuota) }}" method="POST" class="pm-cuota {{ in_array($cuota->id_cuota, $duplicadas) ? 'is-dup' : '' }}">
                        @csrf
                        @method('PUT')
                        <input name="nombre" class="form-control form-control-sm" value="{{ $cuota->nombre }}" aria-label="Nombre" required>
                        <input name="numero" type="number" min="0" class="form-control form-control-sm" value="{{ $cuota->numero }}" aria-label="Número" title="Número" required>
                        <input name="monto" type="number" step="0.01" min="0" class="form-control form-control-sm" value="{{ $cuota->monto }}" aria-label="Monto" title="Monto (S/)" required>
                        <input name="fecha_vencimiento" type="date" class="form-control form-control-sm" value="{{ $cuota->fecha_vencimiento?->format('Y-m-d') }}" aria-label="Vencimiento" title="Vencimiento" required>
                        <input name="orden" type="hidden" value="{{ $cuota->orden }}">
                        <div class="pm-cuota-acc">
                            <button class="pm-btn pm-btn-light pm-btn-sm" title="Guardar"><i class="bi bi-check2"></i></button>
                            <button class="pm-btn pm-btn-danger-light pm-btn-sm" title="Eliminar" form="del-{{ $cuota->id_cuota }}"><i class="bi bi-trash"></i></button>
                        </div>
                    </form>
                    <form id="del-{{ $cuota->id_cuota }}" action="{{ route('panel.cuotas.destroy', $cuota->id_cuota) }}" method="POST" hidden data-confirmar="¿Eliminar la cuota «{{ $cuota->nombre }}»?" data-confirmar-tipo="peligro">
                        @csrf
                        @method('DELETE')
                    </form>
                @empty
                    <p class="pm-muted mb-2">Este ciclo todavía no tiene cuotas.</p>
                @endforelse
            </div>

            <h3 class="pm-subtitle"><i class="bi bi-plus-circle"></i> Agregar cuota</h3>
            <form action="{{ route('panel.ciclos.cuotas.store', $ciclo->id_ciclo) }}" method="POST" class="pm-cuota pm-cuota-nueva">
                @csrf
                @php($siguiente = $ciclo->cuotas->where('nombre', '!=', 'Matrícula')->count() + 1)
                <input name="nombre" class="form-control form-control-sm" placeholder="Nombre (Cuota 1)" required value="{{ $ciclo->cuotas->isEmpty() ? 'Matrícula' : 'Cuota ' . $siguiente }}">
                <input name="numero" type="number" min="0" class="form-control form-control-sm" placeholder="N°" required value="{{ $ciclo->cuotas->isEmpty() ? 1 : $siguiente }}">
                <input name="monto" type="number" step="0.01" min="0" class="form-control form-control-sm" placeholder="Monto" required>
                <input name="fecha_vencimiento" type="date" class="form-control form-control-sm" required value="{{ $ciclo->fecha_inicio->format('Y-m-d') }}">
                <input name="orden" type="hidden" value="{{ ($ciclo->cuotas->max('orden') ?? 0) + 1 }}">
                <div class="pm-cuota-acc">
                    <button class="pm-btn pm-btn-primary pm-btn-sm"><i class="bi bi-plus-lg"></i> Agregar</button>
                </div>
            </form>
        </section>
    @endif
</div>

<script>
    // Muestra los campos según la modalidad elegida (Colegio: nivel · Academia: universidad y tipo de ciclo)
    document.querySelectorAll('input[name="id_modalidad"]').forEach(r => r.addEventListener('change', () => {
        document.querySelectorAll('[data-solo]').forEach(el => el.hidden = el.dataset.solo !== r.value);
    }));
</script>
@endsection
