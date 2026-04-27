@extends('layouts.Adminlanding')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">
@endsection

@section('content')
<div class="listado-container">
    
    <!-- Header -->
    <div class="listado-header">
        <h2>
            <i class="fas fa-user-graduate"></i>
            Gestión de Alumnos
        </h2>
        <div class="header-stats">
            <div class="stat-badge">
                <i class="fas fa-users"></i>
                Total: <span>{{ $alumnos->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <div class="filters-body">
            <form action="{{ route('admin.listado.alumnos') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-search"></i> Buscar
                            </label>
                            <input type="text" name="search" class="filter-input" 
                                   placeholder="Nombre, apellido o DNI..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-layer-group"></i> Nivel
                            </label>
                            <select name="nivel" class="filter-select">
                                <option value="">Todos los niveles</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}" {{ request('nivel') == $nivel->id_nivel ? 'selected' : '' }}>
                                        {{ $nivel->nivel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-chart-line"></i> Grado
                            </label>
                            <select name="grado" class="filter-select">
                                <option value="">Todos los grados</option>
                                @foreach($grados ?? [] as $grado)
                                    <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                                        {{ $grado->grado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn-filter">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                            <a href="{{ route('admin.listado.alumnos') }}" class="btn-clear">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-modern">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Alumno</th>
                        <th>Nivel / Grado</th>
                        <th>Usuario</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->dni ?? '-' }}</td>
                        <td>
                            <strong>{{ $alumno->nombre }} {{ $alumno->apellido }}</strong>
                        </td>
                        <td>
                            <span class="badge-role badge-docente">
                                {{ $alumno->nombre_nivel ?? 'N/A' }} - {{ $alumno->nombre_grado ?? '' }}
                            </span>
                        </td>
                        <td>
                            <code style="background: rgba(0,0,0,0.3); padding: 0.25rem 0.5rem; border-radius: 0.5rem;">
                                {{ $alumno->usuario }}
                            </code>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn-action btn-view" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.alumnos.destroy', $alumno->id_alumno) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este alumno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="empty-title">No hay alumnos registrados</div>
                                <div class="empty-text">Comienza registrando un nuevo alumno</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Paginación -->
    <div class="pagination-modern">
        {{ $alumnos->appends(request()->query())->links() }}
    </div>
    
</div>
@endsection