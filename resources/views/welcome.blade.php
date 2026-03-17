@extends('layouts.app')

@section('title', 'Inicio - Next Level')

@section('content')
<div class="container-fluid px-lg-5 py-4">

    {{-- HEADER --}}
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-1" style="color: #0f172a; letter-spacing: -1.5px;">
                ¡Bienvenido, <span style="color: #b91c1c;">Estudiante!</span>
            </h1>
            <p class="text-muted lead fs-6">
                <i class="bi bi-mortarboard-fill me-2 text-danger"></i> Gestión Académica • 2026-I
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge py-2 px-3 rounded-pill shadow-sm" style="background-color: #0f172a; color: #ffffff;">
                <i class="bi bi-geo-alt-fill me-1 text-danger"></i> Sede Central
            </span>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['label' => 'Cursos Activos', 'value' => '08', 'icon' => 'bi-book', 'type' => 'dark'],
                ['label' => 'Asistencia', 'value' => '95%', 'icon' => 'bi-calendar-check', 'type' => 'dark'],
                ['label' => 'Promedio Gral.', 'value' => '17.5', 'icon' => 'bi-star-fill', 'type' => 'danger'],
                ['label' => 'Pendientes', 'value' => '03', 'icon' => 'bi-bell-fill', 'type' => 'danger'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm transition-hover rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 p-3 rounded-3 me-3 {{ $stat['type'] == 'danger' ? 'bg-danger text-white' : 'bg-dark text-white' }}" 
                             style="{{ $stat['type'] == 'dark' ? 'background-color: #1e293b !important;' : '' }}">
                            <i class="{{ $stat['icon'] }} fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-0" style="letter-spacing: 0.5px;">{{ $stat['label'] }}</p>
                            <h3 class="fw-bold mb-0" style="color: #0f172a;">{{ $stat['value'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        {{-- COMUNICADOS --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100 rounded-4">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold m-0" style="color: #0f172a;">
                        <i class="bi bi-megaphone-fill me-2 text-danger"></i>Comunicados
                    </h5>
                    <a href="#" class="text-decoration-none fw-bold small text-danger">Ver todos</a>
                </div>

                <div class="timeline-container">
                    <div class="announcement-item p-3 mb-3 rounded-4 border-start border-danger border-4 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-danger">Urgente</span>
                            <small class="text-muted fw-semibold">Hoy</small>
                        </div>
                        <h6 class="fw-bold" style="color: #0f172a;">Simulacro Tipo Admisión – ETI</h6>
                        <p class="text-muted small mb-2">Se realizará el simulacro presencial. Portar carnet de estudiante y DNI.</p>
                        <a href="#" class="text-danger text-decoration-none small fw-bold">Leer más →</a>
                    </div>

                    <div class="announcement-item p-3 rounded-4 border-start border-dark border-4" style="background-color: #f8fafc;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-dark">Aviso</span>
                            <small class="text-muted fw-semibold">10 Feb</small>
                        </div>
                        <h6 class="fw-bold" style="color: #0f172a;">Mantenimiento de plataforma</h6>
                        <p class="text-muted small mb-0">Actualización de servidores este domingo a las 10:00 PM.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- AGENDA --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="p-4 bg-dark text-white">
                    <h5 class="fw-bold mb-0"><i class="bi bi-calendar3 me-2"></i>Agenda Semanal</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="text-center me-3 p-2 rounded-3 bg-danger text-white shadow-sm" style="min-width: 55px;">
                            <span class="d-block fw-bold fs-5">08</span>
                            <small class="text-uppercase fw-bold" style="font-size: 10px;">AM</small>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: #0f172a;">Clase de Matemáticas</h6>
                            <small class="text-muted">Aula 402 • 08:00 – 10:00</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="text-center me-3 p-2 rounded-3 bg-white border text-dark shadow-sm" style="min-width: 55px;">
                            <span class="d-block fw-bold fs-5">03</span>
                            <small class="text-uppercase fw-bold" style="font-size: 10px;">PM</small>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: #0f172a;">Práctica ETI</h6>
                            <small class="text-muted">Laboratorio • 15:00 – 17:00</small>
                        </div>
                    </div>

                    <div class="mt-auto pt-3">
                        <a href="{{ route('calendario') }}" class="btn btn-danger w-100 py-2 rounded-3 fw-bold shadow-sm">
                            Ver calendario completo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        background-color: #f1f5f9;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .transition-hover {
        transition: all 0.3s ease;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.1) !important;
    }

    .badge {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.5px;
        padding: 0.5em 0.8em;
    }

    .bg-dark { background-color: #0f172a !important; }
    .bg-danger { background-color: #b91c1c !important; }
    .text-danger { color: #b91c1c !important; }
</style>
@endsection