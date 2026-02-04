@extends('layouts.app')

@section('title', 'Herramientas')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-tools"></i> Herramientas académicas
    </h2>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-file-earmark-text fs-1"></i>
                    <h5 class="mt-3">Materiales</h5>
                    <p class="text-muted">Guías y documentos</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-upload fs-1"></i>
                    <h5 class="mt-3">Entregas</h5>
                    <p class="text-muted">Subir tareas</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-chat-dots fs-1"></i>
                    <h5 class="mt-3">Soporte</h5>
                    <p class="text-muted">Contacto con docentes</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-gear fs-1"></i>
                    <h5 class="mt-3">Configuración</h5>
                    <p class="text-muted">Ajustes de cuenta</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
