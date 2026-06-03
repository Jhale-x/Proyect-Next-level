@extends('layouts.Auxiliarlanding')

@section('title', 'Herramientas')

@section('content')

    <div class="mb-4">
        <h1 class="fw-normal">Herramientas</h1>
        <hr>
    </div>

    <div class="row g-4">

        <!-- Soporte -->
        <div class="col-md-4">
            <a href="{{ route('auxiliar.support') }}" class="text-decoration-none text-dark">
                <div class="card h-100 text-center shadow-sm border">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-rocket-takeoff fs-1 mb-3"></i>
                        <h6 class="fw-semibold">Soporte</h6>
                    </div>
                </div>
            </a>
        </div>

        <!-- Documentacion -->
        <div class="col-md-4">
            <div class="card h-100 text-center shadow-sm border">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-journal-text fs-1 mb-3"></i>
                    <h6 class="fw-semibold">Documentación</h6>
                </div>
            </div>
        </div>

    </div>
@endsection
