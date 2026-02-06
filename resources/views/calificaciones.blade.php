@extends('layouts.app')

@section('title', 'Calificaciones por Semestre')

@section('content')
@php
    $semestres = [
        1 => [
            [
                'id' => 1,
                'codigo' => '202602-INGL-155-TEC-NRC_76',
                'nombre'    => 'BASIC 4',
                'notas' => [
                    ['titulo' => 'Speaking 1', 'nota' => 14],
                    ['titulo' => 'Speaking 2', 'nota' => 15],
                    ['titulo' => 'Final Project', 'nota' => 16],
                    ['titulo' => 'Attendance', 'nota' => '87.5 %'],
                ]
            ],
            [
                'id' => 2,
                'codigo' => '202602-MATE-210-TEC',
                'nombre' => 'Matemática Aplicada',
                'notas' => [
                    ['titulo' => 'Práctica 1', 'nota' => 18],
                    ['titulo' => 'Examen Parcial', 'nota' => 17],
                ]
            ],
        ],
        2 => [
            [
                'id' => 3,
                'codigo' => 'PREVENCION-202510-38',
                'nombre' => 'Prevención de Accidentes',
                'notas' => []
            ],
            [
                'id' => 4,
                'codigo' => 'PROG-202510-101',
                'nombre' => 'Programación I',
                'notas' => [
                    ['titulo' => 'Algoritmos', 'nota' => 19],
                    ['titulo' => 'POO', 'nota' => 18],
                ]
            ],
        ],
        3 => [
            [
                'id' => 5,
                'codigo' => 'FISICA-303-202410',
                'nombre' => 'Física General',
                'notas' => [
                    ['titulo' => 'Cinemática', 'nota' => 16],
                    ['titulo' => 'Dinámica', 'nota' => 15],
                    ['titulo' => 'Termodinámica', 'nota' => 14],
                ]
            ],
        ],
        4 => [
            [
                'id' => 6,
                'codigo' => 'ESTADISTICA-404-202410',
                'nombre' => 'Estadística Aplicada',
                'notas' => [
                    ['titulo' => 'Probabilidades', 'nota' => 17],
                    ['titulo' => 'Distribuciones', 'nota' => 18],
                ]
            ],
        ],
    ];
@endphp

<div class="container mt-3">
    <h3 class="mb-5">📊 Calificaciones por Semestre</h3>

    @foreach($semestres as $num => $cursos)
        <h5 class="mt-4 mb-3 text-primary">Semestre {{ $num }}</h5>

        @foreach($cursos as $curso)
            <div class="card mb-2 shadow-sm"
                 data-bs-toggle="offcanvas"
                 data-bs-target="#panelCurso{{ $curso['id'] }}"
                 style="cursor:pointer;">

                <div class="card-header py-2 border-top border-3 border-primary">
                    <small class="text-muted">{{ $curso['codigo'] }}</small>
                    <h6 class="mb-0">{{ $curso['nombre'] }}</h6>
                </div>

                <div class="card-body py-2">
                    <p class="fw-bold mb-1">Calificaciones recientes</p>

                    @forelse(array_slice($curso['notas'], 0, 3) as $nota)
                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span>📝 {{ $nota['titulo'] }}</span>
                            <span class="badge bg-dark">{{ $nota['nota'] }}</span>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Aún no hay calificaciones.</p>
                    @endforelse
                </div>
            </div>

            <!-- Panel lateral -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="panelCurso{{ $curso['id'] }}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">{{ $curso['nombre'] }} - Calificaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="list-group">
                        @forelse($curso['notas'] as $nota)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $nota['titulo'] }}</span>
                                <span class="badge bg-primary">{{ $nota['nota'] }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No hay notas registradas</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
@endsection