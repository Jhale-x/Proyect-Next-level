@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold m-0" style="color: #0a1f44;">Registro de Usuarios</h2>
    </div>

    <div class="row g-2 mb-4">
        <div class="col-12 col-md-auto">
            <button class="btn btn-primary shadow-sm w-100 py-2 px-4" onclick="mostrarAlumno()">
                <i class="bi bi-mortarboard-fill me-2"></i> Registro de Alumno
            </button>
        </div>
        <div class="col-12 col-md-auto">
            <button class="btn btn-secondary shadow-sm w-100 py-2 px-4" onclick="mostrarPersonal()">
                <i class="bi bi-person-badge-fill me-2"></i> Registro Personal Educativo
            </button>
        </div>
    </div>

    <div id="form-alumno" class="card shadow-sm border-0 d-none">
        <div class="card-body p-3 p-md-4">
            <h5 class="mb-4 text-primary fw-bold"><i class="bi bi-info-circle me-2"></i>Datos del Alumno</h5>
            <form>
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ej. Juan">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" placeholder="Ej. Pérez">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label fw-bold">DNI (Usuario)</label>
                        <input type="text" id="dni_al" class="form-control border-primary" maxlength="8">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label fw-bold">F. Nacimiento (Clave)</label>
                        <input type="date" id="fecha_al" class="form-control border-primary">
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label text-primary fw-bold">Nivel Académico</label>
                        <select id="nivel" class="form-select border-primary bg-light">
                            <option value="">Seleccione Nivel</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="academia">Academia</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-2 mb-3 d-none" id="grupo-grado">
                        <label class="form-label">Grado</label>
                        <select id="grado" class="form-select"></select>
                    </div>

                    <div class="col-6 col-md-2 mb-3 d-none" id="grupo-seccion">
                        <label class="form-label">Sección</label>
                        <select id="seccion" class="form-select">
                            <option value="A">A</option><option value="B">B</option>
                            <option value="C">C</option><option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4 mb-3 d-none" id="grupo-facultad">
                        <label class="form-label fw-bold text-danger">Facultad</label>
                        <select id="facultad" class="form-select border-danger">
                            <option value="">Seleccione Facultad</option>
                            <option value="medicina">Medicina</option>
                            <option value="ingenieria">Ingeniería</option>
                            <option value="sociales">Ciencias Sociales</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label small text-muted">Usuario Sugerido</label>
                        <input type="text" id="user_al" class="form-control bg-light fw-bold text-secondary" readonly>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label small text-muted">Contraseña Sugerida</label>
                        <input type="text" id="pass_al" class="form-control bg-light fw-bold text-secondary" readonly>
                    </div>
                </div>

                <hr class="my-4">
                <h6 class="mb-3 text-muted fw-bold">Información del Apoderado</h6>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">DNI Apoderado</label>
                        <input type="text" class="form-control" maxlength="8">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100 w-md-auto px-5 py-2 fw-bold shadow">
                        <i class="bi bi-save me-2"></i>Registrar Alumno
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="form-personal" class="card shadow-sm border-0 d-none mt-4">
        <div class="card-body p-3 p-md-4">
            <h5 class="mb-4 text-secondary fw-bold">Datos del Personal Educativo</h5>
            <form>
                <div class="row">
                    <div class="col-12 col-md-3 mb-3"><label class="form-label">Nombre</label><input type="text" class="form-control"></div>
                    <div class="col-12 col-md-3 mb-3"><label class="form-label">Apellido</label><input type="text" class="form-control"></div>
                    <div class="col-12 col-md-3 mb-3"><label class="form-label fw-bold">DNI (Usuario)</label><input type="text" id="dni_per" class="form-control border-secondary" maxlength="8"></div>
                    <div class="col-12 col-md-3 mb-3"><label class="form-label fw-bold">F. Cumpleaños</label><input type="date" id="fecha_per" class="form-control border-secondary"></div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Cargo / Función</label>
                        <select id="cargo" class="form-select border-secondary">
                            <option value="">Seleccione</option>
                            <option value="administrador">Administrador</option>
                            <option value="docente">Docente</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-none" id="grupo-materia">
                        <label class="form-label fw-bold">Especialidad / Materia</label>
                        <select class="form-select"><option>Matemática</option><option>Comunicación</option><option>Ciencias</option></select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" id="user_per" class="form-control bg-light" readonly>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" id="pass_per" class="form-control bg-light" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary w-100 w-md-auto px-5 py-2 fw-bold shadow mt-3">Guardar Personal</button>
            </form>
        </div>
    </div>
</div>

<script>
// Mantengo tus funciones de JS intactas ya que funcionan correctamente
function vincularCredenciales(dniId, dateId, userId, passId) {
    const d = document.getElementById(dniId);
    const f = document.getElementById(dateId);
    const u = document.getElementById(userId);
    const p = document.getElementById(passId);

    if(d && u) {
        d.addEventListener('input', () => u.value = d.value ? "00" + d.value : "");
    }
    if(f && p) {
        f.addEventListener('change', () => {
            if (f.value) {
                const [y, m, day] = f.value.split('-');
                p.value = `${day}${m}${y}`;
            } else { p.value = ""; }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    vincularCredenciales('dni_al', 'fecha_al', 'user_al', 'pass_al');
    vincularCredenciales('dni_per', 'fecha_per', 'user_per', 'pass_per');
});

function mostrarAlumno() {
    document.getElementById('form-alumno').classList.remove('d-none');
    document.getElementById('form-personal').classList.add('d-none');
    window.scrollTo({ top: document.getElementById('form-alumno').offsetTop - 80, behavior: 'smooth' });
}

function mostrarPersonal() {
    document.getElementById('form-personal').classList.remove('d-none');
    document.getElementById('form-alumno').classList.add('d-none');
    window.scrollTo({ top: document.getElementById('form-personal').offsetTop - 80, behavior: 'smooth' });
}

document.getElementById('nivel').addEventListener('change', function () {
    const gg = document.getElementById('grupo-grado');
    const gs = document.getElementById('grupo-seccion');
    const gf = document.getElementById('grupo-facultad');
    const g = document.getElementById('grado');
    
    g.innerHTML = '<option value="">Seleccione grado</option>';
    gg.classList.add('d-none');
    gs.classList.add('d-none');
    gf.classList.add('d-none');

    if (this.value === 'academia') {
        gf.classList.remove('d-none');
    } 
    else if (this.value === 'primaria' || this.value === 'secundaria') {
        gg.classList.remove('d-none');
        gs.classList.remove('d-none');
        let limite = this.value === 'primaria' ? 6 : 5;
        for (let i = 1; i <= limite; i++) {
            g.innerHTML += `<option value="${i}">${i}° ${this.value.charAt(0).toUpperCase() + this.value.slice(1)}</option>`;
        }
    }
});

document.getElementById('cargo').addEventListener('change', function () {
    const gm = document.getElementById('grupo-materia');
    if(gm) gm.classList.toggle('d-none', this.value !== 'docente');
});
</script>
@endsection