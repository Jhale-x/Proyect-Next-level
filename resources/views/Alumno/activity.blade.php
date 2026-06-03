@extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/activityAlumno.css') }}">
@endpush

@section('title', 'Actividad - Next Level')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

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

            <select class="filter-select" id="filter-type">
                <option value="all">Todas las actividades</option>
                <option value="tarea">Tareas</option>
                <option value="anuncio">Anuncios</option>
                <option value="comunicacion">Comunicación</option>
            </select>

            <select class="filter-select" id="filter-date">
                <option value="all">Todas las fechas</option>
                <option value="today">Hoy</option>
                <option value="week">Últimos 7 días</option>
                <option value="month">Último mes</option>
            </select>

        </div>

        <!-- Timeline -->
        <div class="timeline-container">
            <div class="timeline">

                @forelse ($activities as $act)
                    @php
                        $texto = mb_strtolower(($act->actividad ?? '') . ' ' . ($act->descripcion ?? ''));

                        $tipo = 'comunicacion';
                        $color = 'blue';
                        $icon = '💬';

                        if (
                            str_contains($texto, 'tarea') ||
                            str_contains($texto, 'trabajo') ||
                            str_contains($texto, 'proyecto') ||
                            str_contains($texto, 'entrega')
                        ) {
                            $tipo = 'tarea';
                            $color = 'purple';
                            $icon = '📝';
                        } elseif (
                            str_contains($texto, 'anuncio') ||
                            str_contains($texto, 'comunicado') ||
                            str_contains($texto, 'aviso')
                        ) {
                            $tipo = 'anuncio';
                            $color = 'orange';
                            $icon = '📢';
                        }

                        $fecha = Carbon::parse($act->fecha_entrega);
                    @endphp

                    <div class="activity-item" data-type="{{ $tipo }}" data-date="{{ $fecha->format('Y-m-d') }}">

                        <!-- Fecha -->
                        <div class="activity-date">
                            {{ $fecha->format('d M Y') }}

                            <span>
                                @if ($act->hora_entrega)
                                    {{ Carbon::parse($act->hora_entrega)->format('h:i A') }}
                                @else
                                    Sin hora
                                @endif
                            </span>
                        </div>

                        <!-- Card -->
                        <div class="activity-card {{ $color }}">

                            <div class="timeline-icon">
                                {{ $icon }}
                            </div>

                            <div class="timeline-dot"></div>

                            <div class="activity-header">
                                {{ strtoupper($tipo) }}
                            </div>

                            <div class="activity-title">
                                {{ $act->materia }} - {{ $act->actividad }}
                            </div>

                            <div class="activity-comment">
                                {{ $act->descripcion ?: 'Sin descripción registrada.' }}
                            </div>
                        </div>
                    </div>

                @empty

                    <div class="activity-item">
                        <div class="activity-card blue">

                            <div class="activity-header">
                                SIN ACTIVIDADES
                            </div>

                            <div class="activity-title">
                                No hay actividades registradas
                            </div>

                            <div class="activity-comment">
                                Tus actividades aparecerán aquí.
                            </div>

                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        (() => {

            const filterType = document.getElementById('filter-type');
            const filterDate = document.getElementById('filter-date');
            const items = document.querySelectorAll('.activity-item');

            const isToday = (d) => {
                const now = new Date();

                return d.getDate() === now.getDate() &&
                    d.getMonth() === now.getMonth() &&
                    d.getFullYear() === now.getFullYear();
            };

            const isLast7Days = (d) => {
                const now = new Date();
                const last = new Date();

                last.setDate(now.getDate() - 7);

                return d >= last && d <= now;
            };

            const isLastMonth = (d) => {
                const now = new Date();

                return d.getMonth() === now.getMonth() &&
                    d.getFullYear() === now.getFullYear();
            };

            const applyFilters = () => {

                const type = filterType.value;
                const date = filterDate.value;

                items.forEach((item) => {

                    const itemType = item.dataset.type;
                    const itemDate = new Date(item.dataset.date + 'T00:00:00');

                    let show = true;

                    // Tipo
                    if (type !== 'all' && itemType !== type) {
                        show = false;
                    }

                    // Fecha
                    if (date !== 'all') {

                        if (date === 'today' && !isToday(itemDate)) {
                            show = false;
                        }

                        if (date === 'week' && !isLast7Days(itemDate)) {
                            show = false;
                        }

                        if (date === 'month' && !isLastMonth(itemDate)) {
                            show = false;
                        }
                    }

                    item.style.display = show ? '' : 'none';

                });

            };

            filterType.addEventListener('change', applyFilters);
            filterDate.addEventListener('change', applyFilters);

        })();
    </script>

@endsection
