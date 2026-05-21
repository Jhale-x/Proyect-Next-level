 @extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/eti.css') }}">
@endpush

@section('title', 'ETI - Next Level')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
        <div class="bg-primary text-white p-2 rounded me-3">
            <i class="bi bi-cpu-fill fs-3"></i>
        </div>
        <div>
            <h2 class="fw-bold m-0" style="color: #0a1f44;">Módulo ETAS</h2>
            <p class="text-muted m-0">Evaluación Tecnológica Integral</p>
        </div>
    </div>

    <!-- Información del Alumno -->
    <div class="card shadow-sm border-0 mb-4 bg-gradient-primary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2">{{ $alumno->nombre }} {{ $alumno->apellido }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Nivel</small>
                            <p class="fw-bold mb-0">{{ $nivel ?? 'No asignado' }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Grado</small>
                            <p class="fw-bold mb-0">{{ $grado ?? 'No asignado' }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Sección</small>
                            <p class="fw-bold mb-0">{{ $seccion ?? 'No asignado' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="bg-white rounded p-3 d-inline-block">
                        <small class="text-muted">Promedio General</small>
                        <h3 class="mb-0 {{ $promedioGeneral >= 13 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($promedioGeneral, 1) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Notas por Semana -->
    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0"><i class="bi bi-pencil-square me-2"></i>Registro de Notas por Semanas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="text-start ps-4" style="min-width: 200px;">Evaluación</th>
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="border-start">Semana {{ $i }}</th>
                            @endfor
                            <th class="bg-primary text-white">Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $materias = [
                                'Matemática',
                                'Comunicación',
                                'Ciencia y Tecnología',
                                'Personal Social',
                                'Inglés'
                            ];
                        @endphp
                        
                        @foreach($materias as $index => $materia)
                            @php
                                $notasMateria = $notas[$materia] ?? array_fill(1, 10, null);
                                $promedioMateria = collect($notasMateria)->filter()->avg();
                            @endphp
                            <tr>
                                <td class="text-start ps-4 fw-bold text-secondary">{{ $materia }}</td>
                                @for ($semana = 1; $semana <= 10; $semana++)
                                    <td class="text-center border-start">
                                        @if(isset($notasMateria[$semana]))
                                            <span class="badge {{ $notasMateria[$semana] >= 13 ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                                {{ $notasMateria[$semana] }}
                                            </span>
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-center fw-bold bg-light">
                                    @if($promedioMateria)
                                        <span class="{{ $promedioMateria >= 13 ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($promedioMateria, 1) }}
                                        </span>
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <th class="text-start ps-4">PROMEDIO POR SEMANA</th>
                            @for ($semana = 1; $semana <= 10; $semana++)
                                @php
                                    $sumaSemana = 0;
                                    $countSemana = 0;
                                    foreach($materias as $materia) {
                                        if(isset($notas[$materia][$semana])) {
                                            $sumaSemana += $notas[$materia][$semana];
                                            $countSemana++;
                                        }
                                    }
                                    $promedioSemana = $countSemana > 0 ? $sumaSemana / $countSemana : null;
                                @endphp
                                <th class="text-center border-start">
                                    @if($promedioSemana)
                                        <span class="{{ $promedioSemana >= 13 ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($promedioSemana, 1) }}
                                        </span>
                                    @else
                                        --
                                    @endif
                                </th>
                            @endfor
                            <th class="bg-primary text-white">
                                {{ number_format($promedioGeneral, 1) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection