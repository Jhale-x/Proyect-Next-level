@extends('layouts.Adminlanding')

@section('title', 'Actividad')

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

    <style>
        .activity-wrapper .header h1 {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.2rem;
        }

        .activity-wrapper .header .sub {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr;
            gap: 0.8rem;
            margin-bottom: 1.2rem;
        }

        .filters-grid .form-select,
        .filters-grid .form-control {
            border-radius: 10px;
            border-color: #dbe1ea;
        }

        .quick-types {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.2rem;
        }

        .quick-types .btn {
            border-radius: 999px;
        }

        .timeline::before {
            width: 3px;
            background: linear-gradient(to bottom, #0d6efd, #6c757d);
        }

        .activity-card {
            border-left-width: 4px;
            border-left-style: solid;
            border-left-color: #6c757d;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .activity-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.12);
        }

        .activity-card::before {
            content: "";
            font-family: bootstrap-icons;
            background: #fff;
            border-color: #dbe1ea;
        }

        .activity-card.tipo-comunicacion {
            border-left-color: #0d6efd;
        }

        .activity-card.tipo-comunicacion::before {
            content: "\\F217";
            color: #0d6efd;
        }

        .activity-card.tipo-tarea {
            border-left-color: #198754;
        }

        .activity-card.tipo-tarea::before {
            content: "\\F4C6";
            color: #198754;
        }

        .activity-card.tipo-anuncio {
            border-left-color: #ffc107;
        }

        .activity-card.tipo-anuncio::before {
            content: "\\F47A";
            color: #b58100;
        }

        .activity-date {
            font-style: normal;
        }

        .activity-meta .badge {
            border-radius: 999px;
        }

        .activity-title {
            color: #111827;
        }

        .activity-comment {
            color: #5f6572;
            font-style: normal;
            margin-bottom: 0.6rem;
        }

        .empty-filter {
            display: none;
            border: 1px dashed #cdd4df;
            border-radius: 10px;
            padding: 1rem;
            color: #6b7280;
            background: #fff;
        }

        @media (max-width: 992px) {
            .filters-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="activity-wrapper">
        <div class="header">
            <div>
                <h1>Flujo de actividades</h1>
                <p class="sub">Timeline de actividades con filtros por tipo, curso y fecha.</p>
            </div>
            <div class="settings-icon" title="Configuracion visual">
                <i class="bi bi-sliders"></i>
            </div>
        </div>

        <div class="filters">
            <div class="filters-grid">
                <div>
                    <label class="form-label small text-muted mb-1">Buscar actividad</label>
                    <input type="text" class="form-control" id="filter-text" placeholder="Ej: ETI, speaking, proyecto...">
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
                <button type="button" class="btn btn-outline-success btn-sm filter-type" data-type="tarea">Tareas</button>
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
                            <h2 class="h5 mb-1"><i class="bi bi-building me-2"></i>{{ $salonNombre }}</h2>
                            <small class="text-muted salon-count">{{ $salonActivities->count() }} actividades
                                registradas</small>
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
                                    'tarea' => ['label' => 'Tarea', 'badge' => 'success', 'icon' => 'bi-journal-check'],
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
                                            <i class="bi {{ $tipoMeta['icon'] }} me-1"></i>{{ $tipoMeta['label'] }}
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
                    const visibleInSection = section.querySelectorAll('.activity-item[style=""]').length;
                    const alsoVisible = section.querySelectorAll(
                        '.activity-item:not([style*="display: none"])').length;
                    const count = Math.max(visibleInSection, alsoVisible);
                    section.style.display = count > 0 ? '' : 'none';
                    const countEl = section.querySelector('.salon-count');
                    if (countEl) {
                        countEl.textContent = `${count} actividades registradas`;
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
