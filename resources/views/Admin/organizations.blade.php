@extends('layouts.Adminlanding')

@section('title', 'Organizaciones')

@section('content')

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="fw-normal">Organizaciones</h1>

    <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-2">
        <i class="bi bi-building fs-5"></i>
        <span>Catálogo de organizaciones</span>
    </a>
</div>

<hr>

<!-- Filtros -->
<div class="row align-items-end g-3 mb-5">
    <!-- Buscar -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Buscador</label>
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Buscador">
        </div>
    </div>

    <!-- Filtros -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Filtros</label>
        <select class="form-select">
            <option>Docentes y auxiliares</option>
            <option div="">General</option>
        </select>
    </div>

    <!-- Paginación -->
    <div class="col-auto">
        <label class="form-label fw-semibold"> </label>
        <div class="input-group">
            <select class="form-select">
                <option>100</option>
                <option>50</option>
                <option>25</option>
            </select>
            <span class="input-group-text bg-white">elementos por página</span>
        </div>
    </div>

</div>

<!-- Estado vacío -->
<div class="text-center text-muted mt-5">
    <p class="fs-6">
        No hay listado 
    </p>
</div>
@endsection