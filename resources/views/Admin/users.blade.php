@extends('layouts.landing')

@section('title', 'Crear Usuario')

@section('content')
    <div class="container-fluid py-4">

        <h2 class="fw-bold mb-4">Registro de Usuarios</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-auto">
                <button class="btn btn-primary" onclick="mostrarAlumno()">Registro Alumno</button>
                <button class="btn btn-secondary" onclick="mostrarPersonal()">Registro Personal</button>
            </div>
        </div>

        <!-- FORM ALUMNO -->
        <div id="form-alumno" class="card shadow-sm border-0 d-none">
            <div class="card-body p-3 p-md-4">
                <h5 class="mb-4 text-primary fw-bold">Datos del Alumno</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <form method="POST" action="{{ route('admin.alumnos.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Nombre</label>
                            <input name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Apellido</label>
                            <input name="apellido" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>DNI</label>
                            <input name="dni" id="dni_al" class="form-control" maxlength="8" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_al" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">

                        <!-- NIVEL -->
                        <div class="col-md-4">
                            <label>Nivel</label>
                            <select id="nivel" name="id_nivel" class="form-select">
                                <option value="">-- Seleccione Nivel --</option>
                                @foreach ($niveles as $n)
                                    <option value="{{ $n->id_nivel }}">{{ $n->nivel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- GRADO -->
                        <div class="col-md-4 d-none" id="box-grado">
                            <label>Grado</label>
                            <select id="grado" name="id_grado" class="form-select">
                                <option value="">-- Seleccione Grado --</option>
                            </select>
                        </div>
                        <!-- SECCION -->
                        <div class="col-md-4 d-none" id="box-seccion">
                            <label>Sección</label>
                            <select id="seccion" name="id_seccion" class="form-select">
                                <option value="">-- Seleccione Sección --</option>
                                @foreach ($secciones as $s)
                                    <option value="{{ $s->id_seccion }}">{{ $s->seccion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- FACULTAD -->
                        <div class="col-md-4 d-none" id="box-facultad">
                            <label>Facultad</label>
                            <select id="facultad" name="id_facultad" class="form-select">
                                <option value="">-- Seleccione Facultad --</option>
                                @foreach ($facultades as $f)
                                    <option value="{{ $f->id_facultad }}">{{ $f->facultad }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3 mb-3">
                                <label>Usuario</label>
                                <input name="usuario" id="user_al" class="form-control" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Contraseña</label>
                                <input name="contraseña" id="pass_al" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="chkApoderado">
                            <label class="form-check-label fw-bold">¿Registrar Apoderado?</label>
                        </div>

                        <div id="bloque-apoderado" class="d-none">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nombre Apoderado</label>
                                    <input name="apoderado_nombre" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Apellido Apoderado</label>
                                    <input name="apoderado_apellido" class="form-control">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>DNI Apoderado</label>
                                    <input name="apoderado_dni" class="form-control" maxlength="8">
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary mt-3">Registrar Alumno</button>
                </form>
            </div>
        </div>


        <!-- FORM PERSONAL -->
        <div id="form-personal" class="card p-3 d-none">
            <h5>Datos del Personal</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label>Nombre</label>
                        <input name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Apellido</label>
                        <input name="apellido" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>DNI</label>
                        <input name="dni" id="dni_per" class="form-control" maxlength="8" required>
                    </div>
                    <div class="col-md-3">
                        <label>Fecha Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_per" class="form-control">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label>Rol</label>
                        <select name="rol" id="cargo" class="form-select">
                            <option value="administrador">Administrador</option>
                            <option value="docente">Docente</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                    </div>

                    <!-- FK real -->
                    <div class="col-md-3">
                        <label>Materia</label>
                        <select name="id_curso" id="id_curso" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id_curso }}">
                                    {{ $curso->materia }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Usuario</label>
                        <input name="usuario" id="user_per" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Contraseña</label>
                        <input name="contrasena" id="pass_per" class="form-control" readonly>
                    </div>
                </div>

                <button class="btn btn-secondary mt-3" type="submit">Guardar Personal</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // 🔹 Mostrar/Ocultar Alumno / Personal
            window.mostrarAlumno = function() {
                document.getElementById('form-alumno').classList.remove('d-none');
                document.getElementById('form-personal')?.classList.add('d-none');
            };
            window.mostrarPersonal = function() {
                document.getElementById('form-personal').classList.remove('d-none');
                document.getElementById('form-alumno')?.classList.add('d-none');
            };

            // 🔹 Usuario / contraseña automático
            function vincular(dniId, fechaId, userId, passId) {
                const d = document.getElementById(dniId);
                const f = document.getElementById(fechaId);
                const u = document.getElementById(userId);
                const p = document.getElementById(passId);

                if (!d || !f || !u || !p) return;

                d.addEventListener('input', () => u.value = d.value + '@NextLevelAcademy.pe');
                f.addEventListener('change', () => {
                    const [y, m, d2] = f.value.split('-');
                    p.value = `${d2}${m}${y}`;
                });
            }

            vincular('dni_al', 'fecha_al', 'user_al', 'pass_al');
            vincular('dni_per', 'fecha_per', 'user_per', 'pass_per');

            // 🔹 Checkbox Apoderado
            const chk = document.getElementById('chkApoderado');
            const bloque = document.getElementById('bloque-apoderado');

            chk.addEventListener('change', () => {
                bloque.classList.toggle('d-none', !chk.checked);
            });

            const nivel = document.getElementById('nivel');
            const boxGrado = document.getElementById('box-grado');
            const boxSeccion = document.getElementById('box-seccion');
            const boxFacultad = document.getElementById('box-facultad');
            const grado = document.getElementById('grado');

            if (nivel && boxGrado && boxSeccion && boxFacultad && grado) {

                nivel.addEventListener('change', function() {

                    boxGrado.classList.add('d-none');
                    boxSeccion.classList.add('d-none');
                    boxFacultad.classList.add('d-none');

                    grado.innerHTML = '<option value="">-- Seleccione Grado --</option>';

                    if (this.value == 2 || this.value == 1) {
                        boxGrado.classList.remove('d-none');
                        boxSeccion.classList.remove('d-none');

                        fetch(`{{ url('admin/grados/por-nivel') }}/` + this.value)
                            .then(r => {
                                if (!r.ok) throw new Error('Network response was not ok');
                                return r.json();
                            })
                            .then(data => {
                                data.forEach(g => {
                                    grado.innerHTML += `
                            <option value="${g.id_grado}">
                                ${g.grado}
                            </option>
                        `;
                                });
                            });
                    }

                    if (this.value == 3) {
                        boxFacultad.classList.remove('d-none');
                    }
                });
            }

            // make course required only for docente/auxiliar roles
            const rolSelect = document.getElementById('cargo');
            const cursoSelect = document.getElementById('id_curso');

            function toggleCursoRequirement() {
                if (!cursoSelect) return;
                const val = rolSelect.value;
                const need = val === 'docente' || val === 'auxiliar';
                cursoSelect.required = need;
                if (!need) {
                    cursoSelect.value = '';
                }
            }
            if (rolSelect) {
                rolSelect.addEventListener('change', toggleCursoRequirement);
                toggleCursoRequirement();
            }
        });
    </script>


@endsection
