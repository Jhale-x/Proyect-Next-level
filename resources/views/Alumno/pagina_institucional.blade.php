@extends('layouts.Alumnoslanding')

@section('title', 'home')

@section('content')
    @php
        if(!isset($anuncios)) {
            $anuncios = collect(); // Colección vacía
        }
        if(!isset($actividades)) {
            $actividades = collect(); // Colección vacía
        }
    @endphp

    <div class="container-fluid">

        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Cursos</h2>
            <a href="#" class="text-decoration-none">
                <i class="bi bi-grid"></i> Catálogo de cursos
            </a>
        </div>

        <!-- Barra de búsqueda y filtros -->
        <div class="card p-3 mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Busque sus cursos">
                    </div>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Cursos actuales</option>
                        <option>Todos los cursos</option>
                        <option>Cursos pasados</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Cursos que estoy realizando</option>
                        <option>Finalizados</option>
                        <option>No iniciados</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-center gap-2">
                    <select class="form-select">
                        <option selected>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <span>elementos</span>
                </div>
            </div>
        </div>

        <!-- Resultados -->
        <p><strong>{{ $anuncios->count() }} resultados</strong></p>

        <!-- Favoritos -->
        <!-- ACTIVIDADES -->

        <h5 class="mt-4 mb-3">Favoritos</h5>

        @if ($anuncios->isEmpty())
            <div class="alert alert-info">No hay anuncios activos por el momento.</div>
        @else
            @foreach ($anuncios->take(3) as $anuncio)
                <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex gap-3">
                        <div style="width:5px; background:#6f42c1;"></div>
                        <div>
                            <small class="text-muted">{{ $anuncio->fecha_publicacion?->format('d/m/Y H:i') }}</small>
                            <h6 class="mb-1">{{ $anuncio->titulo }}</h6>
                            <small class="text-success">{{ ucfirst($anuncio->estado) }}</small> | <a href="#">Más
                                información</a>
                        </div>
                    </div>
                    <i class="bi bi-star-fill text-warning fs-5"></i>
                </div>
            @endforeach
        @endif

        <!-- Cursos normales -->
        <h6 class="mt-4 mb-3">Anuncios institucionales</h6>

        @foreach ($anuncios->skip(3) as $anuncio)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div class="d-flex gap-3">
                    <div style="width:5px; background:#0d6efd;"></div>
                    <div>
                        <small class="text-muted">{{ $anuncio->fecha_publicacion?->format('d/m/Y H:i') }}</small>
                        <h6 class="mb-1">{{ $anuncio->titulo }}</h6>
                        <small class="text-success">{{ ucfirst($anuncio->estado) }}</small> | <span
                            class="text-muted">{{ $anuncio->descripcion }}</span>
                    </div>
                </div>
                <i class="bi bi-star fs-5"></i>
            </div>
        @endforeach

    </div>
@endsection