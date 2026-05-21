@extends('layouts.Auxiliarlanding')

@section('title', 'Página Institucional - Auxiliar')

@push('styles')
    {{-- Estilos específicos para esta página --}}
    <style>
        .anuncio-card {
            transition: transform 0.2s;
            border-left: 4px solid #4F46E5;
        }
        .anuncio-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .favorito-badge {
            background-color: #ffc107;
            color: #000;
            font-size: 0.7rem;
            font-weight: bold;
        }
        .status-active { color: #10b981; }
        .status-inactive { color: #6b7280; }
    </style>
@endpush

@section('content')
@php $anuncios = $anuncios ?? collect(); @endphp

<div class="container-fluid py-4">
    <!-- Encabezado de Sección -->
    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
        <div class="bg-primary text-white p-2 rounded me-3">
            <i class="bi bi-house-door-fill fs-3"></i>
        </div>
        <div>
            <h2 class="fw-bold m-0" style="color: #0a1f44;">Página Institucional</h2>
            <p class="text-muted m-0">Anuncios y avisos del Auxiliar</p>
        </div>
    </div>

    <!-- Barra de Herramientas (Filtros) -->
    <div class="card shadow-sm border-0 mb-4 bg-light">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold small">Buscar anuncios</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Escriba título o contenido...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Filtrar por</label>
                    <select class="form-select">
                        <option value="all">Todos</option>
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Ordenar</label>
                    <select class="form-select">
                        <option value="desc">Más recientes</option>
                        <option value="asc">Más antiguos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold small">Mostrar</label>
                    <select class="form-select">
                        <option>10</option>
                        <option>25</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <span class="badge bg-dark">{{ $anuncios->count() }} resultados encontrados</span>
    </div>

    <!-- Sección Favoritos (Top 3) -->
    <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-star-fill me-2"></i>Anuncios Destacados</h5>
    <div class="row mb-4">
        @forelse ($anuncios->take(3) as $anuncio)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm anuncio-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $anuncio->created_at->format('d/m/Y H:i') }}</small>
                            <span class="badge favorito-badge">FAVORITO</span>
                        </div>
                        <h6 class="fw-bold">{{ $anuncio->titulo }}</h6>
                        <p class="small text-secondary">{{ Str::limit($anuncio->descripcion, 100) }}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small fw-bold {{ ($anuncio->estado ?? 'activo') == 'activo' ? 'status-active' : 'status-inactive' }}">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                {{ ucfirst($anuncio->estado ?? 'Activo') }}
                            </span>
                            <button class="btn btn-sm btn-outline-primary">Ver detalle</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border shadow-sm">No hay anuncios favoritos para mostrar.</div>
            </div>
        @endforelse
    </div>

    <!-- Listado General -->
    <h5 class="fw-bold mb-3 text-secondary"><i class="bi bi-megaphone me-2"></i>Historial Institucional</h5>
    <div class="card shadow-sm border-0">
        <div class="list-group list-group-flush">
            @foreach ($anuncios->skip(3) as $anuncio)
                <div class="list-group-item p-3 list-group-item-action border-start border-4 border-info">
                    <div class="d-flex w-100 justify-content-between align-items-start">
                        <h6 class="mb-1 fw-bold text-dark">{{ $anuncio->titulo }}</h6>
                        <small class="text-muted">{{ $anuncio->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1 text-muted small">{{ Str::limit($anuncio->descripcion, 150) }}</p>
                    <div class="mt-2">
                        <span class="badge bg-light text-dark border"><i class="bi bi-calendar3 me-1"></i> {{ $anuncio->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        console.log('Página institucional cargada correctamente.');
    </script>
@endpush