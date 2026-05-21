@extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/cursos.css') }}">
@endpush

@section('title', 'Mis Cursos')

@section('content')
<div class="cursos-container">
    
    <!-- Header Minimalista -->
    <div class="cursos-header">
        <div class="header-title">
            <h2>Mis Cursos</h2>
            <p>{{ $cursos->count() }} cursos asignados</p>
        </div>
        <div class="stats-minimal">
            <div class="stat-item">
                <div class="stat-value">{{ $cursos->count() }}</div>
                <div class="stat-label">Total</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">
                    @php
                        $promedioProgreso = $cursos->avg('progreso') ?? 0;
                    @endphp
                    {{ number_format($promedioProgreso, 0) }}%
                </div>
                <div class="stat-label">Avance</div>
            </div>
        </div>
    </div>

    <!-- Filtros Minimalistas -->
    <div class="filtros-cursos">
        <button class="filtro-btn active" data-filtro="todos">Todos</button>
        <button class="filtro-btn" data-filtro="progreso">En curso</button>
        <button class="filtro-btn" data-filtro="completado">Completados</button>
    </div>

    <!-- Grid de Cursos -->
    <div class="cursos-grid" id="cursosGrid">
        @forelse($cursos as $curso)
            @php
                $iniciales = strtoupper(substr($curso->docente_nombre, 0, 1) . substr($curso->docente_apellido, 0, 1));
                $progreso = $curso->progreso ?? rand(30, 95);
                $estado = $progreso >= 80 ? 'completado' : ($progreso >= 30 ? 'progreso' : 'pendiente');
                
                $actividades = [
                    '📝 Examen Parcial - ' . date('d/m', strtotime('+' . rand(5, 15) . ' days')),
                    '📖 Trabajo Final - ' . date('d/m', strtotime('+' . rand(10, 20) . ' days')),
                    '🎯 Práctica - ' . date('d/m', strtotime('+' . rand(3, 10) . ' days')),
                ];
                $actividadSiguiente = $actividades[$loop->index % count($actividades)];
            @endphp
            <div class="curso-card" data-estado="{{ $estado }}">
                <div class="curso-bar"></div>
                <div class="curso-content">
                    <div class="curso-title">
                        <h3>{{ $curso->nombre }}</h3>
                        <span class="curso-code">Cód: {{ strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $curso->nombre), 0, 4)) }}-{{ rand(100, 999) }}</span>
                    </div>
                    
                    <div class="curso-teacher">
                        <div class="teacher-avatar">{{ $iniciales }}</div>
                        <div class="teacher-name">
                            <strong>{{ $curso->docente_nombre }} {{ $curso->docente_apellido }}</strong>
                        </div>
                    </div>
                    
                    <div class="progress-section">
                        <div class="progress-header">
                            <span>Progreso</span>
                            <span>{{ $progreso }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progreso }}%"></div>
                        </div>
                    </div>
                    
                    <div class="next-activity">
                        <i class="next-icon bi bi-calendar"></i>
                        <div class="next-text">
                            <span>Próxima actividad</span>
                            <strong>{{ $actividadSiguiente }}</strong>
                        </div>
                    </div>
                    
                    <a href="{{ route('alumno.courses.show', $curso->id_curso) }}" class="btn-view">
                        Ver detalles <i class="bi bi-arrow-right" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
                <div class="curso-status status-{{ $estado }}">
                    {{ $estado === 'completado' ? 'Completado' : ($estado === 'progreso' ? 'En curso' : 'Pendiente') }}
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4>No hay cursos asignados</h4>
                <p>Contacta con tu coordinador académico</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    // Filtros
    document.querySelectorAll('.filtro-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filtro = this.dataset.filtro;
            const cursos = document.querySelectorAll('.curso-card');
            
            cursos.forEach(curso => {
                if (filtro === 'todos') {
                    curso.style.display = 'block';
                } else {
                    curso.style.display = curso.dataset.estado === filtro ? 'block' : 'none';
                }
            });
        });
    });
</script>
@endsection