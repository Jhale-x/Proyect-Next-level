@extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/calificaciones.css') }}">
@endpush

@section('title', 'Calificaciones - Next Level')

@section('content')
<div class="calificaciones-container">
    
    <div class="calificaciones-header">
        <h3>Mis Calificaciones</h3>
        <p>Consulta tus notas por bimestre académico</p>
    </div>

    @php
        // Datos de cursos por bimestre
        $cursos = [
            'Matemática',
            'Comunicación',
            'Ciencia y Tecnología',
            'Personal Social',
            'Inglés'
        ];
        
        // Notas por bimestre y por curso
        $notasBimestres = [
            1 => [ // Bimestre 1
                'Matemática' => ['notas' => [15, 16, 14], 'promedio' => 15.0],
                'Comunicación' => ['notas' => [14, 15, 16], 'promedio' => 15.0],
                'Ciencia y Tecnología' => ['notas' => [16, 17, 15], 'promedio' => 16.0],
                'Personal Social' => ['notas' => [13, 14, 15], 'promedio' => 14.0],
                'Inglés' => ['notas' => [17, 16, 18], 'promedio' => 17.0],
            ],
            2 => [ // Bimestre 2
                'Matemática' => ['notas' => [14, 15, 16], 'promedio' => 15.0],
                'Comunicación' => ['notas' => [15, 14, 15], 'promedio' => 14.7],
                'Ciencia y Tecnología' => ['notas' => [15, 16, 14], 'promedio' => 15.0],
                'Personal Social' => ['notas' => [14, 13, 14], 'promedio' => 13.7],
                'Inglés' => ['notas' => [16, 17, 15], 'promedio' => 16.0],
            ],
            3 => [ // Bimestre 3
                'Matemática' => ['notas' => [16, 17, 15], 'promedio' => 16.0],
                'Comunicación' => ['notas' => [14, 15, 16], 'promedio' => 15.0],
                'Ciencia y Tecnología' => ['notas' => [17, 16, 18], 'promedio' => 17.0],
                'Personal Social' => ['notas' => [15, 14, 15], 'promedio' => 14.7],
                'Inglés' => ['notas' => [18, 17, 19], 'promedio' => 18.0],
            ],
            4 => [ // Bimestre 4
                'Matemática' => ['notas' => [15, 16, 17], 'promedio' => 16.0],
                'Comunicación' => ['notas' => [16, 15, 16], 'promedio' => 15.7],
                'Ciencia y Tecnología' => ['notas' => [16, 17, 16], 'promedio' => 16.3],
                'Personal Social' => ['notas' => [14, 15, 14], 'promedio' => 14.3],
                'Inglés' => ['notas' => [17, 18, 17], 'promedio' => 17.3],
            ],
        ];
        
        // Calcular promedio general por bimestre
        $promediosBimestre = [];
        foreach ($notasBimestres as $bimestre => $cursosNotas) {
            $suma = 0;
            $count = 0;
            foreach ($cursosNotas as $curso) {
                $suma += $curso['promedio'];
                $count++;
            }
            $promediosBimestre[$bimestre] = $count > 0 ? $suma / $count : 0;
        }
        
        // Función para determinar clase del promedio
        function getPromedioClass($promedio) {
            if ($promedio >= 17) return 'promedio-excelente';
            if ($promedio >= 14) return 'promedio-bueno';
            if ($promedio >= 11) return 'promedio-regular';
            return 'promedio-bajo';
        }
        
        function getNotaClass($nota) {
            if ($nota >= 17) return 'nota-excelente';
            if ($nota >= 14) return 'nota-bueno';
            if ($nota >= 11) return 'nota-regular';
            return 'nota-bajo';
        }
        
        function getEstado($promedio) {
            if ($promedio >= 13) return 'Aprobado ✅';
            return 'Desaprobado ❌';
        }
    @endphp

    <!-- Tabs de Bimestres -->
    <div class="bimestres-tabs">
        <button class="bimestre-tab active" onclick="mostrarBimestre(1)">
            Bimestre I
            <span class="bimestre-numero">Mar - Abr</span>
        </button>
        <button class="bimestre-tab" onclick="mostrarBimestre(2)">
            Bimestre II
            <span class="bimestre-numero">May - Jun</span>
        </button>
        <button class="bimestre-tab" onclick="mostrarBimestre(3)">
            Bimestre III
            <span class="bimestre-numero">Ago - Sep</span>
        </button>
        <button class="bimestre-tab" onclick="mostrarBimestre(4)">
            Bimestre IV
            <span class="bimestre-numero">Oct - Nov</span>
        </button>
    </div>

    <!-- Panel Bimestre 1 -->
    <div id="bimestre1" class="bimestre-panel active">
        <div class="bimestre-stats">
            <div class="bimestre-promedio">
                <h4>Promedio del Bimestre</h4>
                <div class="promedio-valor {{ getPromedioClass($promediosBimestre[1]) }}">{{ number_format($promediosBimestre[1], 1) }}</div>
            </div>
            <div class="bimestre-estado">
                <span class="estado-badge">{{ getEstado($promediosBimestre[1]) }}</span>
                <span class="estado-nota">Rendimiento académico</span>
            </div>
        </div>
        
        <div class="cursos-grid">
            @foreach($cursos as $curso)
                @php $datos = $notasBimestres[1][$curso]; @endphp
                <div class="curso-card">
                    <div class="curso-header">
                        <div class="curso-info">
                            <h5>{{ $curso }}</h5>
                            <span class="curso-codigo">Cód: {{ strtoupper(substr($curso, 0, 4)) }}-2025</span>
                        </div>
                        <div class="curso-promedio">
                            <span>Promedio</span>
                            <span class="promedio-numero {{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</span>
                        </div>
                    </div>
                    <div class="curso-body">
                        <div class="notas-header">
                            <span>Evaluaciones</span>
                            <span>Nota</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-pencil"></i> Práctica Calificada 1</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][0]) }}">{{ $datos['notas'][0] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-file-text"></i> Examen Parcial</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][1]) }}">{{ $datos['notas'][1] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-journal"></i> Trabajo Final</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][2]) }}">{{ $datos['notas'][2] }}</span>
                        </div>
                    </div>
                    <div class="curso-footer">
                        <span class="promedio-final">
                            <i class="bi bi-graph-up"></i> 
                            Promedio final: <strong class="{{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</strong>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Panel Bimestre 2 -->
    <div id="bimestre2" class="bimestre-panel">
        <div class="bimestre-stats">
            <div class="bimestre-promedio">
                <h4>Promedio del Bimestre</h4>
                <div class="promedio-valor {{ getPromedioClass($promediosBimestre[2]) }}">{{ number_format($promediosBimestre[2], 1) }}</div>
            </div>
            <div class="bimestre-estado">
                <span class="estado-badge">{{ getEstado($promediosBimestre[2]) }}</span>
                <span class="estado-nota">Rendimiento académico</span>
            </div>
        </div>
        
        <div class="cursos-grid">
            @foreach($cursos as $curso)
                @php $datos = $notasBimestres[2][$curso]; @endphp
                <div class="curso-card">
                    <div class="curso-header">
                        <div class="curso-info">
                            <h5>{{ $curso }}</h5>
                            <span class="curso-codigo">Cód: {{ strtoupper(substr($curso, 0, 4)) }}-2025</span>
                        </div>
                        <div class="curso-promedio">
                            <span>Promedio</span>
                            <span class="promedio-numero {{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</span>
                        </div>
                    </div>
                    <div class="curso-body">
                        <div class="notas-header">
                            <span>Evaluaciones</span>
                            <span>Nota</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-pencil"></i> Práctica Calificada 1</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][0]) }}">{{ $datos['notas'][0] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-file-text"></i> Examen Parcial</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][1]) }}">{{ $datos['notas'][1] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-journal"></i> Trabajo Final</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][2]) }}">{{ $datos['notas'][2] }}</span>
                        </div>
                    </div>
                    <div class="curso-footer">
                        <span class="promedio-final">
                            <i class="bi bi-graph-up"></i> 
                            Promedio final: <strong class="{{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</strong>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Panel Bimestre 3 -->
    <div id="bimestre3" class="bimestre-panel">
        <div class="bimestre-stats">
            <div class="bimestre-promedio">
                <h4>Promedio del Bimestre</h4>
                <div class="promedio-valor {{ getPromedioClass($promediosBimestre[3]) }}">{{ number_format($promediosBimestre[3], 1) }}</div>
            </div>
            <div class="bimestre-estado">
                <span class="estado-badge">{{ getEstado($promediosBimestre[3]) }}</span>
                <span class="estado-nota">Rendimiento académico</span>
            </div>
        </div>
        
        <div class="cursos-grid">
            @foreach($cursos as $curso)
                @php $datos = $notasBimestres[3][$curso]; @endphp
                <div class="curso-card">
                    <div class="curso-header">
                        <div class="curso-info">
                            <h5>{{ $curso }}</h5>
                            <span class="curso-codigo">Cód: {{ strtoupper(substr($curso, 0, 4)) }}-2025</span>
                        </div>
                        <div class="curso-promedio">
                            <span>Promedio</span>
                            <span class="promedio-numero {{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</span>
                        </div>
                    </div>
                    <div class="curso-body">
                        <div class="notas-header">
                            <span>Evaluaciones</span>
                            <span>Nota</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-pencil"></i> Práctica Calificada 1</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][0]) }}">{{ $datos['notas'][0] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-file-text"></i> Examen Parcial</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][1]) }}">{{ $datos['notas'][1] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-journal"></i> Trabajo Final</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][2]) }}">{{ $datos['notas'][2] }}</span>
                        </div>
                    </div>
                    <div class="curso-footer">
                        <span class="promedio-final">
                            <i class="bi bi-graph-up"></i> 
                            Promedio final: <strong class="{{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</strong>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Panel Bimestre 4 -->
    <div id="bimestre4" class="bimestre-panel">
        <div class="bimestre-stats">
            <div class="bimestre-promedio">
                <h4>Promedio del Bimestre</h4>
                <div class="promedio-valor {{ getPromedioClass($promediosBimestre[4]) }}">{{ number_format($promediosBimestre[4], 1) }}</div>
            </div>
            <div class="bimestre-estado">
                <span class="estado-badge">{{ getEstado($promediosBimestre[4]) }}</span>
                <span class="estado-nota">Rendimiento académico</span>
            </div>
        </div>
        
        <div class="cursos-grid">
            @foreach($cursos as $curso)
                @php $datos = $notasBimestres[4][$curso]; @endphp
                <div class="curso-card">
                    <div class="curso-header">
                        <div class="curso-info">
                            <h5>{{ $curso }}</h5>
                            <span class="curso-codigo">Cód: {{ strtoupper(substr($curso, 0, 4)) }}-2025</span>
                        </div>
                        <div class="curso-promedio">
                            <span>Promedio</span>
                            <span class="promedio-numero {{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</span>
                        </div>
                    </div>
                    <div class="curso-body">
                        <div class="notas-header">
                            <span>Evaluaciones</span>
                            <span>Nota</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-pencil"></i> Práctica Calificada 1</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][0]) }}">{{ $datos['notas'][0] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-file-text"></i> Examen Parcial</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][1]) }}">{{ $datos['notas'][1] }}</span>
                        </div>
                        <div class="nota-fila">
                            <span class="nota-nombre"><i class="bi bi-journal"></i> Trabajo Final</span>
                            <span class="nota-valor {{ getNotaClass($datos['notas'][2]) }}">{{ $datos['notas'][2] }}</span>
                        </div>
                    </div>
                    <div class="curso-footer">
                        <span class="promedio-final">
                            <i class="bi bi-graph-up"></i> 
                            Promedio final: <strong class="{{ getPromedioClass($datos['promedio']) }}">{{ number_format($datos['promedio'], 1) }}</strong>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    function mostrarBimestre(bimestre) {
        // Ocultar todos los paneles
        for (let i = 1; i <= 4; i++) {
            document.getElementById(`bimestre${i}`).classList.remove('active');
            document.querySelector(`.bimestre-tab:nth-child(${i})`).classList.remove('active');
        }
        // Mostrar el panel seleccionado
        document.getElementById(`bimestre${bimestre}`).classList.add('active');
        document.querySelector(`.bimestre-tab:nth-child(${bimestre})`).classList.add('active');
    }
</script>
@endsection