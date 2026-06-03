@extends('layouts.Docentelanding')

@section('title', 'Organizaciones')

@section('content')
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="fw-normal">Organizaciones</h1>
            <p class="text-muted mb-0">Listado de organizaciones registradas en el sistema.</p>
        </div>
        <span class="badge bg-primary">{{ $organizaciones->count() }}
            organizacione{{ $organizaciones->count() === 1 ? '' : 's' }}</span>
    </div>

    <hr>

    <!-- Filtros -->
    <div class="row align-items-end g-3 mb-5">
        <div class="col-md-4">
            <label for="buscador_org" class="form-label fw-semibold">Buscador</label>
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input id="buscador_org" type="text" class="form-control" placeholder="Buscador">
            </div>
        </div>

        <div class="col-md-3">
            <label for="filtro_org" class="form-label fw-semibold">Filtros</label>
            <select id="filtro_org" class="form-select">
                <option>Docentes y auxiliares</option>
                <option>General</option>
            </select>
        </div>

        <div class="col-auto">
            <label for="paginacion_org" class="form-label fw-semibold">Página</label>
            <div class="input-group">
                <select id="paginacion_org" class="form-select">
                    <option>100</option>
                    <option>50</option>
                    <option>25</option>
                </select>
                <span class="input-group-text bg-white">elementos por página</span>
            </div>
        </div>
    </div>

    @if ($organizaciones->isEmpty())
        <div class="text-center text-muted mt-5">
            <p class="fs-6">No hay organizaciones registradas.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach ($organizaciones as $organizacion)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $organizacion->nombre ?? 'Organización' }}</h5>
                            <p class="text-muted small mb-3">
                                {{ $organizacion->descripcion ?? 'Sin descripción disponible.' }}</p>
                            <p class="mb-0"><strong>ID:</strong> {{ $organizacion->id ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
