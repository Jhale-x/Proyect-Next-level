@extends('layouts.app')

@section('title', 'Gestión de Listados')

@section('content')

<style>
    /* Paleta de colores Institucional */
    :root {
        --azul-oscuro: #002366;
        --rojo-primario: #C8102E;
        --blanco-puro: #FFFFFF;
    }

    .table-container {
        height: 400px;
        overflow-y: auto;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background-color: var(--blanco-puro);
    }

    .table thead th {
        position: sticky;
        top: 0;
        background-color: #f1f1f1;
        color: var(--azul-oscuro);
        z-index: 10;
        border-bottom: 3px solid var(--rojo-primario);
    }

    /* Botones Principales */
    .btn-nav {
        border: 2px solid var(--azul-oscuro);
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-alumnos { background-color: var(--azul-oscuro); color: white; }
    .btn-docentes { background-color: var(--blanco-puro); color: var(--azul-oscuro); }
    .btn-auxiliares { background-color: var(--rojo-primario); color: white; }

    .btn-nav:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        opacity: 0.9;
    }

    /* Cards y Filtros */
    .card-header-institucional {
        background-color: var(--azul-oscuro);
        color: var(--blanco-puro);
        border-bottom: 4px solid var(--rojo-primario);
    }

    .filter-card {
        background: #fcfcfc;
        border-left: 5px solid var(--azul-oscuro);
    }

    .border-rojo { border-color: var(--rojo-primario) !important; }
</style>

<div class="container-fluid py-4">

    <div class="mb-4 border-bottom pb-2">
        <h2 class="fw-bold" style="color: var(--azul-oscuro);">Panel de Listados</h2>
        <p class="text-muted">Seleccione una categoría para gestionar los registros.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <button class="btn btn-nav btn-alumnos w-100 py-3 mb-2" onclick="toggleSeccion('alumnos')">
                <i class="bi bi-people-fill me-2"></i> Alumnos
            </button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-nav btn-docentes w-100 py-3 mb-2" onclick="toggleSeccion('docentes')">
                <i class="bi bi-person-badge-fill me-2"></i> Docentes
            </button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-nav btn-auxiliares w-100 py-3 mb-2" onclick="toggleSeccion('auxiliares')">
                <i class="bi bi-person-check-fill me-2"></i> Auxiliares
            </button>
        </div>
    </div>

    <div id="seccion-alumnos" style="display:none;">
        <div class="card shadow-sm mb-4">
            <div class="card-header card-header-institucional fw-bold">
                <i class="bi bi-mortarboard-fill me-2"></i> LISTADO DE ALUMNOS
            </div>
            <div class="card-body filter-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">1. Nivel</label>
                        <select id="filtro-nivel" class="form-select border-rojo" onchange="cambiarNivelAlumno()">
                            <option value="">Seleccione...</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="academia">Academia</option>
                        </select>
                    </div>
                    <div id="div-grado" class="col-md-3 d-none">
                        <label class="form-label fw-bold">2. Grado</label>
                        <select id="filtro-grado" class="form-select" onchange="mostrarSeccionAlumno()"></select>
                    </div>
                    <div id="div-seccion" class="col-md-3 d-none">
                        <label class="form-label fw-bold">3. Sección</label>
                        <select id="filtro-seccion" class="form-select" onchange="cargarDatos('alumnos')">
                            <option value="">Seleccione...</option>
                            <option value="A">Sección A</option><option value="B">Sección B</option>
                        </select>
                    </div>
                    <div id="div-facultad" class="col-md-4 d-none">
                        <label class="form-label fw-bold text-danger">2. Facultad</label>
                        <select id="filtro-facultad" class="form-select border-danger" onchange="cargarDatos('alumnos')">
                            <option value="">Seleccione Facultad...</option>
                            <option value="medicina">Medicina</option>
                            <option value="ingenieria">Ingeniería</option>
                            <option value="sociales">Sociales</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-container shadow-sm">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>#</th><th>Apellidos y Nombres</th><th id="th-dinamico-al">Detalle</th><th>Estado</th></tr>
                </thead>
                <tbody id="tbody-alumnos">
                    <tr><td colspan="4" class="text-center py-5 text-muted">Complete los filtros para visualizar la lista.</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="seccion-docentes" style="display:none;">
        <div class="card shadow-sm mb-4">
            <div class="card-header card-header-institucional fw-bold">
                <i class="bi bi-person-workspace me-2"></i> LISTADO DE DOCENTES
            </div>
            <div class="card-body filter-card">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Filtrar por Especialidad</label>
                        <select id="filtro-materia" class="form-select border-rojo" onchange="cargarDatos('docentes')">
                            <option value="">Seleccione Materia...</option>
                            <option value="matematica">Matemática</option>
                            <option value="comunicacion">Comunicación</option>
                            <option value="ciencias">Ciencias</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-container shadow-sm">
            <table class="table table-hover mb-0 text-center">
                <thead>
                    <tr><th>DNI</th><th>Nombres Completos</th><th>Materia</th><th>Acción</th></tr>
                </thead>
                <tbody id="tbody-docentes">
                    <tr><td colspan="4" class="text-center py-5 text-muted">Seleccione una especialidad.</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="seccion-auxiliares" style="display:none;">
        <div class="card shadow-sm mb-4">
            <div class="card-header card-header-institucional fw-bold">
                <i class="bi bi-shield-check me-2"></i> LISTADO DE AUXILIARES
            </div>
            <div class="card-body filter-card">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nivel a Cargo</label>
                        <select id="filtro-aux" class="form-select border-rojo" onchange="cargarDatos('auxiliares')">
                            <option value="">Seleccione...</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="academia">Academia</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-container shadow-sm">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>ID</th><th>Nombre</th><th>Nivel Asignado</th><th>Turno</th></tr>
                </thead>
                <tbody id="tbody-auxiliares">
                    <tr><td colspan="4" class="text-center py-5 text-muted">Seleccione un nivel asignado.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleSeccion(tipo) {
        document.getElementById('seccion-alumnos').style.display = tipo === 'alumnos' ? 'block' : 'none';
        document.getElementById('seccion-docentes').style.display = tipo === 'docentes' ? 'block' : 'none';
        document.getElementById('seccion-auxiliares').style.display = tipo === 'auxiliares' ? 'block' : 'none';
    }

    function cambiarNivelAlumno() {
        const nivel = document.getElementById('filtro-nivel').value;
        const divGrado = document.getElementById('div-grado');
        const divSeccion = document.getElementById('div-seccion');
        const divFacultad = document.getElementById('div-facultad');
        const selectGrado = document.getElementById('filtro-grado');
        
        divGrado.classList.add('d-none');
        divSeccion.classList.add('d-none');
        divFacultad.classList.add('d-none');

        if (nivel === 'primaria' || nivel === 'secundaria') {
            divGrado.classList.remove('d-none');
            selectGrado.innerHTML = '<option value="">Seleccione Grado...</option>';
            let max = nivel === 'primaria' ? 6 : 5;
            for(let i=1; i<=max; i++) selectGrado.innerHTML += `<option value="${i}">${i}° ${nivel}</option>`;
        } else if (nivel === 'academia') {
            divFacultad.classList.remove('d-none');
        }
    }

    function mostrarSeccionAlumno() { document.getElementById('div-seccion').classList.remove('d-none'); }

    function cargarDatos(tipo) {
        let tbody, html = '';
        if (tipo === 'alumnos') {
            tbody = document.getElementById('tbody-alumnos');
            const nivel = document.getElementById('filtro-nivel').value;
            document.getElementById('th-dinamico-al').innerText = (nivel === 'academia') ? "Facultad" : "Grado/Sección";
            html = `<tr><td>1</td><td>LUJAN ESPINOZA, Carlos</td><td>Asignado</td><td><span class="badge bg-primary">Activo</span></td></tr>`;
        } 
        else if (tipo === 'docentes') {
            tbody = document.getElementById('tbody-docentes');
            html = `<tr><td>77884455</td><td>Prof. García Moreno</td><td>Matemáticas</td><td><button class="btn btn-sm btn-outline-dark">Ver</button></td></tr>`;
        }
        else if (tipo === 'auxiliares') {
            tbody = document.getElementById('tbody-auxiliares');
            html = `<tr><td>AUX-102</td><td>Zavala Rios, Marta</td><td>Secundaria</td><td>Mañana</td></tr>`;
        }

        // Rellenar con datos de prueba para ver el scroll
        for(let i=2; i<=20; i++) html += html; 
        tbody.innerHTML = html;
    }
</script>

@endsection