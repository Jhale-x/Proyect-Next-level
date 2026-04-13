@extends('layouts.Adminlanding')

@section('title', 'Actividad')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/activity.css') }}">
@endpush

@section('content')
    @php
        use Carbon\Carbon;

        $activitiesBySalon =
            $activitiesBySalon ??
            collect($activities ?? [])->groupBy(function ($activity) {
                return $activity->salon_nombre ?? 'Sin salon asignado';
            });

        $cursosDisponibles = collect($activities ?? [])
            ->pluck('materia')
            ->filter()
            ->unique()
            ->sort()
            ->values();
    @endphp
    <div class="container-fluid page-wrap">
        <div class="page-header mb-4">
            <div>
                <h1 class="section-title mb-1">Gestión de Página Institucional</h1>
                <p class="text-muted mb-0">Administra anuncios y contenido.</p>
            </div>
        </div>

        <div class="activity-wrapper">

            <div class="filters">
                <div class="filters-grid">
                    <div>
                        <label class="form-label small text-muted mb-1">Buscar actividad</label>
                        <input type="text" class="form-control" id="filter-text"
                            placeholder="Ej: ETI, speaking, proyecto...">
                    </div>
                    <div>
                        <label class="form-label small text-muted mb-1">Curso</label>
                        <select class="form-select" id="filter-course">
                            <option value="all">Todos los cursos</option>
                            @foreach ($cursosDisponibles as $curso)
                                <option value="{{ $curso }}">{{ $curso }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label small text-muted mb-1">Fecha</label>
                        <select class="form-select" id="filter-date">
                            <option value="all">Todas</option>
                            <option value="today">Hoy</option>
                            <option value="week">Proximos 7 dias</option>
                            <option value="month">Este mes</option>
                            <option value="overdue">Vencidas</option>
                        </select>
                    </div>
                </div>

                <div class="quick-types">
                    <button type="button" class="btn btn-outline-secondary btn-sm filter-type active"
                        data-type="all">Todos</button>
                    <button type="button" class="btn btn-outline-primary btn-sm filter-type"
                        data-type="comunicacion">Comunicacion</button>
                    <button type="button" class="btn btn-outline-success btn-sm filter-type"
                        data-type="tarea">Tareas</button>
                    <button type="button" class="btn btn-outline-warning btn-sm filter-type"
                        data-type="anuncio">Anuncios</button>
                </div>
            </div>

            <div id="empty-filter" class="empty-filter mb-3">
                No se encontraron actividades con esos filtros.
            </div>

            <div class="timeline-container">
                @forelse ($activitiesBySalon as $salonNombre => $salonActivities)
                    <section class="mb-5 salon-section">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                            <div>
                                <h2 class="h5 mb-1">
                                    <i class="bi bi-book me-2"></i>{{ $salonNombre }}
                                </h2>
                                <small class="text-muted salon-count">
                                    {{ $salonActivities->count() }} actividades registradas
                                </small>
                            </div>
                        </div>
                        <div class="timeline">
                            @foreach ($salonActivities as $act)
                                @php
                                    $texto = mb_strtolower(($act->actividad ?? '') . ' ' . ($act->descripcion ?? ''));
                                    $tipo = 'comunicacion';

                                    if (
                                        str_contains($texto, 'tarea') ||
                                        str_contains($texto, 'trabajo') ||
                                        str_contains($texto, 'proyecto') ||
                                        str_contains($texto, 'entrega')
                                    ) {
                                        $tipo = 'tarea';
                                    } elseif (
                                        str_contains($texto, 'anuncio') ||
                                        str_contains($texto, 'comunicado') ||
                                        str_contains($texto, 'aviso')
                                    ) {
                                        $tipo = 'anuncio';
                                    }

                                    $tipoMeta = [
                                        'comunicacion' => [
                                            'label' => 'Comunicacion',
                                            'badge' => 'primary',
                                            'icon' => 'bi-chat-dots',
                                        ],
                                        'tarea' => [
                                            'label' => 'Tarea',
                                            'badge' => 'success',
                                            'icon' => 'bi-journal-check',
                                        ],
                                        'anuncio' => [
                                            'label' => 'Anuncio',
                                            'badge' => 'warning text-dark',
                                            'icon' => 'bi-megaphone',
                                        ],
                                    ][$tipo];

                                    $fechaEntrega = Carbon::parse($act->fecha_entrega);
                                    $status = 'Pendiente';
                                    $statusClass = 'warning text-dark';

                                    if ($fechaEntrega->isPast() && !$fechaEntrega->isToday()) {
                                        $status = 'Vencido';
                                        $statusClass = 'danger';
                                    } elseif ($fechaEntrega->isToday()) {
                                        $status = 'Hoy';
                                        $statusClass = 'info text-dark';
                                    }
                                @endphp

                                <div class="activity-item" data-type="{{ $tipo }}" data-course="{{ $act->materia }}"
                                    data-date="{{ $fechaEntrega->format('Y-m-d') }}"
                                    data-search="{{ mb_strtolower(($act->actividad ?? '') . ' ' . ($act->descripcion ?? '') . ' ' . ($act->materia ?? '')) }}">

                                    <div class="activity-date">
                                        <small class="text-muted">{{ $fechaEntrega->diffForHumans() }}</small><br>
                                        <small>{{ $fechaEntrega->format('d/m/Y') }}</small>
                                    </div>

                                    <div class="activity-card tipo-{{ $tipo }}">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="activity-header mb-0">
                                                <i class="bi bi-building me-1"></i>{{ $act->salon_nombre }}
                                            </div>
                                            <span class="badge bg-{{ $statusClass }}">{{ $status }}</span>
                                        </div>

                                        <div class="activity-title mb-2">
                                            Nueva actividad: <strong>{{ $act->actividad }}</strong>
                                        </div>

                                        <div class="activity-comment">
                                            {{ $act->descripcion ?: 'Sin descripcion registrada.' }}
                                        </div>

                                        <div class="activity-comment mb-2">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            Entrega: {{ $fechaEntrega->format('d/m/Y') }}
                                            @if ($act->hora_entrega)
                                                a las {{ Carbon::parse($act->hora_entrega)->format('H:i') }}
                                            @endif
                                        </div>

                                        <div class="d-flex flex-wrap align-items-center gap-2 activity-meta">
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-book me-1"></i>Curso: {{ $act->materia }}
                                            </span>
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-person-circle me-1"></i>Publicado por:
                                                {{ Auth::user()->nombre ?? 'Admin' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @empty
                    <div class="alert alert-light border">No hay actividades registradas.</div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        (() => {
            const typeButtons = document.querySelectorAll('.filter-type');
            const courseSelect = document.getElementById('filter-course');
            const dateSelect = document.getElementById('filter-date');
            const textInput = document.getElementById('filter-text');
            const items = document.querySelectorAll('.activity-item');
            const salonSections = document.querySelectorAll('.salon-section');
            const empty = document.getElementById('empty-filter');
            let activeType = 'all';

            const normalizeDate = (dateText) => {
                const d = new Date(dateText + 'T00:00:00');
                return isNaN(d.getTime()) ? null : d;
            };

            const isInCurrentMonth = (d) => {
                const now = new Date();
                return d.getMonth() === now.getMonth() && d.getFullYear() === now.getFullYear();
            };

            const isInNext7Days = (d) => {
                const now = new Date();
                const start = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                const end = new Date(start);
                end.setDate(end.getDate() + 7);
                return d >= start && d <= end;
            };

            const isToday = (d) => {
                const now = new Date();
                return d.getDate() === now.getDate() && d.getMonth() === now.getMonth() && d.getFullYear() === now
                    .getFullYear();
            };

            const isOverdue = (d) => {
                const now = new Date();
                const start = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                return d < start;
            };

            const applyFilters = () => {
                const selectedCourse = courseSelect.value;
                const selectedDate = dateSelect.value;
                const query = textInput.value.trim().toLowerCase();
                let visibleTotal = 0;

                items.forEach((item) => {
                    const itemType = item.dataset.type;
                    const itemCourse = item.dataset.course;
                    const itemDate = normalizeDate(item.dataset.date);
                    const searchable = item.dataset.search || '';

                    const matchType = activeType === 'all' || itemType === activeType;
                    const matchCourse = selectedCourse === 'all' || itemCourse === selectedCourse;
                    const matchText = query === '' || searchable.includes(query);

                    let matchDate = true;
                    if (itemDate && selectedDate !== 'all') {
                        if (selectedDate === 'today') matchDate = isToday(itemDate);
                        if (selectedDate === 'week') matchDate = isInNext7Days(itemDate);
                        if (selectedDate === 'month') matchDate = isInCurrentMonth(itemDate);
                        if (selectedDate === 'overdue') matchDate = isOverdue(itemDate);
                    }

                    const visible = matchType && matchCourse && matchDate && matchText;
                    item.style.display = visible ? '' : 'none';
                    if (visible) visibleTotal++;
                });


                salonSections.forEach((section) => {
                    const visibleCount = section.querySelectorAll('.activity-item:not([style*="display: none"])').length;
                    section.style.display = visibleCount > 0 ? '' : 'none';
                    const countEl = section.querySelector('.salon-count');
                    if (countEl) {
                        countEl.textContent = `${visibleCount} actividades registradas`;
                    }
                });

                empty.style.display = visibleTotal === 0 ? 'block' : 'none';
            };

            typeButtons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    typeButtons.forEach((b) => b.classList.remove('active'));
                    btn.classList.add('active');
                    activeType = btn.dataset.type;
                    applyFilters();
                });
            });

            [courseSelect, dateSelect, textInput].forEach((el) => {
                el.addEventListener('input', applyFilters);
                el.addEventListener('change', applyFilters);
            });
        })();
    </script>

@endsection
