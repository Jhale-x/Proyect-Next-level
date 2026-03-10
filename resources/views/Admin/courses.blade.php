@extends('layouts.Adminlanding')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap gap-2 mb-4">
            <h3 class="fw-bold me-auto">📚 Cursos</h3>

            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCurso">
                ➕ Registrar Curso
            </button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNivel">Nivel</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGrado">Grado</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSeccion">Sección</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFacultad">Facultad</button>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ================= VISTA CURSOS ================= -->
        <div id="vista-materias">
            <div class="row g-3">
                @foreach ($cursos ?? [] as $curso)
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

<<<<<<< HEAD
            <!-- Excel actions (export / import) -->
            <div id="excel-actions" class="mb-3 text-end">
                <form id="export-form" action="" method="GET" class="d-inline">
                    <button class="btn btn-outline-success btn-sm">
                        📥 Descargar Excel
                    </button>
                </form>
                <form id="import-form" action="" method="POST" enctype="multipart/form-data"
                    class="d-inline-block ms-2">
                    @csrf
                    <input type="file" name="excel" accept=".xlsx,.xls" required
                        class="form-control form-control-sm d-inline-block w-auto">
                    <button class="btn btn-outline-primary btn-sm">📤 Subir Excel</button>
                </form>
            </div>

=======
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
<<<<<<< HEAD
                                <tr id="cabecera-actividades"></tr>
                            </thead>

                            <tbody id="tabla-alumnos"></tbody>
=======
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
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494

                        </table>
                    </div>

                </div>
            </div>

            <div class="mt-3 text-end">
                <button class="btn btn-secondary" onclick="cerrarRegistroExcel()">Cerrar</button>
                <button class="btn btn-success">Guardar</button>
            </div>

        </div>
    </div>

    <!-- MODAL REGISTRO NIVELES -->
    <div class="modal fade" id="modalNivel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.niveles.storeMultiple') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Niveles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-niveles">
                            <div class="input-group mb-2">
<<<<<<< HEAD
                                <input type="text" name="niveles[]" class="form-control"
                                    placeholder="Nombre del nivel" required>
=======
                                <input type="text" name="niveles[]" class="form-control" placeholder="Nombre del nivel"
                                    required>
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
                                <button type="button" class="btn btn-danger eliminar">X</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarNivel">
                            ➕ Agregar otro
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- MODAL REGISTRO SECCIONES -->
    <div class="modal fade" id="modalSeccion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.secciones.storeMultiple') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Secciones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-secciones">
                            <div class="input-group mb-2">
                                <input type="text" name="secciones[]" class="form-control"
                                    placeholder="Nombre de la sección" required>
                                <button type="button" class="btn btn-danger eliminar-seccion">X</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarSeccion">
                            ➕ Agregar otra
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- MODAL REGISTRO GRADOS -->
    <div class="modal fade" id="modalGrado" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.grados.storeMultiple') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Grados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-grados"></div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarGrado">
                            ➕ Agregar otro
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script type="text/template" id="template-grado">
    <div class="bloque-grado border p-3 mb-3 rounded bg-light">

        <label class="form-label">Nivel</label>
        <select class="form-control mb-2 select-nivel" name="grados[][id_nivel]">
<<<<<<< HEAD
            @foreach ($niveles ?? [] as $nivel)
=======
            @foreach ($niveles as $nivel)
                <option value="{{ $nivel->id_nivel }}">
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
                    {{ $nivel->nivel }}
                </option>
            @endforeach
        </select>

        <label class="form-label">Nombre del Grado</label>
        <input type="text" class="form-control mb-2 input-grado"
               name="grados[][grado]" placeholder="Ej: Primero, Segundo, etc" required>

        <button type="button" class="btn btn-danger btn-eliminar w-100">
            Eliminar
        </button>

    </div>
</script>
    <!-- MODAL REGISTRO FACULTADES -->
    <div class="modal fade" id="modalFacultad" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.facultades.storeMultiple') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Facultades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-facultades"></div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarFacultad">
                            ➕ Agregar otra
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script type="text/template" id="template-facultad">
    <div class="bloque-facultad border p-3 mb-3 rounded bg-light">

        <label class="form-label">Nombre de la Facultad</label>
        <input type="text" class="form-control mb-2 input-facultad"
               name="facultades[]" placeholder="Ej: Ingeniería, Medicina" required>

        <button type="button" class="btn btn-danger btn-eliminar-facultad w-100">
            Eliminar
        </button>

    </div>
</script>
    <!-- ================= MODAL REGISTRO ACTIVIDAD ================= -->
    <div class="modal fade" id="modalActividad">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.activities.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Actividad</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- curso seleccionado -->
                        <input type="hidden" name="id_curso" id="actividad_curso_id">

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="actividad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control"></textarea>
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

                <form action="{{ route('admin.activities.asignar') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5>Asignar Actividad</h5>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="id_curso" id="asignar_curso_id">

                        <label>Actividad existente</label>
                        <select name="id_actividad" class="form-select">
<<<<<<< HEAD
                            @foreach ($actividades ?? [] as $actividad)
=======
                            @foreach ($actividades as $actividad)
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
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
<<<<<<< HEAD
                            @foreach ($salonesPrimaria ?? [] as $salon)
=======
                            @foreach ($salonesPrimaria as $salon)
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
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
<<<<<<< HEAD
                            @foreach ($salonesSecundaria ?? [] as $salon)
=======
                            @foreach ($salonesSecundaria as $salon)
>>>>>>> ae68699347ba81eca1878900ca9c7ac02b103494
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
    <div class="modal fade" id="modalCurso" tabindex="-1" aria-labelledby="modalCursoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCursoLabel">Registrar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Materia</label>
                        <input type="text" name="materia" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
