@extends('layouts.Auxiliarlanding')

@section('title', 'Soporte - Auxiliar')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('auxiliar.dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Soporte</li>
            </ol>
        </nav>

        <h1>Módulo de Soporte</h1>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i> Aquí aparecerá el listado de tickets y solicitudes técnicas.
        </div>

        <div class="card mt-4">
            <div class="card-body text-center py-5">
                <p class="text-muted">No hay solicitudes pendientes en este momento.</p>
            </div>
        </div>
    </div>
@endsection