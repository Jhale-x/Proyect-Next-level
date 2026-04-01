@extends('layouts.Adminlanding')

@section('title', 'Registro de Usuarios')

@push('styles')
    <style>
        .form-control,
        .form-select {
            border-radius: 8px;
        }

        .fade-form {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-tabs .nav-link.active {
            font-weight: 700;
            color: #0d6efd;
        }

        .section-title {
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #6c757d;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">

        <h2 class="fw-bold mb-1">Registro de Usuarios</h2>
        <p class="text-muted mb-4 small">Registra alumnos o personal del sistema.</p>

        {{-- TABS --}}
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active" id="tab-alumno">👨‍🎓 Alumno</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-personal">🧑‍💼 Personal</button>
            </li>
        </ul>

        {{-- ================== ALUMNO ================== --}}
        <div id="form-alumno" class="fade-form">

            <div class="mb-4">
                <div class="d-flex justify-content-between small text-muted">
                    <span>Progreso</span>
                    <span id="pct-alumno">0%</span>
                </div>
                <div class="progress" style="height:6px">
                    <div id="bar-alumno" class="progress-bar"></div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.alumnos.store') }}" id="frmAlumno">
                @csrf

                <div class="card p-3 mb-3">
                    <p class="section-title">Datos</p>
                    <div class="row g-3">
                        <div class="col-md-3"><input id="nombre_al" name="nombre" class="form-control" placeholder="Nombre"
                                required></div>
                        <div class="col-md-3"><input id="apellido_al" name="apellido" class="form-control"
                                placeholder="Apellido" required></div>
                        <div class="col-md-3"><input id="dni_al" name="dni" maxlength="8" class="form-control"
                                placeholder="DNI" required></div>
                        <div class="col-md-3"><input type="date" id="fecha_al" name="fecha_nacimiento"
                                class="form-control" required></div>
                    </div>
                </div>

                <div class="card p-3 mb-3">
                    <p class="section-title">Ubicación</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select id="nivel" name="id_nivel" class="form-select">
                                <option value="">Nivel</option>
                                @foreach ($niveles as $n)
                                    <option value="{{ $n->id_nivel }}">{{ $n->nivel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-none" id="box-grado">
                            <select id="grado" name="id_grado" class="form-select"></select>
                        </div>

                        <div class="col-md-4 d-none" id="box-seccion">
                            <select id="seccion" name="id_seccion" class="form-select">
                                @foreach ($secciones as $s)
                                    <option value="{{ $s->id_seccion }}">{{ $s->seccion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-none" id="box-facultad">
                            <select id="facultad" name="id_facultad" class="form-select">
                                @foreach ($facultades as $f)
                                    <option value="{{ $f->id_facultad }}">{{ $f->facultad }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mb-3">
                    <p class="section-title">Cuenta</p>
                    <div class="row g-3">
                        <div class="col-md-6"><input id="user_al" name="usuario" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-6"><input id="pass_al" name="contraseña" class="form-control bg-light"
                                readonly></div>
                    </div>
                </div>

                <div class="card p-3 mb-3">
                    <label><input type="checkbox" id="chkApoderado"> Registrar apoderado</label>

                    <div id="bloque-apoderado" class="d-none mt-3">
                        <div class="row g-3">
                            <div class="col-md-4"><input name="apoderado_nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="col-md-4"><input name="apoderado_apellido" class="form-control"
                                    placeholder="Apellido"></div>
                            <div class="col-md-4"><input name="apoderado_dni" maxlength="8" class="form-control"
                                    placeholder="DNI"></div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" id="btnAlumno" disabled>Registrar Alumno</button>
            </form>
        </div>

        {{-- ================== PERSONAL ================== --}}
        <div id="form-personal" class="fade-form d-none">

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="card p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-3"><input id="nombre_per" name="nombre" class="form-control"
                                placeholder="Nombre"></div>
                        <div class="col-md-3"><input id="apellido_per" name="apellido" class="form-control"
                                placeholder="Apellido"></div>
                        <div class="col-md-3"><input id="dni_per" name="dni" class="form-control"
                                placeholder="DNI"></div>
                        <div class="col-md-3"><input type="date" id="fecha_per" name="fecha_nacimiento"
                                class="form-control"></div>
                    </div>
                </div>

                <div class="card p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="rol" id="cargo" class="form-select">
                                <option value="administrador">Administrador</option>
                                <option value="docente">Docente</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="id_curso" id="id_curso" class="form-select">
                                <option value="">Materia</option>
                                @foreach ($cursos as $c)
                                    <option value="{{ $c->id_curso }}">{{ $c->materia }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input id="user_per" name="usuario" class="form-control" readonly>
                        </div>

                        <div class="col-md-2">
                            <input id="pass_per" name="contrasena" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <button class="btn btn-secondary">Guardar</button>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // elementos
            const formAlumno = document.getElementById('form-alumno');
            const formPersonal = document.getElementById('form-personal');

            const tabAlumno = document.getElementById('tab-alumno');
            const tabPersonal = document.getElementById('tab-personal');

            // tabs
            tabAlumno.onclick = () => {
                formAlumno.classList.remove('d-none');
                formPersonal.classList.add('d-none');
                tabAlumno.classList.add('active');
                tabPersonal.classList.remove('active');
            };

            tabPersonal.onclick = () => {
                formPersonal.classList.remove('d-none');
                formAlumno.classList.add('d-none');
                tabPersonal.classList.add('active');
                tabAlumno.classList.remove('active');
            };

            // usuario automático
            function vincular(dniId, fechaId, userId, passId) {
                const dni = document.getElementById(dniId);
                const fecha = document.getElementById(fechaId);
                const user = document.getElementById(userId);
                const pass = document.getElementById(passId);

                if (!dni || !fecha) return;

                dni.addEventListener('input', () => {
                    user.value = dni.value + '@nextlevel.edu.pe';
                });

                fecha.addEventListener('change', () => {
                    let [y, m, d] = fecha.value.split('-');
                    pass.value = d + m + y;
                });
            }

            vincular('dni_al', 'fecha_al', 'user_al', 'pass_al');
            vincular('dni_per', 'fecha_per', 'user_per', 'pass_per');

            // apoderado
            const chk = document.getElementById('chkApoderado');
            const bloque = document.getElementById('bloque-apoderado');

            if (chk) {
                chk.addEventListener('change', () => {
                    bloque.classList.toggle('d-none', !chk.checked);
                });
            }

            // ubicación (nivel -> grado/sección/facultad)
            const nivel = document.getElementById('nivel');
            const boxGrado = document.getElementById('box-grado');
            const boxSeccion = document.getElementById('box-seccion');
            const boxFacultad = document.getElementById('box-facultad');
            const grado = document.getElementById('grado');

            if (nivel && boxGrado && boxSeccion && boxFacultad && grado) {
                nivel.addEventListener('change', function() {
                    const nivelId = this.value;
                    const nivelNombre = (this.options[this.selectedIndex]?.text || '').toLowerCase();

                    boxGrado.classList.add('d-none');
                    boxSeccion.classList.add('d-none');
                    boxFacultad.classList.add('d-none');

                    grado.innerHTML = '<option value="">Seleccione grado</option>';

                    if (!nivelId) return;

                    if (nivelNombre.includes('primaria') || nivelNombre.includes('secundaria')) {
                        boxGrado.classList.remove('d-none');
                        boxSeccion.classList.remove('d-none');

                        fetch(`{{ url('admin/grados/por-nivel') }}/${nivelId}`)
                            .then(r => {
                                if (!r.ok) throw new Error('No se pudieron cargar los grados.');
                                return r.json();
                            })
                            .then(data => {
                                data.forEach(g => {
                                    grado.innerHTML +=
                                        `<option value="${g.id_grado}">${g.grado}</option>`;
                                });
                            })
                            .catch(() => {
                                grado.innerHTML = '<option value="">Error cargando grados</option>';
                            });
                    } else {
                        boxFacultad.classList.remove('d-none');
                    }
                });
            }

            // progreso
            const form = document.getElementById('frmAlumno');
            const bar = document.getElementById('bar-alumno');
            const pct = document.getElementById('pct-alumno');
            const btn = document.getElementById('btnAlumno');

            function calcularProgresoAlumno() {
                const campos = [
                    document.getElementById('nombre_al'),
                    document.getElementById('apellido_al'),
                    document.getElementById('dni_al'),
                    document.getElementById('fecha_al'),
                    document.getElementById('nivel'),
                ];

                if (!boxGrado.classList.contains('d-none')) {
                    campos.push(document.getElementById('grado'));
                }

                if (!boxSeccion.classList.contains('d-none')) {
                    campos.push(document.getElementById('seccion'));
                }

                if (!boxFacultad.classList.contains('d-none')) {
                    campos.push(document.getElementById('facultad'));
                }

                if (chk.checked) {
                    campos.push(...bloque.querySelectorAll('input'));
                }

                const validos = campos.filter(Boolean);
                const llenos = validos.filter((i) => (i.value || '').trim() !== '').length;
                const porcentaje = validos.length ? Math.round((llenos / validos.length) * 100) : 0;

                bar.style.width = porcentaje + '%';
                pct.innerText = porcentaje + '%';
                btn.disabled = porcentaje < 100;
            }

            form.addEventListener('input', calcularProgresoAlumno);
            form.addEventListener('change', calcularProgresoAlumno);

            // Recalcular cuando cambian campos condicionales
            if (chk) {
                chk.addEventListener('change', calcularProgresoAlumno);
            }

            if (nivel) {
                nivel.addEventListener('change', () => {
                    setTimeout(calcularProgresoAlumno, 0);
                });
            }

            calcularProgresoAlumno();

        });
    </script>

@endsection
