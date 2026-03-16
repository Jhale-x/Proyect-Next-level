let cursoActual = null;
let docenteActual = null;
let salonActual = null;
let actividadesActuales = [];

function vista(ocultar, mostrar) {
    const elOcultar = document.getElementById(ocultar);
    const elMostrar = document.getElementById(mostrar);

    if (elOcultar) elOcultar.classList.add('d-none');
    if (elMostrar) elMostrar.classList.remove('d-none');
}

function abrirMateria(nombre, id_curso) {
    cursoActual = id_curso;

    vista('vista-materias', 'vista-docentes');

    const tituloMateria = document.getElementById('titulo-materia');
    const actividadCursoId = document.getElementById('actividad_curso_id');
    const asignarCursoId = document.getElementById('asignar_curso_id');

    if (tituloMateria) tituloMateria.innerText = nombre;
    if (actividadCursoId) actividadCursoId.value = id_curso;
    if (asignarCursoId) asignarCursoId.value = id_curso;

    fetch(`/admin/courses/${id_curso}/docentes`)
        .then((r) => r.json())
        .then((data) => {
            let html = '';

            data.forEach((d) => {
                html += `
                    <div class="col-md-3">
                        <div class="course-card" onclick="abrirDocente('${d.nombre}', ${d.id})">
                            <div class="p-3 fw-bold">${d.nombre}</div>
                        </div>
                    </div>
                `;
            });

            const lista = document.getElementById('lista-docentes-materia');
            if (lista) lista.innerHTML = html;
        })
        .catch((error) => console.error('Error docentes:', error));
}

function abrirDocente(nombre, id_docente) {
    docenteActual = id_docente;

    vista('vista-docentes', 'vista-salones-docente');

    const tituloDocente = document.getElementById('titulo-docente');
    const docenteIdInput = document.getElementById('docente_id');

    if (tituloDocente) tituloDocente.innerText = nombre;
    if (docenteIdInput) docenteIdInput.value = id_docente;

    fetch(`/admin/courses/docente/${id_docente}/salones`)
        .then((r) => r.json())
        .then((data) => {
            let html = '';

            data.forEach((s) => {
                html += `
                    <div class="col-md-3">
                        <div class="course-card" onclick="abrirDetalle(${s.id})">
                            <div class="p-3 fw-bold">${s.nivel} ${s.grado} - ${s.seccion}</div>
                        </div>
                    </div>
                `;
            });

            const lista = document.getElementById('lista-salones-docente');
            if (lista) lista.innerHTML = html;
        })
        .catch((error) => console.error('Error salones:', error));
}

function abrirDetalle(idSalon) {
    salonActual = idSalon;

    vista('vista-salones-docente', 'vista-detalle');

    const exportForm = document.getElementById('export-form');
    const importForm = document.getElementById('import-form');
    const importCursoInput = document.getElementById('import_curso_id');

    if (exportForm) {
        exportForm.action = cursoActual ? `/admin/salones/${idSalon}/export/${cursoActual}` : '';
    }

    if (importForm) {
        importForm.action = `/admin/salones/${idSalon}/import`;
    }

    if (importCursoInput) {
        importCursoInput.value = cursoActual || '';
    }

    const queryCurso = cursoActual ? `?id_curso=${cursoActual}` : '';

    fetch(`/admin/salones/${idSalon}/detalle${queryCurso}`)
        .then((r) => r.json())
        .then((data) => {
            actividadesActuales = data.actividades || [];

            const notasMap = {};
            (data.notas || []).forEach((n) => {
                notasMap[`${n.id_alumno}-${n.id_curso_actividad}`] = n.nota;
            });

            let head = '<th class="fw-bold">Alumno</th>';

            actividadesActuales.forEach((act) => {
                const porcentaje = act.actividad.porcentaje ?? 0;
                head += `
                    <th class="text-center">
                        ${act.actividad.actividad}
                        <br>
                        <small class="text-muted">${porcentaje}%</small>
                    </th>
                `;
            });

            head += '<th class="text-center fw-bold">PROM</th>';

            const cabecera = document.getElementById('cabecera-actividades');
            if (cabecera) cabecera.innerHTML = head;

            const tablaAlumnos = document.getElementById('tabla-alumnos');
            if (!tablaAlumnos) return;

            if (!data.alumnos || data.alumnos.length === 0) {
                tablaAlumnos.innerHTML = `
                    <tr>
                        <td colspan="10" class="text-center text-muted">No hay alumnos en este salón</td>
                    </tr>
                `;
                return;
            }

            let body = '';

            data.alumnos.forEach((alumno) => {
                body += '<tr>';
                body += `<td class="fw-semibold">${alumno.nombre} ${alumno.apellido}</td>`;

                actividadesActuales.forEach((act) => {
                    const key = `${alumno.id_alumno}-${act.id_curso_actividad}`;
                    const notaActual = notasMap[key] ?? '';

                    body += `
                        <td>
                            <input type="number"
                                data-alumno="${alumno.id_alumno}"
                                data-actividad="${act.id_curso_actividad}"
                                class="form-control form-control-sm text-center"
                                min="0"
                                max="20"
                                step="0.01"
                                value="${notaActual}"
                                placeholder="-">
                        </td>
                    `;
                });

                body += '<td class="text-center fw-bold prom-cell">-</td>';
                body += '</tr>';
            });

            tablaAlumnos.innerHTML = body;
            recalcularPromedios();
        })
        .catch((error) => console.error('Error detalle:', error));
}

function recalcularPromedios() {

    const rows = document.querySelectorAll('#tabla-alumnos tr');

    rows.forEach(row => {

        const inputs = row.querySelectorAll('input[type="number"]');
        const promCell = row.querySelector('.prom-cell');

        if (!promCell) return;

        let total = 0;

        inputs.forEach(input => {

            const nota = parseFloat(input.value);
            if (isNaN(nota)) return;

            const idActividad = input.dataset.actividad;

            const actividad = actividadesActuales.find(a =>
                a.id_curso_actividad == idActividad
            );

            if (!actividad) return;

            const peso = (actividad.actividad.porcentaje ?? 0) / 100;

            total += nota * peso;

        });

        promCell.textContent = total.toFixed(2);

    });
}

function guardarNotasDetalle() {
    if (!salonActual) return;

    const tokenInput = document.querySelector('input[name="_token"]');
    const token = tokenInput ? tokenInput.value : '';
    const notas = [];

    document.querySelectorAll('#tabla-alumnos input[type="number"]').forEach((input) => {
        const rawValue = input.value.trim();

        if (rawValue === '') {
            notas.push({
                id_alumno: Number(input.dataset.alumno),
                id_curso_actividad: Number(input.dataset.actividad),
                nota: null,
            });
            return;
        }

        notas.push({
            id_alumno: Number(input.dataset.alumno),
            id_curso_actividad: Number(input.dataset.actividad),
            nota: Number(rawValue),
        });
    });

    fetch(`/admin/salones/${salonActual}/guardar-notas`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            Accept: 'application/json',
        },
        body: JSON.stringify({ notas }),
    })
        .then(async (r) => {
            if (!r.ok) {
                const err = await r.json().catch(() => ({}));
                throw new Error(err.message || 'No se pudieron guardar las notas.');
            }
            return r.json();
        })
        .then((resp) => {
            alert(resp.message || 'Notas guardadas correctamente.');
        })
        .catch((error) => {
            console.error('Error guardando notas:', error);
            alert(error.message || 'Error al guardar notas.');
        });
}

function volverMaterias() {
    vista('vista-docentes', 'vista-materias');
}

function volverDocentes() {
    vista('vista-salones-docente', 'vista-docentes');
}

function volverASalones() {
    vista('vista-detalle', 'vista-salones-docente');
}

function cerrarRegistroExcel() {
    vista('vista-detalle', 'vista-salones-docente');
}

document.addEventListener('DOMContentLoaded', function () {
    const btnGuardarNotas = document.getElementById('btn-guardar-notas');
    if (btnGuardarNotas) {
        btnGuardarNotas.addEventListener('click', function (e) {
            e.preventDefault();
            guardarNotasDetalle();
        });
    }

    document.addEventListener('input', function (e) {
        if (e.target.matches('#tabla-alumnos input[type="number"]')) {
            recalcularPromedios();
        }
    });

    const contenedorNiveles = document.getElementById('contenedor-niveles');
    const btnAgregarNivel = document.getElementById('agregarNivel');
    if (btnAgregarNivel && contenedorNiveles) {
        btnAgregarNivel.addEventListener('click', function () {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="niveles[]" class="form-control" placeholder="Nombre del nivel" required>
                <button type="button" class="btn btn-danger eliminar">X</button>
            `;
            contenedorNiveles.appendChild(div);
        });
    }

    const contenedorSecciones = document.getElementById('contenedor-secciones');
    const btnAgregarSeccion = document.getElementById('agregarSeccion');
    if (btnAgregarSeccion && contenedorSecciones) {
        btnAgregarSeccion.addEventListener('click', function () {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="secciones[]" class="form-control" placeholder="Nombre de la sección" required>
                <button type="button" class="btn btn-danger eliminar-seccion">X</button>
            `;
            contenedorSecciones.appendChild(div);
        });
    }

    const contenedorGrados = document.getElementById('contenedor-grados');
    const btnAgregarGrado = document.getElementById('agregarGrado');
    const templateGrado = document.getElementById('template-grado');

    function reindexGrados() {
        if (!contenedorGrados) return;
        const bloques = contenedorGrados.querySelectorAll('.bloque-grado');
        bloques.forEach((bloque, idx) => {
            const select = bloque.querySelector('.select-nivel');
            const input = bloque.querySelector('.input-grado');
            if (select) select.setAttribute('name', `grados[${idx}][id_nivel]`);
            if (input) input.setAttribute('name', `grados[${idx}][grado]`);
        });
    }

    if (btnAgregarGrado && contenedorGrados && templateGrado) {
        btnAgregarGrado.addEventListener('click', function () {
            const div = document.createElement('div');
            div.innerHTML = templateGrado.innerHTML;
            const bloque = div.firstElementChild;
            if (bloque) {
                contenedorGrados.appendChild(bloque);
                reindexGrados();
            }
        });
    }

    const contenedorFacultades = document.getElementById('contenedor-facultades');
    const btnAgregarFacultad = document.getElementById('agregarFacultad');
    const templateFacultad = document.getElementById('template-facultad');

    function reindexFacultades() {
        if (!contenedorFacultades) return;
        const bloques = contenedorFacultades.querySelectorAll('.bloque-facultad');
        bloques.forEach((bloque, idx) => {
            const input = bloque.querySelector('.input-facultad');
            if (input) input.setAttribute('name', `facultades[${idx}]`);
        });
    }

    if (btnAgregarFacultad && contenedorFacultades && templateFacultad) {
        btnAgregarFacultad.addEventListener('click', function () {
            const div = document.createElement('div');
            div.innerHTML = templateFacultad.innerHTML;
            const bloque = div.firstElementChild;
            if (bloque) {
                contenedorFacultades.appendChild(bloque);
                reindexFacultades();
            }
        });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('eliminar')) {
            e.target.parentElement.remove();
        }

        if (e.target.classList.contains('eliminar-seccion')) {
            e.target.parentElement.remove();
        }

        if (e.target.classList.contains('btn-eliminar')) {
            const bloque = e.target.closest('.bloque-grado');
            if (bloque) bloque.remove();
            reindexGrados();
        }

        if (e.target.classList.contains('btn-eliminar-facultad')) {
            const bloque = e.target.closest('.bloque-facultad');
            if (bloque) bloque.remove();
            reindexFacultades();
        }
    });
});
