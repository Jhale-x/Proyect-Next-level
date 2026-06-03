@extends('layouts.Docentelanding')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap gap-2 mb-4">
            <h3 class="fw-bold me-auto">📚 Mis Cursos</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="views-container">

            <!-- ================= CURSOS ================= -->
            <div id="vista-materias" class="view active">
                <div class="row g-3">

                    @forelse ($cursos as $curso)
                        <div class="col-md-4 col-lg-3">
                            <div class="course-card"
                                onclick="abrirCursoDocente('{{ $curso->materia }}', {{ $curso->id_curso }})">

                                <div class="course-bar"></div>

                                <div class="p-3">
                                    <h6 class="fw-bold">
                                        {{ $curso->materia }}
                                    </h6>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            No tienes cursos asignados
                        </div>
                    @endforelse

                </div>
            </div>

            <!-- ================= SALONES ================= -->
            <div id="vista-salones" class="view">

                <a href="javascript:void(0)" class="btn-back" onclick="volverCursos()">
                    ← Volver
                </a>

                <div class="course-header-banner shadow-sm mb-3">
                    <h2 id="titulo-curso" class="fw-bold"></h2>
                </div>

                <div class="row g-3" id="lista-salones"></div>

            </div>

            <!-- ================= VISTA DETALLE SALON ================= -->
            <div id="vista-detalle" class="view">

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
                        <input type="hidden" name="id_curso" id="import_curso_id">
                        <input type="file" name="excel" accept=".xlsx,.xls" required
                            class="form-control form-control-sm d-inline-block w-auto">
                        <button class="btn btn-outline-primary btn-sm">📤 Subir Excel</button>
                    </form>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">
                                    <tr id="cabecera-actividades"></tr>
                                </thead>

                                <tbody id="tabla-alumnos"></tbody>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-secondary" onclick="cerrarRegistroExcel()">Cerrar</button>
                    <button class="btn btn-success" id="btn-guardar-notas">Guardar</button>
                </div>

            </div>

        </div>
    </div>

    <script>
        window.DocenteCursos = {
            cursoActual: null,
            cursoNombre: null,

            abrirCurso(nombre, id) {
                this.cursoActual = id;
                this.cursoNombre = nombre;

                document.getElementById('titulo-curso').innerText = nombre;

                document.getElementById('vista-cursos').classList.add('d-none');
                document.getElementById('vista-detalle').classList.remove('d-none');

                this.cargarActividades(id);
            },

            volver() {
                document.getElementById('vista-detalle').classList.remove('active');
                document.getElementById('vista-salones').classList.remove('active');

                document.getElementById('vista-materias').classList.add('active');
            },

            cargarActividades(idCurso) {
                const cont = document.getElementById('lista-actividades');

                cont.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border"></div>
                <p class="text-muted mt-2">Cargando actividades...</p>
            </div>
        `;

                fetch(`/docente/activities?curso=${idCurso}`)
                    .then(r => r.json())
                    .then(data => {

                        if (!Array.isArray(data) || data.length === 0) {
                            cont.innerHTML = `<div class="alert alert-warning">No hay actividades</div>`;
                            return;
                        }

                        let html = '';

                        data.forEach(a => {
                            html += `
                        <div class="card mb-2 p-3">
                            <strong>${a.actividad}</strong>
                            <div class="text-muted">
                                Entrega: ${a.fecha_entrega ?? '-'}
                            </div>
                        </div>
                    `;
                        });

                        cont.innerHTML = html;
                    })
                    .catch(() => {
                        cont.innerHTML = `<div class="alert alert-danger">Error al cargar actividades</div>`;
                    });
            }
        };

        function volverCursos() {
            DocenteCursos.volver();
        }

        function cerrarRegistroExcel() {

            document.getElementById('vista-detalle').classList.remove('active');

            document.getElementById('vista-salones').classList.add('active');
        }
    </script>
@endsection
