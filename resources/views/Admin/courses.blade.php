@extends('layouts.Adminlanding')

@section('content')
    <div class="container py-4">

        {{-- HEADER --}}
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

        {{-- ALERTAS --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- ================= VISTA CURSOS ================= --}}
        <div id="vista-materias">

            {{-- 🔥 RESUMEN --}}
            <div class="card mb-4 p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <small class="text-muted">Total Cursos</small>
                        <h4 class="mb-0">{{ count($cursos ?? []) }}</h4>
                    </div>
                    <div>
                        <small class="text-muted">Activos</small>
                        <h6>{{ $activos ?? 0 }}</h6>
                    </div>
                    <div>
                        <small class="text-muted">Inactivos</small>
                        <h6>{{ $inactivos ?? 0 }}</h6>
                    </div>
                </div>
            </div>

            {{-- 🔥 FILTROS --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="filtroCursoTexto" class="form-control" placeholder="Buscar curso...">
                </div>

                <div class="col-md-4">
                    <input type="text" id="filtroGrado" class="form-control" placeholder="Filtrar por grado...">
                </div>

                <div class="col-md-4">
                    <select id="filtroNivel" class="form-select">
                        <option value="all">Todos los niveles</option>
                        @foreach ($niveles ?? [] as $nivel)
                            <option value="{{ strtolower($nivel->nivel) }}">{{ $nivel->nivel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔥 CARDS --}}
            <div class="row g-3" id="grid-cursos">
                @foreach ($cursos ?? [] as $curso)
                    <div class="col-md-4 col-lg-3 curso-item" data-course="{{ strtolower($curso->materia) }}">

                        <div class="course-card" onclick="abrirMateria('{{ $curso->materia }}', {{ $curso->id_curso }})">

                            <div class="course-bar"></div>

                            <div class="p-3">
                                <h6 class="fw-bold mb-1">{{ $curso->materia }}</h6>

                                <small class="text-muted d-block">
                                    👨‍🏫
                                    @if (isset($curso->docentes) && count($curso->docentes) > 0)
                                        {{ collect($curso->docentes)->take(2)->pluck('name')->join(', ') }}
                                        @if (count($curso->docentes) > 2)
                                            ...
                                        @endif
                                    @else
                                        Sin docentes
                                    @endif
                                </small>

                                <small class="text-muted">
                                    {{ count($curso->docentes ?? []) }} docente(s)
                                </small>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- ================= VISTA DOCENTES ================= --}}
        <div id="vista-docentes" class="d-none animate__animated animate__fadeIn">
            <a href="javascript:void(0)" class="btn-back" onclick="volverMaterias()">← Volver</a>

            <div id="banner-materia" class="course-header-banner shadow-sm">
                <h1 id="titulo-materia" class="display-5 fw-bold mb-0"></h1>
            </div>

            <div class="d-flex gap-2 mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalActividad">
                    ➕ Registrar Actividad
                </button>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignarActividad">
                    📌 Asignar Actividad
                </button>
            </div>

            <div class="row g-4 mt-4" id="lista-docentes-materia"></div>
        </div>

        {{-- ================= RESTO IGUAL (NO TOCADO) ================= --}}
        {{-- 👉 TODO tu código de salones, detalle, excel, modales sigue EXACTAMENTE igual --}}

    </div>

    {{-- 🔥 FILTRO SCRIPT --}}
    <script>
        const txt = document.getElementById('filtroCursoTexto');

        function filtrarCursos() {
            const t = txt.value.toLowerCase();

            document.querySelectorAll('.curso-item').forEach(card => {
                const course = card.dataset.course;
                card.style.display = course.includes(t) ? '' : 'none';
            });
        }

        if (txt) txt.addEventListener('input', filtrarCursos);
    </script>
@endsection
