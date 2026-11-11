@extends('panel.layout')

@section('title', 'Matrículas')

@section('content')
@php
    $badges = ['pendiente' => 'pm-badge-amber', 'pagada' => 'pm-badge-green', 'cancelada' => 'pm-badge-gray', 'vencida' => 'pm-badge-red'];
@endphp

<div class="pm-head">
    <div>
        <h1>Matrículas</h1>
        <p class="pm-muted mb-0">Inscripciones recibidas desde el formulario y el chatbot de la web.</p>
    </div>
    <a href="{{ route('panel.exportar', request()->query()) }}" class="pm-btn pm-btn-light"><i class="bi bi-download"></i> Exportar a Excel (CSV)</a>
</div>

<section class="pm-stats">
    <div class="pm-stat"><span>Total</span><strong>{{ $estadisticas['total'] }}</strong></div>
    <div class="pm-stat"><span>Hoy</span><strong>{{ $estadisticas['hoy'] }}</strong></div>
    <a class="pm-stat is-amber" href="{{ route('panel.index', ['estado' => 'pendiente']) }}"><span>Por verificar</span><strong>{{ $estadisticas['pendientes'] }}</strong></a>
    <a class="pm-stat is-green" href="{{ route('panel.index', ['estado' => 'pagada']) }}"><span>Pagadas</span><strong>{{ $estadisticas['pagadas'] }}</strong></a>
    <div class="pm-stat is-navy"><span>Recaudado</span><strong>S/ {{ number_format($estadisticas['recaudado'], 2) }}</strong></div>
</section>

<section class="pm-card pm-mail {{ $correo['activo'] ? 'is-ok' : 'is-warn' }}">
    <div>
        <strong><i class="bi bi-envelope-check"></i> Correo de bienvenida</strong>
        @if($correo['activo'])
            <span class="pm-badge pm-badge-green">Activo</span>
            <small class="d-block pm-muted">Se envía desde {{ $correo['remitente'] }} al verificar cada pago.</small>
        @else
            <span class="pm-badge pm-badge-amber">No configurado</span>
            <small class="d-block pm-muted">{{ $correo['motivo'] }} Mientras tanto, entrega las credenciales al alumno.</small>
        @endif
    </div>
    <form action="{{ route('panel.correo-prueba') }}" method="POST" class="pm-inline-form">
        @csrf
        <input type="email" name="email" class="form-control form-control-sm" placeholder="correo@ejemplo.com" required value="{{ old('email') }}" aria-label="Correo para la prueba">
        <button class="pm-btn pm-btn-light pm-btn-sm text-nowrap"><i class="bi bi-send"></i> Enviar prueba</button>
    </form>
</section>

<form action="{{ route('panel.index') }}" method="GET" class="pm-card pm-filters">
    <div class="pm-filter pm-filter-grow">
        <label for="f-search">Buscar</label>
        <input id="f-search" type="search" name="search" class="form-control" placeholder="Código, DNI o nombre" value="{{ request('search') }}">
    </div>
    <div class="pm-filter">
        <label for="f-estado">Estado</label>
        <select id="f-estado" name="estado" class="form-select">
            <option value="">Todos</option>
            @foreach(['pendiente' => 'Pendiente', 'pagada' => 'Pagada', 'vencida' => 'Vencida', 'cancelada' => 'Cancelada'] as $valor => $texto)
                <option value="{{ $valor }}" @selected(request('estado') === $valor)>{{ $texto }}</option>
            @endforeach
        </select>
    </div>
    <div class="pm-filter">
        <label for="f-modalidad">Modalidad</label>
        <select id="f-modalidad" name="modalidad" class="form-select">
            <option value="">Todas</option>
            <option value="colegio" @selected(request('modalidad') === 'colegio')>Colegio</option>
            <option value="academia" @selected(request('modalidad') === 'academia')>Academia</option>
        </select>
    </div>
    <div class="pm-filter pm-filter-actions">
        <button type="submit" class="pm-btn pm-btn-primary"><i class="bi bi-search"></i> Filtrar</button>
        @if(request()->hasAny(['search', 'estado', 'modalidad']))
            <a href="{{ route('panel.index') }}" class="pm-btn pm-btn-light" title="Quitar filtros"><i class="bi bi-x-lg"></i></a>
        @endif
    </div>
</form>

<section class="pm-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="pm-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Alumno</th>
                    <th>Programa</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matriculas as $m)
                    <tr>
                        <td data-label="Código">
                            <code>{{ $m->codigo }}</code>
                            <small class="d-block pm-muted">{{ $m->fecha_registro?->format('d/m/Y H:i') }}</small>
                        </td>
                        <td data-label="Alumno">
                            <strong>{{ $m->alumno_nombre_completo }}</strong>
                            <small class="d-block pm-muted">DNI {{ $m->alumno?->dni }}</small>
                        </td>
                        <td data-label="Programa">
                            {{ ucfirst($m->modalidad) }} · {{ $m->eleccion }}
                            <small class="d-block pm-muted">{{ $m->ciclo_grado }} · {{ $m->turno }}</small>
                        </td>
                        <td data-label="Monto">S/ {{ number_format($m->monto_total, 2) }}</td>
                        <td data-label="Estado"><span class="pm-badge {{ $badges[$m->estado_visible] ?? 'pm-badge-gray' }}">{{ ucfirst($m->estado_visible) }}</span></td>
                        <td class="text-end" data-label="">
                            <a href="{{ route('panel.show', $m->id_matricula) }}" class="pm-btn pm-btn-light pm-btn-sm"><i class="bi bi-eye"></i> Ver</a>
                            @if($m->estado === 'pendiente')
                                <a href="{{ route('panel.show', $m->id_matricula) }}#verificar" class="pm-btn pm-btn-green pm-btn-sm"><i class="bi bi-cash-coin"></i> Verificar pago</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="pm-empty">
                            <i class="bi bi-inbox"></i>
                            <strong>No hay matrículas</strong>
                            <span>Ajusta los filtros o espera nuevas inscripciones.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div class="pm-pagination">
    {{ $matriculas->links('pagination::bootstrap-5') }}
</div>
@endsection
