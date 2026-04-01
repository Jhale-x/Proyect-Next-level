@extends('layouts.Docentelanding')

@section('title', 'Actividad')

@push('styles') 
    <link rel="stylesheet" href="{{ asset('css/docente/activityDocente.css') }}">
@endpush

@section('content')

<div class="activity-wrapper">

    <!-- Header -->
    <div class="header">
        <h1>Flujo de actividades</h1>
        <div class="settings-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
            </svg>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters">
        <select class="filter-select">
            <option>Mostrar todo</option>
            <option>Calificaciones</option>
            <option>Anuncios</option>
            <option>Tareas</option>
        </select>
    </div>

    <!-- Timeline -->
    <div class="timeline-container">
        <div class="timeline">

            <!-- 20 horas -->
            <div class="activity-item">
                <div class="activity-date">20 horas</div>
                <div class="activity-card pink">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Writing task</div>
                    <div class="activity-comment">GOOD JOB MANUEL ANTONIO</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 29 de ene -->
            <div class="activity-item">
                <div class="activity-date">29 de ene. de 2026</div>
                <div class="activity-card purple">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Final Project</div>
                    <div class="activity-comment">GOOD JOB MANUEL ANTONIO</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 22 de ene -->
            <div class="activity-item">
                <div class="activity-date">22 de ene. de 2026</div>
                <div class="activity-card blue">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Activity: Speaking 3</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-date"></div> <!-- Mismo día, sin repetir fecha -->
                <div class="activity-card purple">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Project Advance</div>
                    <div class="activity-comment">Good job Manuel Antonio Continue working like this</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-date"></div>
                <div class="activity-card green">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Activity: Speaking 2</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 21 de ene -->
            <div class="activity-item">
                <div class="activity-date">21 de ene. de 2026</div>
                <div class="activity-card purple">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Platform - Unit 3</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-date"></div>
                <div class="activity-card blue">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Platform - Unit 4</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 20 de ene -->
            <div class="activity-item">
                <div class="activity-date">20 de ene. de 2026</div>
                <div class="activity-card">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Activity: Speaking 1</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 15 de ene -->
            <div class="activity-item">
                <div class="activity-date">15 de ene. de 2026</div>
                <div class="activity-card pink">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Calificación publicada: Attendance</div>
                    <a href="#" class="btn-grade">Ver mi calificación</a>
                </div>
            </div>

            <!-- 14 de ene -->
            <div class="activity-item">
                <div class="activity-date">14 de ene. de 2026</div>
                <div class="activity-card green">
                    <div class="activity-header">INTERMEDIATE 2</div>
                    <div class="activity-title">Nuevo curso disponible: INTERMEDIATE 2</div>
                    <a href="#" class="btn-grade">Ver curso</a>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection