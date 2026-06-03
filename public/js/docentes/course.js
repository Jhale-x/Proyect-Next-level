// ===============================
// 🎯 ESTADO GLOBAL DOCENTE
// ===============================
let cursoActual = null;
let cursoNombreActual = null;

let docenteActual = null;
let salonActual = null;

let actividadesActuales = [];
let notasMap = {};

// ===============================
// 🔁 CAMBIO DE VISTAS
// ===============================
function cambiarVista(idVista) {
    document.querySelectorAll('.view').forEach(v => {
        v.classList.remove('active');
    });

    const vista = document.getElementById(idVista);
    if (vista) vista.classList.add('active');
}

// ===============================
// 📚 ABRIR CURSO
// ===============================
function abrirMateria(nombre, id_curso) {
    cursoActual = id_curso;
    cursoNombreActual = nombre;

    cambiarVista('vista-docentes');

    const titulo = document.getElementById('titulo-materia');
    if (titulo) titulo.innerText = nombre;

    const lista = document.getElementById('lista-docentes-materia');

    if (lista) {
        lista.innerHTML = `
            <div class="col-12 text-center py-4">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Cargando docentes...</p>
            </div>
        `;
    }

    fetch(`/docente/courses/${id_curso}/docentes`)
        .then(r => r.json())
        .then(data => {
            let html = '';

            if (!data || data.length === 0) {
                html = `<div class="col-12 text-muted text-center">No hay docentes asignados</div>`;
            } else {
                data.forEach(d => {
                    html += `
                        <div class="col-md-3">
                            <div class="course-card" onclick="abrirDocente('${d.nombre}', ${d.id})">
                                <div class="p-3 fw-bold">${d.nombre}</div>
                            </div>
                        </div>
                    `;
                });
            }

            lista.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            lista.innerHTML = `<div class="text-danger">Error cargando docentes</div>`;
        });
}

// ===============================
// 🏫 CURSOS DEL DOCENTE
// ===============================
function abrirCursoDocente(nombre, id_curso) {
    cursoActual = id_curso;
    cursoNombreActual = nombre;

    cambiarVista('vista-salones');

    const titulo = document.getElementById('titulo-curso');
    if (titulo) titulo.innerText = nombre;

    const lista = document.getElementById('lista-salones');

    if (lista) {
        lista.innerHTML = `
            <div class="col-12 text-center py-4">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Cargando salones...</p>
            </div>
        `;
    }

    fetch(`/docente/courses/${id_curso}/salones`)
        .then(r => r.json())
        .then(data => {
            let html = '';

            if (!data || data.length === 0) {
                html = `<div class="col-12 text-center text-muted">No hay salones</div>`;
            } else {
                data.forEach(s => {
                    html += `
                        <div class="col-md-3">
                            <div class="course-card" onclick="abrirDetalle(${s.id})">
                                <div class="p-3 fw-bold">
                                    ${s.nivel} ${s.grado} - ${s.seccion}
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            lista.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            lista.innerHTML = `<div class="text-danger">Error cargando salones</div>`;
        });
}

// ===============================
// 👨‍🏫 DOCENTE → SALONES
// ===============================
function abrirDocente(nombre, id_docente) {
    docenteActual = id_docente;

    cambiarVista('vista-salones-docente');

    const titulo = document.getElementById('titulo-docente');
    if (titulo) titulo.innerText = nombre;

    const lista = document.getElementById('lista-salones-docente');

    if (lista) {
        lista.innerHTML = `
            <div class="col-12 text-center py-4">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Cargando salones...</p>
            </div>
        `;
    }

    fetch(`/docente/courses/docente/${id_docente}/salones?id_curso=${cursoActual}`)
        .then(r => r.json())
        .then(data => {
            let html = '';

            if (!data || data.length === 0) {
                html = `<div class="col-12 text-center text-muted">No hay salones asignados</div>`;
            } else {
                data.forEach(s => {
                    html += `
                        <div class="col-md-3">
                            <div class="course-card" onclick="abrirDetalle(${s.id})">
                                <div class="p-3 fw-bold">
                                    ${s.nivel} ${s.grado} - ${s.seccion}
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            lista.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            lista.innerHTML = `<div class="text-danger">Error cargando salones</div>`;
        });
}

// ===============================
// 🏫 DETALLE SALÓN
// ===============================
function abrirDetalle(idSalon) {
    salonActual = idSalon;

    cambiarVista('vista-detalle');

    const tabla = document.getElementById('tabla-alumnos');
    const cabecera = document.getElementById('cabecera-actividades');

    // 🔥 FIX EXPORT / IMPORT ACTION
    const exportForm = document.getElementById('export-form');
    const importForm = document.getElementById('import-form');
    const importCursoInput = document.getElementById('import_curso_id');

    if (exportForm) {
        exportForm.action = `/docente/salones/${idSalon}/export/${cursoActual}`;
    }

    if (importForm) {
        importForm.action = `/docente/salones/${idSalon}/import`;
    }

    if (importCursoInput) {
        importCursoInput.value = cursoActual || '';
    }

    if (tabla) {
        tabla.innerHTML = `
            <tr>
                <td colspan="100%" class="text-center py-4">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2">Cargando notas...</p>
                </td>
            </tr>
        `;
    }

    fetch(`/docente/salones/${idSalon}/detalle?id_curso=${cursoActual}`)
        .then(r => r.json())
        .then(data => {

            actividadesActuales = data.actividades || [];

            notasMap = {};
            (data.notas || []).forEach(n => {
                notasMap[`${n.id_alumno}-${n.id_curso_actividad}`] = n.nota;
            });

            // CABECERA
            let head = `<th>Alumno</th>`;

            actividadesActuales.forEach(act => {
                head += `
                    <th class="text-center">
                        ${act.actividad.actividad}
                        <br>
                        <small class="text-muted">${act.porcentaje ?? 0}%</small>
                    </th>
                `;
            });

            head += `<th class="text-center fw-bold">PROM</th>`;
            if (cabecera) cabecera.innerHTML = head;

            // CUERPO
            let body = '';

            if (!data.alumnos || data.alumnos.length === 0) {
                body = `<tr><td colspan="100%" class="text-center">No hay alumnos</td></tr>`;
            } else {
                data.alumnos.forEach(alumno => {

                    body += `<tr>`;
                    body += `<td>${alumno.nombre} ${alumno.apellido}</td>`;

                    actividadesActuales.forEach(act => {
                        const key = `${alumno.id_alumno}-${act.id_curso_actividad}`;
                        const nota = notasMap[key] ?? '';

                        body += `
                            <td class="text-center">
                                <input type="number"
                                    class="form-control form-control-sm text-center"
                                    value="${nota}">
                            </td>
                        `;
                    });

                    body += `<td class="fw-bold text-center">-</td>`;
                    body += `</tr>`;
                });
            }

            if (tabla) tabla.innerHTML = body;
        })
        .catch(err => console.error(err));
}

// ===============================
// 💾 GUARDAR NOTAS
// ===============================
function guardarNotasDetalle() {
    if (!salonActual) return;

    const notas = [];

    document.querySelectorAll('#tabla-alumnos input').forEach(input => {
        notas.push({
            id_alumno: input.dataset.alumno,
            id_curso_actividad: input.dataset.actividad,
            nota: input.value === '' ? null : Number(input.value)
        });
    });

    fetch(`/docente/salones/${salonActual}/guardar-notas`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notas })
    })
        .then(r => r.json())
        .then(resp => alert(resp.message))
        .catch(err => console.error(err));
}

// ===============================
// 📤 EXPORTAR EXCEL (FIXED)
// ===============================
function exportarNotas() {
    if (!salonActual || !cursoActual) return;

    window.location.href =
        `/docente/salones/${salonActual}/export/${cursoActual}`;
}

// ===============================
// 📥 IMPORTAR EXCEL
// ===============================
function importarNotas(formData) {
    fetch(`/docente/salones/${salonActual}/import`, {
        method: 'POST',
        body: formData
    })
        .then(r => r.json())
        .then(resp => alert(resp.message))
        .catch(err => console.error(err));
}

// ===============================
// 🔙 VISTAS
// ===============================
function volverMaterias() {
    cambiarVista('vista-materias');
}

function volverDocentes() {
    cambiarVista('vista-docentes');
}

function volverSalones() {
    cambiarVista('vista-salones-docente');
}

// ===============================
// 🧠 INIT EVENTS
// ===============================
document.addEventListener('DOMContentLoaded', function () {

    const btnGuardarNotas = document.getElementById('btn-guardar-notas');
    if (btnGuardarNotas) {
        btnGuardarNotas.addEventListener('click', function (e) {
            e.preventDefault();
            guardarNotasDetalle();
        });
    }
});