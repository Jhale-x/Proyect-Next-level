@extends('layouts.Adminlanding')

@section('title', 'Herramientas - Next Level')

@section('content')

    <div class="mb-4">
        <h1 class="fw-normal">Herramientas</h1>
        <p class="text-muted">Gestión de recursos y utilitarios del sistema.</p>
        <hr>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="{{ route('admin.support') }}" class="text-decoration-none text-dark">
                <div class="card h-100 text-center shadow-sm border-0 hover-shadow" style="transition: transform 0.2s;">
                    <div class="card-body d-flex flex-column justify-content-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-rocket-takeoff fs-1 text-primary"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Soporte Técnico</h6>
                        <small class="text-muted">Enviar tickets o consultas</small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center shadow-sm border-0 bg-light">
                <div class="card-body d-flex flex-column justify-content-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-journal-text fs-1 text-secondary"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Documentación</h6>
                    <small class="text-muted">Manuales de usuario (Próximamente)</small>
                </div>
            </div>
        </div>
    @endsection
