@extends('layouts.Alumnoslanding')

@section('title', 'Calendario')

@push('styles')
    <style>
        /* ── Barra de días ── */
        .cal-day-bar {
            gap: 4px;
        }

        .day-item {
            padding: 8px 4px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none !important;
            color: inherit;
            transition: background .15s;
        }

        .day-item:hover {
            background: #f0f4ff;
            color: #0d6efd;
        }

        .day-item.active {
            background: #0d6efd;
            color: #fff !important;
        }

        .day-item.active .day-lbl,
        .day-item.active .day-num {
            color: #fff !important;
        }

        /* ── Filas hora ── */
        .hour-row {
            transition: background .15s;
        }

        .hour-row:hover {
            background: #f5f6fa;
        }

        .hour-label {
            width: 52px;
            font-size: .76rem;
            font-weight: 700;
            color: #94a3b8;
            text-align: right;
            padding-right: .65rem;
            flex-shrink: 0;
            line-height: 1.5;
        }

        /* ── Evento ── */
        .event-card {
            border-left: 4px solid #0d6efd;
            border-radius: 8px;
            background: #e7f1ff;
            font-size: .82rem;
            padding: .35rem .65rem;
            margin-bottom: .3rem;
        }

        /* ── Cuerpo con scroll ── */
        .calendar-body {
            max-height: 520px;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        /* ── Vista semana ── */
        .week-col {
            min-width: 0;
            flex: 1 1 0;
        }

        .week-col-head {
            font-size: .72rem;
            font-weight: 700;
            text-align: center;
            padding: 6px 2px;
            border-radius: 8px;
        }

        .week-col-head.active-week {
            background: #0d6efd;
            color: #fff;
        }

        .week-event-pill {
            font-size: .71rem;
            border-radius: 6px;
            padding: 2px 5px;
            margin-bottom: 3px;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
    </style>
@endpush

@section('content')
    @php
        use Carbon\Carbon;

        $fecha = request('fecha') ? Carbon::parse(request('fecha')) : Carbon::now();
        $inicioSemana = $fecha->copy()->startOfWeek(Carbon::MONDAY);
        $fechaStr = $fecha->toDateString();

        // ── (8) Optimización: pre-agrupar por hora para la vista diaria ──
        $actividadesDia = ($actividades ?? collect())->filter(fn($a) => $a->fecha === $fechaStr);
        $actividadesPorHora = $actividadesDia->groupBy(function ($a) {
            return $a->hora_entrega ? (int) explode(':', $a->hora_entrega)[0] : -1;
        });
        $actividadesSinHora = $actividadesDia->filter(fn($a) => !$a->hora_entrega);

        // Para la vista semanal: agrupar por fecha
        $actsSemana = [];
        for ($d = 0; $d < 7; $d++) {
            $dk = $inicioSemana->copy()->addDays($d)->toDateString();
            $actsSemana[$dk] = ($actividades ?? collect())->filter(fn($a) => $a->fecha === $dk)->values();
        }

        // ── (3) Paleta de colores por curso ──
        $paleta = [
            'comunicaci' => '#0d6efd',
            'matem' => '#198754',
            'ciencia' => '#0ea5e9',
            'social' => '#f59e0b',
            'historia' => '#d97706',
            'ética' => '#7c3aed',
            'etica' => '#7c3aed',
            'arte' => '#ec4899',
            'ingl' => '#06b6d4',
            'físic' => '#ef4444',
            'fisic' => '#ef4444',
        ];
        $getCursoColor = function (string $nombre) use ($paleta): string {
            $lower = mb_strtolower($nombre);
            foreach ($paleta as $k => $v) {
                if (str_contains($lower, $k)) {
                    return $v;
                }
            }
            return '#6c757d';
        };
    @endphp

    <div class="container-fluid px-2">

        <h4 class="mb-3 fw-bold">📆 Calendario</h4>

        {{-- ── Barra superior ── --}}
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

            <div class="fw-semibold small">
                {{ $fecha->translatedFormat('d \d\e M Y') }}
            </div>

            <div class="d-flex align-items-center gap-2">
                {{-- (6) Toggle Día / Semana --}}
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-primary" id="btnVistaDia">Día</button>
                    <button type="button" class="btn btn-outline-secondary" id="btnVistaSemana">Semana</button>
                </div>
                <a href="?fecha={{ $fecha->copy()->subDay()->toDateString() }}" class="btn btn-sm btn-outline-dark">◀</a>
                <a href="?fecha={{ Carbon::now()->toDateString() }}" class="btn btn-sm btn-outline-secondary">Hoy</a>
                <a href="?fecha={{ $fecha->copy()->addDay()->toDateString() }}" class="btn btn-sm btn-outline-dark">▶</a>
            </div>
        </div>

        {{-- ── (5) Días de la semana tipo tabs ── --}}
        <div class="d-flex justify-content-between text-center border-bottom pb-2 mb-1 cal-day-bar">
            @for ($i = 0; $i < 7; $i++)
                @php $dia = $inicioSemana->copy()->addDays($i); @endphp
                <a href="?fecha={{ $dia->toDateString() }}"
                    class="flex-fill day-item {{ $dia->isSameDay($fecha) ? 'active' : '' }}">
                    <div class="day-lbl small text-uppercase" style="font-size:.68rem; letter-spacing:.03em">
                        {{ $dia->translatedFormat('D') }}
                    </div>
                    <div class="day-num fw-bold">{{ $dia->day }}</div>
                </a>
            @endfor
        </div>

        {{-- ══════════════ VISTA DÍA ══════════════ --}}
        {{-- (10) Scroll interno --}}
        <div id="vista-dia" class="calendar-body mt-2">
            @if ($actividadesSinHora->count())
                <div class="mb-3">
                    <div class="fw-semibold mb-2">Actividades sin hora definida</div>
                    @foreach ($actividadesSinHora as $act)
                        @php $color = $getCursoColor($act->curso); @endphp
                        <div class="event-card mb-2"
                            style="border-left-color:{{ $color }}; background:{{ $color }}18;">
                            <strong style="color:{{ $color }}">{{ $act->curso }}</strong>
                            <span class="text-secondary"> — {{ $act->titulo }}</span>
                            <small class="text-muted ms-1">Sin hora asignada</small>
                        </div>
                    @endforeach
                </div>
            @endif

            @for ($i = 0; $i < 24; $i++)
                {{-- (1) Hover en fila hora --}}
                <div class="d-flex border-bottom py-2 align-items-start hour-row">

                    {{-- (4) Etiqueta hora mejorada --}}
                    <div class="hour-label">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</div>

                    <div class="flex-fill ps-1">
                        @if (isset($actividadesPorHora[$i]) && $actividadesPorHora[$i]->count())
                            {{-- (8) Sin loop redundante de 24 iteraciones --}}
                            @foreach ($actividadesPorHora[$i] as $act)
                                @php $color = $getCursoColor($act->curso); @endphp
                                {{-- (2) Event-card moderno  (3) color dinámico --}}
                                <div class="event-card"
                                    style="border-left-color:{{ $color }}; background:{{ $color }}18;">
                                    <strong style="color:{{ $color }}">{{ $act->curso }}</strong>
                                    <span class="text-secondary"> — {{ $act->titulo }}</span>
                                    @if ($act->hora_entrega)
                                        <small class="text-muted ms-1">{{ substr($act->hora_entrega, 0, 5) }}</small>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            {{-- (7) Placeholder horas vacías --}}
                            <small class="text-muted" style="font-size:.71rem">Sin actividades</small>
                        @endif
                    </div>
                </div>
            @endfor
        </div>

        {{-- ══════════════ (6) VISTA SEMANA ══════════════ --}}
        <div id="vista-semana" class="d-none mt-2" style="overflow-x:auto">
            <div class="d-flex gap-1" style="min-width:500px">
                @for ($d = 0; $d < 7; $d++)
                    @php
                        $diaCol = $inicioSemana->copy()->addDays($d);
                        $diaKey = $diaCol->toDateString();
                        $eventos = $actsSemana[$diaKey] ?? collect();
                        $esHoy = $diaCol->isSameDay($fecha);
                    @endphp
                    <div class="week-col">
                        <div class="week-col-head {{ $esHoy ? 'active-week' : '' }}">
                            <div style="font-size:.64rem">{{ strtoupper($diaCol->translatedFormat('D')) }}</div>
                            <div>{{ $diaCol->day }}</div>
                        </div>
                        <div class="mt-1">
                            @forelse ($eventos as $act)
                                @php $color = $getCursoColor($act->curso); @endphp
                                <span class="week-event-pill" style="background:{{ $color }}"
                                    title="{{ $act->curso }}: {{ $act->titulo }}">
                                    {{ Str::limit($act->titulo, 16) }}
                                </span>
                            @empty
                                <div class="text-center text-muted pt-1" style="font-size:.7rem">—</div>
                            @endforelse
                        </div>
                    </div>
                @endfor
            </div>
        </div>

    </div>

    <script>
        (() => {
            const btnDia = document.getElementById('btnVistaDia');
            const btnSemana = document.getElementById('btnVistaSemana');
            const vistaDia = document.getElementById('vista-dia');
            const vistaSem = document.getElementById('vista-semana');

            btnDia.addEventListener('click', () => {
                vistaDia.classList.remove('d-none');
                vistaSem.classList.add('d-none');
                btnDia.classList.replace('btn-outline-secondary', 'btn-primary');
                btnSemana.classList.replace('btn-primary', 'btn-outline-secondary');
            });

            btnSemana.addEventListener('click', () => {
                vistaSem.classList.remove('d-none');
                vistaDia.classList.add('d-none');
                btnSemana.classList.replace('btn-outline-secondary', 'btn-primary');
                btnDia.classList.replace('btn-primary', 'btn-outline-secondary');
            });
        })();
    </script>
@endsection
