@extends('layouts.Docentelanding')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap gap-2 mb-4">
            <h3 class="fw-bold me-auto">📚 Cursos</h3>

            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCurso">
                ➕ Registrar Curso
            </button>


        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- ================= VISTA CURSOS ================= -->
        <div id="vista-materias">
            <div class="row g-3">
                @foreach ($cursos as $curso)
                    <div class="col-md-4 col-lg-3">
                        <div class="course-card" onclick="abrirMateria('{{ $curso->materia }}', {{ $curso->id_curso }})">
                            <div class="course-bar"></div>
                            <div class="p-3">
                                <h6 class="fw-bold">{{ $curso->materia }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- ================= VISTA DOCENTES ================= -->
        <div id="vista-docentes" class="d-none animate__animated animate__fadeIn">

            <a href="javascript:void(0)" class="btn-back" onclick="volverMaterias()">← Volver</a>

            <div id="banner-materia" class="course-header-banner shadow-sm">
                <h1 id="titulo-materia" class="display-5 fw-bold mb-0"></h1>
            </div>

            <!-- 🔥 BOTÓN SOLO CUANDO ESTÁS DENTRO DEL CURSO -->
            <div class="d-flex gap-2 mb-3">

                <!-- NUEVA -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalActividad">
                    ➕ Registrar Actividad
                </button>

                <!-- EXISTENTE -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignarActividad">
                    📌 Asignar Actividad
                </button>

            </div>


            <div class="row g-4 mt-4" id="lista-docentes-materia"></div>

        </div>


        <!-- ================= VISTA SALONES DOCENTE ================= -->
        <div id="vista-salones-docente" class="d-none">
            <a class="btn-back" onclick="volverDocentes()">← Volver</a>

            <div id="banner-docente" class="course-header-banner">
                <h1 id="titulo-docente"></h1>
            </div>

            <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalAsignarSalones">
                ➕ Asignar Salón
            </button>

            <div class="row g-4" id="lista-salones-docente"></div>
        </div>
        <!-- ================= VISTA DETALLE SALON ================= -->
        <div id="vista-detalle" class="d-none">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr id="cabecera-actividades">
                                    <th class="fw-bold">Alumno</th>
                                    <!-- actividades dinámicas -->
                                    <th class="text-center fw-bold">PROM</th>
                                </tr>
                            </thead>

                            <tbody id="tabla-alumnos">
                                <tr>
                                    <td colspan="99" class="text-center text-muted py-4">
                                        Selecciona un salón
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            <div class="mt-3 text-end">
                <button class="btn btn-secondary" onclick="cerrarRegistroExcel()">Cerrar</button>
                <button class="btn btn-success">Guardar</button>
            </div>

        </div>


        <!-- ===== ALUMNO ===== -->
        <!--
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">

                                            <h4 class="fw-bold mb-3">Mi Reporte de Calificaciones</h4>

                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="p-3 border rounded text-center">
                                                        <h6>Promedio General</h6>
                                                        <h1 class="display-4 text-primary">A</h1>
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <h6>Actividades</h6>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Tarea: 16</li>
                                                        <li class="list-group-item">Exposición: 18</li>
                                                        <li class="list-group-item">Examen: 15</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>-->

    </div>


    </div>
    <!-- ================= MODAL REGISTRO ACTIVIDAD ================= -->
    <div class="modal fade" id="modalActividad">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('docente.activities.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Actividad</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- curso seleccionado -->
                        <input type="hidden" name="id_curso" id="actividad_curso_id">

                        <div class="mb-3">
                            <label for="actividad_nombre_doc">Nombre</label>
                            <input id="actividad_nombre_doc" type="text" name="actividad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="actividad_desc_doc">Descripción</label>
                            <textarea id="actividad_desc_doc" name="descripcion" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="actividad_pct_doc">Porcentaje</label>
                            <input id="actividad_pct_doc" type="number" name="porcentaje" class="form-control"
                                min="1" max="100" required>
                        </div>

                        <div class="mb-3">
                            <label for="actividad_fecha_doc">Fecha de entrega</label>
                            <input id="actividad_fecha_doc" type="date" name="fecha_entrega" class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Guardar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- ================= MODAL ASIGNAR ACTIVIDAD ================= -->
    <div class="modal fade" id="modalAsignarActividad">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('docente.activities.asignar') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5>Asignar Actividad</h5>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="id_curso" id="asignar_curso_id">

                        <label for="actividad_existente_doc">Actividad existente</label>
                        <select id="actividad_existente_doc" name="id_actividad" class="form-select">
                            @foreach ($actividades as $actividad)
                                <option value="{{ $actividad->id_actividad }}">
                                    {{ $actividad->actividad }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Asignar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- ================= MODAL ASIGNAR SALONES ================= -->
    <div class="modal fade" id="modalAsignarSalones">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Asignar Salones al Docente</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.courses.asignarSalones') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="docente_id" id="docente_id">

                        <h6>Primaria</h6>
                        <div class="row g-2 mb-3">
                            @foreach ($salonesPrimaria as $salon)
                                <div class="col-md-3">
                                    <label class="card p-2 salon-card">
                                        <input type="checkbox" name="salones[]" value="{{ $salon->id_salon }}">
                                        {{ $salon->grado->grado }} - {{ $salon->seccion->seccion }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <h6>Secundaria</h6>
                        <div class="row g-2">
                            @foreach ($salonesSecundaria as $salon)
                                <div class="col-md-3">
                                    <label class="card p-2 salon-card">
                                        <input type="checkbox" name="salones[]" value="{{ $salon->id_salon }}">
                                        {{ $salon->grado->grado }} - {{ $salon->seccion->seccion }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Guardar asignación</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
