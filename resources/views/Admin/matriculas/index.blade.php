@extends('layouts.Adminlanding')

@section('title', 'Matrículas | Next Level')

@section('content')
@php
    $badges = ['pendiente' => 'bg-warning text-dark', 'pagada' => 'bg-success', 'cancelada' => 'bg-secondary', 'vencida' => 'bg-danger'];
@endphp
<div class="listado-container">

    <div class="listado-header">
        <h2><i class="bi bi-journal-check"></i> Matrículas</h2>
        <div class="header-stats d-flex flex-wrap gap-2">
            <div class="stat-badge">Total: <span>{{ $estadisticas['total'] }}</span></div>
            <div class="stat-badge">Hoy: <span>{{ $estadisticas['hoy'] }}</span></div>
            <div class="stat-badge">Pendientes: <span>{{ $estadisticas['pendientes'] }}</span></div>
            <div class="stat-badge">Pagadas: <span>{{ $estadisticas['pagadas'] }}</span></div>
            <div class="stat-badge">Recaudado: <span>S/ {{ number_format($estadisticas['recaudado'], 2) }}</span></div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-3 {{ $correo['activo'] ? 'border-success' : 'border-warning' }}">
        <div class="card-body d-flex flex-wrap gap-3 align-items-center justify-content-between">
            <div>
                <strong><i class="bi bi-envelope-check"></i> Correo de bienvenida:</strong>
                @if($correo['activo'])
                    <span class="badge bg-success">Activo</span>
                    <small class="text-muted ms-1">Se envía desde {{ $correo['remitente'] }} al verificar cada pago.</small>
                @else
                    <span class="badge bg-warning text-dark">No configurado</span>
                    <small class="d-block text-muted mt-1">{{ $correo['motivo'] }} Configura la sección MAIL_* del archivo .env.</small>
                @endif
            </div>
            <form action="{{ route('admin.matriculas.correo-prueba') }}" method="POST" class="d-flex gap-2">
                @csrf
                <input type="email" name="email" class="form-control form-control-sm" placeholder="correo@ejemplo.com" required value="{{ old('email') }}" aria-label="Correo para la prueba">
                <button class="btn btn-sm btn-outline-primary text-nowrap"><i class="bi bi-send"></i> Enviar prueba</button>
            </form>
        </div>
    </div>

    <div class="filters-card">
        <div class="filters-body">
            <form action="{{ route('admin.matriculas.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="filter-group">
                            <label class="filter-label"><i class="bi bi-search"></i> Buscar</label>
                            <input type="text" name="search" class="filter-input" placeholder="Código, DNI o nombre..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="filter-label"><i class="bi bi-flag"></i> Estado</label>
                            <select name="estado" class="filter-select">
                                <option value="">Todos</option>
                                @foreach(['pendiente', 'pagada', 'vencida', 'cancelada'] as $e)
                                    <option value="{{ $e }}" @selected(request('estado') === $e)>{{ ucfirst($e) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="filter-label"><i class="bi bi-mortarboard"></i> Modalidad</label>
                            <select name="modalidad" class="filter-select">
                                <option value="">Todas</option>
                                <option value="colegio" @selected(request('modalidad') === 'colegio')>Colegio</option>
                                <option value="academia" @selected(request('modalidad') === 'academia')>Academia</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn-filter"><i class="bi bi-search"></i> Buscar</button>
                            <a href="{{ route('admin.matriculas.exportar', request()->query()) }}" class="btn-clear" title="Exportar CSV"><i class="bi bi-download"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-modern">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Modalidad / Ciclo</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriculas as $m)
                    <tr>
                        <td><code>{{ $m->codigo }}</code></td>
                        <td>{{ $m->fecha_registro?->format('d/m/Y H:i') }}</td>
                        <td>
                            <strong>{{ $m->alumno_nombre_completo }}</strong><br>
                            <small>DNI {{ $m->alumno?->dni }}</small>
                        </td>
                        <td>
                            {{ ucfirst($m->modalidad) }} · {{ $m->eleccion }}<br>
                            <small>{{ $m->ciclo_grado }} · {{ $m->turno }}</small>
                        </td>
                        <td>S/ {{ number_format($m->monto_total, 2) }}</td>
                        <td><span class="badge {{ $badges[$m->estado_visible] ?? 'bg-light text-dark' }}">{{ ucfirst($m->estado_visible) }}</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.matriculas.show', $m->id_matricula) }}" class="btn-action btn-view" title="Ver detalle"><i class="bi bi-eye"></i></a>
                                @if($m->estado === 'pendiente')
                                    <form action="{{ route('admin.matriculas.estado', $m->id_matricula) }}" method="POST" onsubmit="return confirm('¿Verificaste el pago de {{ $m->codigo }}? Se enviará el correo de bienvenida con las credenciales.')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estado" value="pagada">
                                        <button type="submit" class="btn-action btn-view" title="Marcar como pagada"><i class="bi bi-cash-coin"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-title">No hay matrículas</div>
                                <div class="empty-text">Ajusta los filtros o espera nuevas inscripciones</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-modern">
        {{ $matriculas->links() }}
    </div>
</div>
@endsection
