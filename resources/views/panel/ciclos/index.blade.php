@extends('panel.layout')

@section('title', 'Ciclos')

@section('content')
<div class="pm-head">
    <div>
        <h1>Ciclos y cuotas</h1>
        <p class="pm-muted mb-0">Programas que se ofrecen en la matrícula en línea y sus montos.</p>
    </div>
    <a href="{{ route('panel.ciclos.create') }}" class="pm-btn pm-btn-primary"><i class="bi bi-plus-lg"></i> Nuevo ciclo</a>
</div>

<section class="pm-stats pm-stats-4">
    <div class="pm-stat"><span>Total</span><strong>{{ $resumen['total'] }}</strong></div>
    <a class="pm-stat is-green" href="{{ route('panel.ciclos.index', ['estado' => 'vigentes']) }}"><span>Visibles en la web</span><strong>{{ $resumen['visibles'] }}</strong></a>
    <a class="pm-stat" href="{{ route('panel.ciclos.index', ['estado' => 'inactivos']) }}"><span>Desactivados</span><strong>{{ $resumen['inactivos'] }}</strong></a>
    <div class="pm-stat {{ $resumen['sin_cuota'] ? 'is-amber' : '' }}"><span>Activos sin cuota</span><strong>{{ $resumen['sin_cuota'] }}</strong></div>
</section>

<form action="{{ route('panel.ciclos.index') }}" method="GET" class="pm-card pm-filters">
    <div class="pm-filter pm-filter-grow">
        <label for="f-search">Buscar</label>
        <input id="f-search" type="search" name="search" class="form-control" placeholder="Nombre o código" value="{{ request('search') }}">
    </div>
    <div class="pm-filter">
        <label for="f-modalidad">Modalidad</label>
        <select id="f-modalidad" name="modalidad" class="form-select">
            <option value="">Todas</option>
            @foreach($modalidades as $id => $nombre)
                <option value="{{ $id }}" @selected(request('modalidad') == $id)>{{ $nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="pm-filter">
        <label for="f-estado">Estado</label>
        <select id="f-estado" name="estado" class="form-select">
            <option value="">Todos</option>
            <option value="vigentes" @selected(request('estado') === 'vigentes')>Visibles en la web</option>
            <option value="activos" @selected(request('estado') === 'activos')>Activos</option>
            <option value="inactivos" @selected(request('estado') === 'inactivos')>Desactivados</option>
        </select>
    </div>
    <div class="pm-filter pm-filter-actions">
        <button type="submit" class="pm-btn pm-btn-primary"><i class="bi bi-search"></i> Filtrar</button>
        @if(request()->hasAny(['search', 'estado', 'modalidad']))
            <a href="{{ route('panel.ciclos.index') }}" class="pm-btn pm-btn-light" title="Quitar filtros"><i class="bi bi-x-lg"></i></a>
        @endif
    </div>
</form>

<section class="pm-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="pm-table">
            <thead>
                <tr>
                    <th>Ciclo</th>
                    <th>Programa</th>
                    <th>Fechas</th>
                    <th>Matrícula</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ciclos as $c)
                    @php
                        $cuotaMat = $c->cuotas->sortBy(fn ($q) => $q->nombre === 'Matrícula' ? 0 : 1)->first();
                        $vencido = $c->fecha_fin->lt(today());
                        $visible = $c->activo && !$vencido && $cuotaMat;
                    @endphp
                    <tr>
                        <td data-label="Ciclo">
                            <strong>{{ $c->nombre }}</strong>
                            <small class="d-block pm-muted"><code>{{ $c->codigo }}</code> · {{ $c->matriculas_count }} {{ $c->matriculas_count === 1 ? 'matrícula' : 'matrículas' }}</small>
                        </td>
                        <td data-label="Programa">
                            {{ $modalidades[$c->id_modalidad] ?? '—' }} ·
                            {{ $c->id_modalidad == 2 ? ($c->universidad?->slug ? strtoupper($c->universidad->slug) : '—') . ' · ' . ucfirst($c->tipoCiclo?->nombre ?? '') : ucfirst($c->nivelEducativo?->nombre ?? '—') }}
                            <small class="d-block pm-muted">{{ $c->sede?->nombre }} · {{ ucfirst($c->turno?->nombre ?? '') }}</small>
                        </td>
                        <td data-label="Fechas">{{ $c->fecha_inicio->format('d/m/Y') }}<small class="d-block pm-muted">al {{ $c->fecha_fin->format('d/m/Y') }}</small></td>
                        <td data-label="Matrícula">
                            @if($cuotaMat)
                                S/ {{ number_format($cuotaMat->monto, 2) }}
                                <small class="d-block pm-muted">{{ $c->cuotas->count() }} {{ $c->cuotas->count() === 1 ? 'cuota' : 'cuotas' }}</small>
                            @else
                                <span class="pm-badge pm-badge-amber">Sin cuota</span>
                            @endif
                        </td>
                        <td data-label="Estado">
                            @if($visible)
                                <span class="pm-badge pm-badge-green">Visible en la web</span>
                            @elseif(!$c->activo)
                                <span class="pm-badge pm-badge-gray">Desactivado</span>
                            @elseif($vencido)
                                <span class="pm-badge pm-badge-red">Finalizado</span>
                            @else
                                <span class="pm-badge pm-badge-amber">Activo sin cuota</span>
                            @endif
                        </td>
                        <td class="text-end" data-label="">
                            <a href="{{ route('panel.ciclos.edit', $c->id_ciclo) }}" class="pm-btn pm-btn-light pm-btn-sm"><i class="bi bi-pencil"></i> Editar</a>
                            <form action="{{ route('panel.ciclos.estado', $c->id_ciclo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="pm-btn pm-btn-sm {{ $c->activo ? 'pm-btn-danger-light' : 'pm-btn-green' }}" title="{{ $c->activo ? 'Ocultar de la matrícula en línea' : 'Mostrar en la matrícula en línea' }}">
                                    <i class="bi {{ $c->activo ? 'bi-eye-slash' : 'bi-eye' }}"></i> {{ $c->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="pm-empty">
                            <i class="bi bi-calendar-x"></i>
                            <strong>No hay ciclos</strong>
                            <span>Ajusta los filtros o crea un ciclo nuevo.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div class="pm-pagination">
    {{ $ciclos->links('pagination::bootstrap-5') }}
</div>
@endsection
