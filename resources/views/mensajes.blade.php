@extends('layouts.app')

@section('title', 'Mensajes')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-envelope"></i> Mensajes
    </h2>

    <div class="row">

        <!-- Lista de conversaciones -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Conversaciones
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">
                        <strong>Prof. Matemática</strong><br>
                        <small>Revisión de tarea</small>
                    </li>
                    <li class="list-group-item">
                        <strong>Prof. Lengua</strong><br>
                        <small>Entrega de proyecto</small>
                    </li>
                    <li class="list-group-item">
                        <strong>Dirección</strong><br>
                        <small>Aviso institucional</small>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mensajes -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Prof. Matemática
                </div>

                <div class="card-body" style="height: 300px; overflow-y: auto;">
                    <div class="mb-3">
                        <strong>Profesor:</strong>
                        <p>Recuerda revisar los ejercicios de la página 45.</p>
                        <small class="text-muted">Hoy 10:30 am</small>
                    </div>

                    <div class="mb-3 text-end">
                        <strong>Tú:</strong>
                        <p>Gracias profesor, ya los estoy revisando.</p>
                        <small class="text-muted">Hoy 10:35 am</small>
                    </div>
                </div>

                <!-- Enviar mensaje -->
                <div class="card-footer">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Escribe un mensaje...">
                            <button class="btn btn-primary" type="button">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
