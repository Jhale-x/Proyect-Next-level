@extends('layouts.Adminlanding')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">
@endsection

@section('content')
<div class="listado-container">
    
    <!-- Header -->
    <div class="listado-header">
        <h2>
            <i class="fas fa-user-tie"></i>
            Gestión de Personal
        </h2>
        <div class="header-stats">
            <div class="stat-badge">
                <i class="fas fa-users"></i>
                Total: <span>{{ $personales->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <div class="filters-body">
            <form action="{{ route('admin.listado.personal') }}" method="GET">
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
                                <i class="fas fa-briefcase"></i> Rol / Cargo
                            </label>
                            <select name="rol" class="filter-select">
                                <option value="">Todos los cargos</option>
                                <option value="administrador" {{ request('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="docente" {{ request('rol') == 'docente' ? 'selected' : '' }}>Docente</option>
                                <option value="auxiliar" {{ request('rol') == 'auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-book"></i> Materia
                            </label>
                            <select name="id_curso" class="filter-select">
                                <option value="">Todas las materias</option>
                                @foreach($cursos ?? [] as $curso)
                                    <option value="{{ $curso->id_curso }}" {{ request('id_curso') == $curso->id_curso ? 'selected' : '' }}>
                                        {{ $curso->materia }}
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
                            <a href="{{ route('admin.listado.personal') }}" class="btn-clear">
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
                        <th>Personal</th>
                        <th>Cargo / Materia</th>
                        <th>Usuario</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($personales as $user)
                    <tr>
                        <td>{{ $user->dni }}</td>
                        <td>
                            <strong>{{ $user->nombre }} {{ $user->apellido }}</strong>
                        </td>
                        <td>
                            @php
                                $rolClass = match($user->rol) {
                                    'administrador' => 'badge-admin',
                                    'docente' => 'badge-docente',
                                    default => 'badge-auxiliar'
                                };
                            @endphp
                            <span class="badge-role {{ $rolClass }}">
                                <i class="fas {{ $user->rol == 'docente' ? 'fa-chalkboard-teacher' : ($user->rol == 'administrador' ? 'fa-crown' : 'fa-hands-helping') }}"></i>
                                {{ $user->materia ?? ucfirst($user->rol) }}
                            </span>
                        </td>
                        <td>
                            <code style="background: rgba(0,0,0,0.3); padding: 0.25rem 0.5rem; border-radius: 0.5rem;">
                                {{ $user->usuario }}@NextLevelAcademy.pe
                            </code>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn-action btn-view" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="empty-title">No hay personal registrado</div>
                                <div class="empty-text">Comienza registrando un nuevo miembro del personal</div>
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
        {{ $personales->appends(request()->query())->links() }}
    </div>
    
</div>
@endsection