@extends('layouts.app')

@section('title', 'Calificaciones')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Calificaciones</h2>

    <!-- CURSO -->
    <div class="grade-card mb-4">

        <!-- Header -->
        <div class="grade-header">
            <div>
                <small class="text-muted">Matemática</small>
                <h5 class="mb-0">5° Secundaria</h5>
            </div>

            <div class="grade-average">
                16
            </div>
        </div>

        <!-- SEMANALES -->
        <div class="grade-section">
            <h6>📅 Notas semanales</h6>

            <div class="grade-item">
                <span>Semana 1 - Examen parcial</span>
                <span class="badge">15 / 20</span>
            </div>

            <div class="grade-item">
                <span>Semana 2 - Práctica calificada</span>
                <span class="badge">17 / 20</span>
            </div>
        </div>

        <!-- DIARIAS -->
        <div class="grade-section">
            <h6>📝 Notas diarias</h6>

            <div class="grade-item">
                <span>02/03 - Tarea</span>
                <span class="badge">18</span>
            </div>

            <div class="grade-item">
                <span>03/03 - Control</span>
                <span class="badge">16</span>
            </div>
        </div>

        <div class="text-end mt-2">
            <a href="#" class="link-primary">Ver todas las calificaciones</a>
        </div>

    </div>

</div>

@endsection
