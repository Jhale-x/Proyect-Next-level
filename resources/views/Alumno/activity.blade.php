@extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/activityAlumno.css') }}">
@endpush

@section('title', 'Actividad - Next Level')

@section('content')
<div class="activity-wrapper">
    <!-- Header -->
    <div class="header">
        <h1>Actividad Reciente</h1>
        <div class="settings-icon">
            <i class="bi bi-funnel-fill"></i>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters">
        <select class="filter-select">
            <option>Todas las actividades</option>
            <option>Tareas</option>
            <option>Exámenes</option>
            <option>Foros</option>
        </select>
        <select class="filter-select">
            <option>Últimos 7 días</option>
            <option>Último mes</option>
            <option>Último semestre</option>
        </select>
    </div>

    <!-- Timeline de actividades -->
    <div class="timeline-container">
        <div class="timeline">
            
            <!-- Actividad 1 -->
            <div class="activity-item">
                <div class="activity-date">
                    15 de Mayo, 2025
                    <span>10:30 AM</span>
                </div>
                <div class="activity-card purple">
                    <div class="timeline-icon">📝</div>
                    <div class="timeline-dot"></div>
                    <div class="activity-header">TAREA ENTREGADA</div>
                    <div class="activity-title">Matemática - Ejercicios de Álgebra</div>
                    <div class="activity-comment">"Excelente trabajo, revisa el punto 3" - Prof. Rodríguez</div>
                    <button class="btn-grade">
                        <i class="bi bi-star"></i> Ver calificación
                    </button>
                </div>
            </div>

            <!-- Actividad 2 -->
            <div class="activity-item">
                <div class="activity-date">
                    14 de Mayo, 2025
                    <span>02:15 PM</span>
                </div>
                <div class="activity-card blue">
                    <div class="timeline-icon">📖</div>
                    <div class="timeline-dot"></div>
                    <div class="activity-header">EXAMEN PROGRAMADO</div>
                    <div class="activity-title">Comunicación - Examen Parcial</div>
                    <div class="activity-comment">Examen programado para el 20 de mayo. Temas: Literatura y Redacción.</div>
                    <button class="btn-grade">
                        <i class="bi bi-calendar"></i> Ver detalles
                    </button>
                </div>
            </div>

            <!-- Actividad 3 -->
            <div class="activity-item">
                <div class="activity-date">
                    12 de Mayo, 2025
                    <span>09:45 AM</span>
                </div>
                <div class="activity-card green">
                    <div class="timeline-icon">💬</div>
                    <div class="timeline-dot"></div>
                    <div class="activity-header">FORO ACADÉMICO</div>
                    <div class="activity-title">Ciencia y Tecnología - Debate sobre energías renovables</div>
                    <div class="activity-comment">Participación destacada. +5 puntos extras.</div>
                    <button class="btn-grade">
                        <i class="bi bi-chat"></i> Ver foro
                    </button>
                </div>
            </div>

            <!-- Actividad 4 -->
            <div class="activity-item">
                <div class="activity-date">
                    10 de Mayo, 2025
                    <span>04:00 PM</span>
                </div>
                <div class="activity-card orange">
                    <div class="timeline-icon">🎓</div>
                    <div class="timeline-dot"></div>
                    <div class="activity-header">CURSO INICIADO</div>
                    <div class="activity-title">Inglés - Módulo 4: Conversación Avanzada</div>
                    <div class="activity-comment">Has completado el 40% del módulo. ¡Sigue así!</div>
                    <button class="btn-grade">
                        <i class="bi bi-play-circle"></i> Continuar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection