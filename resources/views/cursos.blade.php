@extends('layouts.app')

@section('title', 'Sistema de Gestión Académica 2026')

@section('content')

@php
    // SIMULACIÓN DE ROLES: 
    // true = Vista Docente (Registro de notas)
    // false = Vista Alumno (Visualización de dashboard)
    $esDocente = true; 
@endphp

<style>
    /* --- ESTILOS GENERALES --- */
    body { background-color: #f4f7f6; }
    .course-card { background: #fff; border-radius: 12px; display: flex; overflow: hidden; transition: 0.3s; border: 1px solid #eee; cursor: pointer; height: 100%; }
    .course-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .course-bar { width: 8px; background: linear-gradient(180deg, #0a2d44 0%, #dc3545 100%); flex-shrink: 0; }
    
    .course-header-banner { position: relative; background-size: cover; background-position: center; color: white; padding: 60px 40px; border-radius: 15px; margin-bottom: 25px; overflow: hidden; }
    .course-header-banner::after { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1; }
    .course-header-banner h1, .course-header-banner p { position: relative; z-index: 2; }

    /* --- REGISTRO AUXILIAR (DOCENTE) --- */
    .calificar-container { background: #fcfcfc; border: 2px dashed #e0e0e0; border-radius: 20px; padding: 60px 20px; margin: 20px 0; }
    .btn-excel-premium {
        background: linear-gradient(135deg, #1d6f42 0%, #28a745 100%);
        color: white; border: none; padding: 18px 45px; border-radius: 50px;
        font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-flex; align-items: center; gap: 15px; box-shadow: 0 10px 20px rgba(40,167,69,0.3); text-decoration: none;
    }
    .btn-excel-premium:hover { transform: translateY(-5px); color: white; box-shadow: 0 15px 30px rgba(40,167,69,0.4); }
    .btn-excel-premium i { font-size: 1.5rem; background: rgba(255, 255, 255, 0.2); padding: 8px; border-radius: 12px; }

    .table-excel { font-size: 0.85rem; border-collapse: separate; border-spacing: 0; width: 100%; border: 1px solid #dee2e6; }
    .table-excel thead th { background: #0a2d44; color: white; text-align: center; padding: 12px; border: 1px solid #163a52; }
    .col-nombre { min-width: 280px; background: #fdfdfd !important; color: #444; font-weight: 500; position: sticky; left: 0; z-index: 5; border-right: 2px solid #eee !important; }
    .input-nota { width: 100%; border: none; text-align: center; font-weight: bold; outline: none; background: transparent; font-size: 1rem; }
    .letra-promedio { font-size: 1.3rem; font-weight: 800; display: block; text-align: center; transition: 0.3s; }

    /* --- DASHBOARD ALUMNO --- */
    .icon-shape { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .bg-blue-light { background-color: #eef7ff; }
    .fw-black { font-weight: 900; }

    /* --- NAVEGACIÓN --- */
    .nav-bimestres .nav-link { flex: 1; text-align: center; background: #f8f9fa; border-radius: 8px; font-weight: bold; color: #666; padding: 12px; border: 1px solid #ddd; margin: 0 5px; }
    .nav-bimestres .nav-link.active { background: #0a2d44; color: white; border-color: #0a2d44; }
    .btn-back { cursor: pointer; color: #0a2d44; font-weight: bold; margin-bottom: 15px; display: inline-block; text-decoration: none; }
</style>

<div class="container-fluid py-4">

    <div id="vista-listado">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Mis Cursos 2026</h2>
            <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalRegistro">
                <i class="bi bi-person-plus-fill me-2"></i>Registrar Usuario
            </button>
        </div>
        
        <div class="row g-3">
            @php
                $cursos = [
                    ['Aritmética', 'Prof. Roberto Jara'], ['Álgebra', 'Prof. Roberto Jara'], ['Geometría', 'Prof. Carlos Villena'], 
                    ['Trigonometría', 'Prof. Carlos Villena'], ['Razonamiento Matemático', 'Prof. Alejandro Mendoza'], ['Física', 'Prof. Ricardo Tello'],
                    ['Química', 'Prof. Luis Gómez'], ['Biología', 'Prof. Ana Martínez'], ['Lenguaje', 'Prof. Sofía Castro'],
                    ['Literatura', 'Prof. Sofía Castro'], ['Razonamiento Verbal', 'Prof. Javier Luna'], ['Inglés', 'Miss Brenda Wright'],
                    ['Historia del Perú', 'Prof. Marco Polo'], ['Historia Universal', 'Prof. Marco Polo'], ['Geografía', 'Prof. Elena Ramos'],
                    ['Economía', 'Prof. Pedro Castillo'], ['Psicología', 'Prof. Sara Méndez'], ['Educación Física', 'Prof. Sandro Rossi']
                ];
            @endphp
            @foreach($cursos as $curso)
            <div class="col-md-4 col-lg-3">
                <div class="course-card shadow-sm" onclick="abrirCurso('{{ $curso[0] }}', '{{ $curso[1] }}')">
                    <div class="course-bar"></div>
                    <div class="p-3">
                        <h6 class="mb-1 fw-bold text-dark">{{ $curso[0] }}</h6>
                        <small class="text-muted">{{ $curso[1] }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="vista-detalle" class="d-none animate__animated animate__fadeIn">
        <a href="javascript:void(0)" class="btn-back mb-3" onclick="volverAListado()">← Volver a la lista de cursos</a>
        
        <div id="banner-dinamico" class="course-header-banner shadow-sm">
            <h1 id="det-titulo" class="display-5 fw-bold mb-0">NOMBRE DEL CURSO</h1>
            <p id="det-profe" class="fs-5 text-white-50">Cargando docente...</p>
        </div>

        @if($esDocente)
            <div id="seccion-calificar-btn" class="text-center py-5">
                <div class="calificar-container shadow-sm">
                    <h4 class="text-muted mb-4 fw-light">Gestión de calificaciones para este curso</h4>
                    <button class="btn-excel-premium fw-bold" onclick="mostrarRegistroExcel()">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        Abrir Registro Auxiliar (EXCEL)
                    </button>
                    <p class="mt-4 text-muted small"><i class="bi bi-info-circle me-1"></i> El sistema promedia automáticamente de 0-20 a escala de letras.</p>
                </div>
            </div>

            <div id="seccion-excel" class="d-none">
                <div class="nav nav-bimestres mb-3">
                    <a class="nav-link active" href="#">I BIM</a>
                    <a class="nav-link" href="#">II BIM</a>
                    <a class="nav-link" href="#">III BIM</a>
                    <a class="nav-link" href="#">IV BIM</a>
                </div>

                <div class="table-responsive shadow-sm border rounded-3 bg-white">
                    <table class="table table-excel mb-0">
                        <thead>
                            <tr>
                                <th class="col-nombre">Apellidos y Nombres</th>
                                <th>Tarea</th><th>Exp.</th><th>P. Sem.</th><th>Cuad.</th><th>Libro</th><th>Ex. Final</th>
                                <th style="background: #dc3545">PROM.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $alumnos = ['ALVARADO RUIZ, Juan', 'BARRANTES PEÑA, Maria', 'CASTILLO LOPEZ, Pedro', 'DIAZ FERRER, Ana', 'ESTRADA VILA, Luis']; @endphp
                            @foreach($alumnos as $alumno)
                            <tr>
                                <td class="col-nombre">{{ $alumno }}</td>
                                @for($i=0; $i<6; $i++)
                                    <td><input type="number" class="input-nota" value="0" min="0" max="20" oninput="calcularLetra(this)"></td>
                                @endfor
                                <td class="text-center bg-light">
                                    <span class="letra-promedio text-danger">C</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2 pb-5">
                    <button class="btn btn-outline-secondary px-4 fw-bold" onclick="cerrarRegistroExcel()">Cerrar Registro</button>
                    <button class="btn btn-success px-5 fw-bold shadow">GUARDAR BIMESTRE</button>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                        <div class="card-header bg-dark p-4 border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-white fw-bold mb-0">Mi Reporte de Calificaciones</h4>
                                <span class="badge bg-primary px-3 py-2 rounded-pill">I BIMESTRE</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center p-5 border-end text-center">
                                    <h6 class="text-muted fw-bold text-uppercase mb-3 small">Promedio General</h6>
                                    <div class="display-1 fw-black text-primary mb-2" style="font-size: 7rem;">A</div>
                                    <div class="px-4 py-1 bg-primary text-white rounded-pill fw-bold small">LOGRO ESPERADO</div>
                                </div>
                                <div class="col-md-8 p-4">
                                    <h6 class="fw-bold mb-4"><i class="bi bi-graph-up-arrow me-2 text-primary"></i>Detalle de Actividades</h6>
                                    <div class="row g-3">
                                        @php
                                            $acts = [
                                                ['Tarea', '16', 'bi-book', 'bg-info'],
                                                ['Exposición', '19', 'bi-mic', 'bg-success'],
                                                ['P. Semanal', '14', 'bi-pencil', 'bg-warning'],
                                                ['Cuaderno', '17', 'bi-journal', 'bg-info'],
                                                ['Libro', '15', 'bi-bookmark', 'bg-info'],
                                                ['Ex. Final', '16', 'bi-file-text', 'bg-primary']
                                            ];
                                        @endphp
                                        @foreach($acts as $a)
                                        <div class="col-md-6 col-xl-4">
                                            <div class="p-3 border rounded-3 bg-white shadow-xs d-flex align-items-center justify-content-between h-100">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape {{ $a[3] }} text-white rounded-3 p-2 me-3 small"><i class="bi {{ $a[2] }}"></i></div>
                                                    <div>
                                                        <p class="small text-muted mb-0" style="font-size: 0.7rem;">{{ $a[0] }}</p>
                                                        <h6 class="fw-bold mb-0">Nota: {{ $a[1] }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4 p-3 bg-blue-light rounded-3 border border-primary border-opacity-25 small">
                                        <i class="bi bi-info-circle-fill me-2 text-primary"></i>Las notas reflejan el avance actual calificado por el docente.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="modalRegistro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Registro de Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <button class="btn btn-primary btn-sm me-2" onclick="toggleForm('alumno')">Ficha Alumno</button>
                    <button class="btn btn-secondary btn-sm" onclick="toggleForm('personal')">Ficha Personal</button>
                </div>

                <div id="form-alumno-container">
                    <form class="row">
                        <div class="col-md-3 mb-3"><label class="form-label">Nombre</label><input type="text" class="form-control"></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Apellido</label><input type="text" class="form-control"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold text-primary">DNI (Usuario)</label><input type="text" id="dni_al" class="form-control border-primary" maxlength="8"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold text-primary">F. Nac (Clave)</label><input type="date" id="fecha_al" class="form-control border-primary"></div>
                        
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Nivel</label>
                            <select id="nivel_al" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="primaria">Primaria</option>
                                <option value="secundaria">Secundaria</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Grado</label>
                            <select id="grado_al" class="form-select">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Sección</label>
                            <select class="form-select">
                                <option>A</option><option>B</option><option>C</option><option>D</option><option>E</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3"><label class="form-label">Usuario Generado</label><input type="text" id="user_al" class="form-control bg-light" readonly></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Clave Generada</label><input type="text" id="pass_al" class="form-control bg-light" readonly></div>
                        
                        <div class="col-12 mt-3"><button type="submit" class="btn btn-primary px-5">Finalizar Registro Alumno</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. CÁLCULO DE NOTAS DOCENTE
    function calcularLetra(input) {
        const fila = input.closest('tr');
        const notas = fila.querySelectorAll('.input-nota');
        const displayLetra = fila.querySelector('.letra-promedio');
        
        let suma = 0;
        notas.forEach(n => suma += parseFloat(n.value || 0));
        let promedio = suma / notas.length;

        let letra = "C"; let color = "#dc3545";
        if (promedio >= 17.5) { letra = "AD"; color = "#198754"; }
        else if (promedio >= 14.5) { letra = "A"; color = "#0d6efd"; }
        else if (promedio >= 10.5) { letra = "B"; color = "#fd7e14"; }

        displayLetra.innerText = letra;
        displayLetra.style.color = color;
    }

    // 2. NAVEGACIÓN DE VISTAS
    function abrirCurso(titulo, profe) {
        document.getElementById('det-titulo').innerText = titulo;
        document.getElementById('det-profe').innerText = profe;
        document.getElementById('vista-listado').classList.add('d-none');
        document.getElementById('vista-detalle').classList.remove('d-none');
        
        const banners = [
            'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2000',
            'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2000'
        ];
        document.getElementById('banner-dinamico').style.backgroundImage = `url('${banners[Math.floor(Math.random() * banners.length)]}')`;
        cerrarRegistroExcel();
    }

    function mostrarRegistroExcel() {
        document.getElementById('seccion-calificar-btn').classList.add('d-none');
        document.getElementById('seccion-excel').classList.remove('d-none');
    }

    function cerrarRegistroExcel() {
        if(document.getElementById('seccion-excel')) {
            document.getElementById('seccion-excel').classList.add('d-none');
            document.getElementById('seccion-calificar-btn').classList.remove('d-none');
        }
    }

    function volverAListado() {
        document.getElementById('vista-detalle').classList.add('d-none');
        document.getElementById('vista-listado').classList.remove('d-none');
    }

    // 3. LÓGICA DE REGISTRO DE USUARIOS
    document.getElementById('dni_al').addEventListener('input', function() {
        document.getElementById('user_al').value = this.value ? "00" + this.value : "";
    });

    document.getElementById('fecha_al').addEventListener('change', function() {
        if (this.value) {
            const [y, m, d] = this.value.split('-');
            document.getElementById('pass_al').value = d + m + y;
        }
    });

    document.getElementById('nivel_al').addEventListener('change', function() {
        const grado = document.getElementById('grado_al');
        grado.innerHTML = '<option value="">Seleccione</option>';
        let limite = this.value === 'primaria' ? 6 : 5;
        for (let i = 1; i <= limite; i++) {
            grado.innerHTML += `<option>${i}° ${this.value}</option>`;
        }
    });
</script>

@endsection