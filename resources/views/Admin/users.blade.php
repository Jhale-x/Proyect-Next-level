@extends('layouts.Adminlanding')

@section('title', 'Registro de Usuarios')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Registro de Usuarios</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-auto">
            <button class="btn btn-primary px-4 shadow-sm" onclick="mostrarForm('alumno')">
                <i class="fas fa-user-graduate me-2"></i>Registro Alumno
            </button>
            <button class="btn btn-secondary px-4 shadow-sm" onclick="mostrarForm('personal')">
                <i class="fas fa-user-tie me-2"></i>Registro Personal
            </button>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="form-alumno" class="card shadow-sm border-0 d-none mb-4">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary fw-bold border-bottom pb-2">Datos Académicos del Alumno</h5>
            <form method="POST" action="{{ route('admin.alumnos.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nombre</label>
                        <input name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Apellido</label>
                        <input name="apellido" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">DNI (Usuario)</label>
                        <input name="dni" id="dni_al" class="form-control" maxlength="8" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Fecha Nacimiento (Pass)</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_al" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nivel</label>
                        <select id="nivel" name="id_nivel" class="form-select" required>
                            <option value="">-- Seleccione Nivel --</option>
                            @foreach ($niveles as $n)
                                <option value="{{ $n->id_nivel }}">{{ $n->nivel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 d-none" id="box-grado">
                        <label class="form-label">Grado</label>
                        <select id="grado" name="id_grado" class="form-select">
                            <option value="">-- Seleccione Grado --</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 d-none" id="box-seccion">
                        <label class="form-label">Sección</label>
                        <select id="seccion" name="id_seccion" class="form-select">
                            @foreach ($secciones as $s)
                                <option value="{{ $s->id_seccion }}">{{ $s->seccion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 d-none" id="box-facultad">
                        <label class="form-label">Facultad</label>
                        <select id="facultad" name="id_facultad" class="form-select">
                            @foreach ($facultades as $f)
                                <option value="{{ $f->id_facultad }}">{{ $f->facultad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row bg-light p-3 rounded mb-3">
                    <div class="col-md-6">
                        <label class="small fw-bold">Credencial Generada:</label>
                        <input name="usuario" id="user_al" class="form-control bg-white" readonly placeholder="Usuario automático">
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold">Password Inicial:</label>
                        <input name="contraseña" id="pass_al" class="form-control bg-white" readonly placeholder="Password automático">
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="chkApoderado">
                    <label class="form-check-label fw-bold" for="chkApoderado">¿Registrar datos de Apoderado?</label>
                </div>

                <div id="bloque-apoderado" class="d-none border-start border-4 border-primary ps-3 mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3"><label>Nombre Apoderado</label><input name="apoderado_nombre" class="form-control"></div>
                        <div class="col-md-4 mb-3"><label>Apellido Apoderado</label><input name="apoderado_apellido" class="form-control"></div>
                        <div class="col-md-4 mb-3"><label>DNI Apoderado</label><input name="apoderado_dni" class="form-control" maxlength="8"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg shadow">Finalizar Registro Alumno</button>
            </form>
        </div>
    </div>

    <div id="form-personal" class="card shadow-sm border-0 d-none mb-4">
        <div class="card-body p-4">
            <h5 class="mb-4 text-secondary fw-bold border-bottom pb-2">Datos del Personal Institucional</h5>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3"><label>Nombre</label><input name="nombre" class="form-control" required></div>
                    <div class="col-md-3 mb-3"><label>Apellido</label><input name="apellido" class="form-control" required></div>
                    <div class="col-md-3 mb-3"><label>DNI</label><input name="dni" id="dni_per" class="form-control" maxlength="8" required></div>
                    <div class="col-md-3 mb-3"><label>Fecha Nacimiento</label><input type="date" name="fecha_nacimiento" id="fecha_per" class="form-control" required></div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Rol / Cargo</label>
                        <select name="rol" id="cargo" class="form-select" required>
                            <option value="administrador">Administrador</option>
                            <option value="docente">Docente</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Materia Asignada (Si es Docente)</label>
                        <select name="id_curso" id="id_curso" class="form-select">
                            <option value="">-- Sin materia específica --</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id_curso }}">{{ $curso->materia }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row bg-light p-3 rounded mb-3">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">Usuario:</label>
                        <input name="usuario" id="user_per" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted">Contraseña:</label>
                        <input name="contrasena" id="pass_per" class="form-control" readonly>
                    </div>
                </div>

                <button class="btn btn-secondary btn-lg shadow" type="submit">Guardar Personal</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // 1. Alternar formularios
    window.mostrarForm = function(tipo) {
        document.getElementById('form-alumno').classList.toggle('d-none', tipo !== 'alumno');
        document.getElementById('form-personal').classList.toggle('d-none', tipo !== 'personal');
    };

    // 2. Generador de credenciales (DNI y Fecha)
    function configurarCredenciales(dniId, fechaId, userId, passId) {
        const inputDni = document.getElementById(dniId);
        const inputFecha = document.getElementById(fechaId);
        const inputUser = document.getElementById(userId);
        const inputPass = document.getElementById(passId);

        if (inputDni) {
            inputDni.addEventListener('input', () => {
                inputUser.value = inputDni.value ? inputDni.value + '@NextLevelAcademy.pe' : '';
            });
        }

        if (inputFecha) {
            inputFecha.addEventListener('change', () => {
                if (inputFecha.value) {
                    const [y, m, d] = inputFecha.value.split('-');
                    inputPass.value = `${d}${m}${y}`;
                }
            });
        }
    }

    configurarCredenciales('dni_al', 'fecha_al', 'user_al', 'pass_al');
    configurarCredenciales('dni_per', 'fecha_per', 'user_per', 'pass_per');

    // 3. Lógica dinámica de Nivel/Grado/Facultad
    const nivel = document.getElementById('nivel');
    nivel?.addEventListener('change', function() {
        const val = this.value;
        const boxes = {
            grado: document.getElementById('box-grado'),
            seccion: document.getElementById('box-seccion'),
            facultad: document.getElementById('box-facultad')
        };
        const selectGrado = document.getElementById('grado');

        // Reset
        Object.values(boxes).forEach(b => b.classList.add('d-none'));
        selectGrado.innerHTML = '<option value="">-- Seleccione Grado --</option>';

        if (val == 1 || val == 2) { // Inicial/Primaria/Secundaria
            boxes.grado.classList.remove('d-none');
            boxes.seccion.classList.remove('d-none');
            
            fetch(`/admin/alumnos/grados/por-nivel/${val}`)
                .then(r => r.json())
                .then(data => {
                    data.forEach(g => {
                        selectGrado.innerHTML += `<option value="${g.id_grado}">${g.grado}</option>`;
                    });
                });
        } else if (val == 3) { // Academia
            boxes.facultad.classList.remove('d-none');
        }
    });

    // 4. Checkbox Apoderado
    document.getElementById('chkApoderado')?.addEventListener('change', function() {
        document.getElementById('bloque-apoderado').classList.toggle('d-none', !this.checked);
    });

    // 5. Validación de materia obligatoria para docentes
    const cargo = document.getElementById('cargo');
    const curso = document.getElementById('id_curso');
    cargo?.addEventListener('change', () => {
        curso.required = (cargo.value === 'docente');
    });
});
</script>
@endsection