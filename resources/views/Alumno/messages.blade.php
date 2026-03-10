@extends('layouts.Alumnoslanding')

@section('title', 'Mensajes')

@section('content')
<div class="container-fluid px-2">

    <h4 class="mb-3">✉️ Mensajes por Curso</h4>

    <div class="row g-3">

        <!-- Curso 1 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header border-top border-4 border-primary d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">202602-INGL-155-TEC-NRC_76</small>
                        <h6 class="mb-0">BASIC 4</h6>
                    </div>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-send"></i> Enviar mensaje
                    </button>
                </div>

                <div class="card-body py-2">
                    <p class="text-muted small mb-1">Mensajes recientes</p>
                    <p class="mb-1">📩 Profesor: Recuerden entregar la tarea.</p>
                    <p class="mb-0 text-muted small">Hace 2 horas</p>
                </div>
            </div>
        </div>

        <!-- Curso 2 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header border-top border-4 border-success d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">PREVENCION-202510-38</small>
                        <h6 class="mb-0">Inducción a la Seguridad</h6>
                    </div>
                    <button class="btn btn-sm btn-outline-success">
                        <i class="bi bi-send"></i> Enviar mensaje
                    </button>
                </div>

                <div class="card-body py-2">
                    <p class="text-muted small mb-1">Mensajes recientes</p>
                    <p class="mb-1">📩 Sistema: Bienvenidos al curso.</p>
                    <p class="mb-0 text-muted small">Ayer</p>
                </div>
            </div>
        </div>

        <!-- Curso 3 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header border-top border-4 border-warning d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">IND_ALUMNOS-202520-38</small>
                        <h6 class="mb-0">Inducción para estudiantes</h6>
                    </div>
                    <button class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-send"></i> Enviar mensaje
                    </button>
                </div>

                <div class="card-body py-2">
                    <p class="text-muted small mb-1">Mensajes recientes</p>
                    <p class="mb-1">📩 Coordinación: Horarios publicados.</p>
                    <p class="mb-0 text-muted small">Hace 3 días</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
