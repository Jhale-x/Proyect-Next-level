@extends('layouts.Alumnoslanding')

@section('title', 'home')

@section('content')
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
    <p><strong>4 resultados</strong></p>

    <!-- Favoritos -->
    <h5 class="mt-4 mb-3">Favoritos</h5>

    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex gap-3">
            <div style="width:5px; background:#e83e8c;"></div>
            <div>
                <small class="text-muted">PREVENCION-202510-39</small>
                <h6 class="mb-1">Inducción a la Seguridad y Prevención de Accidentes para estudiantes de SENATI</h6>
                <small class="text-success">Abierto</small> | <a href="#">Más información</a>
            </div>
        </div>
        <i class="bi bi-star-fill text-warning fs-5"></i>
    </div>

    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex gap-3">
            <div style="width:5px; background:#fd7e14;"></div>
            <div>
                <small class="text-muted">IND_ALUMNOS-202520-39</small>
                <h6 class="mb-1">Inducción para estudiantes</h6>
                <small class="text-success">Abierto</small> | <a href="#">Más información</a>
            </div>
        </div>
        <i class="bi bi-star-fill text-warning fs-5"></i>
    </div>

    <div class="card mb-4 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex gap-3">
            <div style="width:5px; background:#6f42c1;"></div>
            <div>
                <small class="text-muted">IND_ALUMNOS-202510-39</small>
                <h6 class="mb-1">Inducción para estudiantes</h6>
                <small class="text-success">Abierto</small> | <a href="#">Más información</a>
            </div>
        </div>
        <i class="bi bi-star-fill text-warning fs-5"></i>
    </div>

    <!-- Cursos normales -->
    <h6 class="mt-4 mb-3">202612 - Centro de Idiomas Virtual</h6>

    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
        <div class="d-flex gap-3">
            <div style="width:5px; background:#6f42c1;"></div>
            <div>
                <small class="text-muted">202612-INGL-255-TEC-NRC_172</small>
                <h6 class="mb-1">INTERMEDIATE 2</h6>
                <small class="text-success">Abierto</small> | <span class="text-muted">JERSON ABEL CARBAJAL ENCISO</span> | <a href="#">Más información</a>
            </div>
        </div>
        <i class="bi bi-star fs-5"></i>
    </div>

</div>
@endsection
