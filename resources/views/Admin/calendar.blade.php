@extends('layouts.Adminlanding')

@section('title', 'Calendario')

@section('content')
@php
    use Carbon\Carbon;

    $fecha = request('fecha')
        ? Carbon::parse(request('fecha'))
        : Carbon::now();

    $inicioSemana = $fecha->copy()->startOfWeek(Carbon::MONDAY);
@endphp

<div class="container-fluid px-2">

    <h4 class="mb-3">📆 Calendario</h4>

    <!-- Barra superior -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <button class="btn btn-sm btn-dark">Programar</button>
        </div>

        <div class="fw-semibold">
            {{ $fecha->translatedFormat('d M Y') }}
        </div>

        <div>
            <a href="?fecha={{ $fecha->copy()->subDay()->toDateString() }}" class="btn btn-sm btn-outline-dark">◀</a>
            <a href="?fecha={{ Carbon::now()->toDateString() }}" class="btn btn-sm btn-outline-secondary">Hoy</a>
            <a href="?fecha={{ $fecha->copy()->addDay()->toDateString() }}" class="btn btn-sm btn-outline-dark">▶</a>
        </div>
    </div>

    <!-- Días semana -->
    <div class="d-flex justify-content-between text-center border-bottom pb-2 mb-2">
        @for($i = 0; $i < 7; $i++)
            @php $dia = $inicioSemana->copy()->addDays($i); @endphp
            <div class="flex-fill {{ $dia->isSameDay($fecha) ? 'text-primary fw-bold' : '' }}">
                {{ strtoupper($dia->translatedFormat('D')) }}<br>
                @if($dia->isSameDay($fecha))
                    <span class="badge rounded-circle bg-primary">{{ $dia->day }}</span>
                @else
                    <small>{{ $dia->day }}</small>
                @endif
            </div>
        @endfor
    </div>

    <!-- Agenda por horas -->
    <div class="mt-3">
        @for($i = 0; $i < 24; $i++)
            <div class="d-flex border-bottom py-2 align-items-start">
                
                <!-- Hora -->
                <div style="width:60px" class="text-muted text-end pe-2">
                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                </div>

                <!-- Eventos -->
                <div class="flex-fill">

                    @foreach($actividades as $act)
                        @php
                            // ⚠️ TEMPORAL (no tienes hora en BD)
                            $hora = 9;
                        @endphp

                        @if($act->fecha == $fecha->toDateString() && $hora == $i)
                            <div class="alert alert-primary py-1 px-2 mb-1">
                                <strong>{{ $act->curso }}</strong><br>
                                <small>📌 {{ $act->titulo }}</small>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        @endfor
    </div>

</div>
@endsection