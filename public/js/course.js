let cursoActual = null;
let docenteActual = null;

function vista(ocultar, mostrar) {
    let elOcultar = document.getElementById(ocultar);
    let elMostrar = document.getElementById(mostrar);

    if (elOcultar) elOcultar.classList.add('d-none');
    if (elMostrar) elMostrar.classList.remove('d-none');
}

function abrirMateria(nombre, id_curso) {

    cursoActual = id_curso;

    vista('vista-materias', 'vista-docentes');

    document.getElementById('titulo-materia').innerText = nombre;
    document.getElementById('actividad_curso_id').value = id_curso;
    document.getElementById('asignar_curso_id').value = id_curso;

    fetch(`/admin/courses/${id_curso}/docentes`)
        .then(r => r.json())
        .then(data => {

            let html = '';

            data.forEach(d => {
                html += `
                    <div class="col-md-3">
                        <div class="course-card"
                            onclick="abrirDocente('${d.nombre}', ${d.id})">
                            <div class="p-3 fw-bold">${d.nombre}</div>
                        </div>
                    </div>
                `;
            });

            document.getElementById('lista-docentes-materia').innerHTML = html;
        })
        .catch(error => console.error("Error docentes:", error));
}

function abrirDocente(nombre, id_docente) {

    docenteActual = id_docente;

    vista('vista-docentes', 'vista-salones-docente');

    document.getElementById('titulo-docente').innerText = nombre;
    document.getElementById('docente_id').value = id_docente;

    fetch(`/admin/courses/${id_docente}/salones`)
        .then(r => r.json())
        .then(data => {

            let html = '';

            data.forEach(s => {
                html += `
                    <div class="col-md-3">
                        <div class="course-card"
                            onclick="abrirDetalle(${s.id_salon})">
                            <div class="p-3 fw-bold">
                                ${s.nivel} ${s.grado} - ${s.seccion}
                            </div>
                        </div>
                    </div>
                `;
            });

            document.getElementById('lista-salones-docente').innerHTML = html;
        })
        .catch(error => console.error("Error salones:", error));
}

function abrirDetalle(idSalon) {

    vista('vista-salones-docente', 'vista-detalle');

    fetch(`/admin/salones/${idSalon}/detalle`)
        .then(r => r.json())
        .then(data => {

            let head = `<th class="fw-bold">Alumno</th>`;

            data.actividades.forEach(act => {
                head += `<th class="text-center">${act.actividad}</th>`;
            });

            head += `<th class="text-center fw-bold">PROM</th>`;

            document.getElementById('cabecera-actividades').innerHTML = head;

            let body = '';

            data.alumnos.forEach(alumno => {

                body += `<tr>`;
                body += `<td class="fw-semibold">${alumno.nombre}</td>`;

                data.actividades.forEach(act => {
                    body += `
                        <td>
                            <input type="number"
                                class="form-control form-control-sm text-center"
                                placeholder="-">
                        </td>
                    `;
                });

                body += `<td class="text-center fw-bold">-</td>`;
                body += `</tr>`;
            });

            document.getElementById('tabla-alumnos').innerHTML = body;
        })
        .catch(error => console.error("Error detalle:", error));
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
document.addEventListener("DOMContentLoaded", function () {

    /* ==============================
       NIVELES
    ============================== */

    const contenedorNiveles = document.getElementById("contenedor-niveles");
    const btnAgregarNivel = document.getElementById("agregarNivel");

    if (btnAgregarNivel) {
        btnAgregarNivel.addEventListener("click", function () {
            const div = document.createElement("div");
            div.classList.add("input-group", "mb-2");

            div.innerHTML = `
                <input type="text" name="niveles[]" class="form-control" placeholder="Nombre del nivel">
                <button type="button" class="btn btn-danger eliminar">X</button>
            `;

            contenedorNiveles.appendChild(div);
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("eliminar")) {
            e.target.parentElement.remove();
        }
    });


    /* ==============================
       SECCIONES
    ============================== */

    const contenedorSecciones = document.getElementById("contenedor-secciones");
    const btnAgregarSeccion = document.getElementById("agregarSeccion");

    if (btnAgregarSeccion) {
        btnAgregarSeccion.addEventListener("click", function () {
            const div = document.createElement("div");
            div.classList.add("input-group", "mb-2");

            div.innerHTML = `
                <input type="text" name="secciones[]" class="form-control" placeholder="Nombre de la sección">
                <button type="button" class="btn btn-danger eliminar-seccion">X</button>
            `;

            contenedorSecciones.appendChild(div);
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("eliminar-seccion")) {
            e.target.parentElement.remove();
        }
    });


    /* ==============================
       GRADOS
    ============================== */

    const contenedorGrados = document.getElementById("contenedor-grados");
    const btnAgregarGrado = document.getElementById("agregarGrado");
    const templateGrado = document.getElementById("template-grado");

    function reindexGrados() {
        const bloques = contenedorGrados.querySelectorAll('.bloque-grado');
        bloques.forEach((bloque, idx) => {
            const select = bloque.querySelector('.select-nivel');
            const input = bloque.querySelector('.input-grado');
            if (select) select.setAttribute('name', `grados[${idx}][id_nivel]`);
            if (input) input.setAttribute('name', `grados[${idx}][grado]`);
        });
    }

    if (btnAgregarGrado) {
        btnAgregarGrado.addEventListener("click", function () {
            const div = document.createElement("div");
            div.innerHTML = templateGrado.innerHTML;
            const bloque = div.firstElementChild;
            contenedorGrados.appendChild(bloque);
            reindexGrados();
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-eliminar")) {
            e.target.closest(".bloque-grado").remove();
            reindexGrados();
        }
    });

    // when the grade modal opens, make sure there's at least one block
    const modalGrado = document.getElementById('modalGrado');
    if (modalGrado) {
        modalGrado.addEventListener('show.bs.modal', function () {
            if (contenedorGrados.children.length === 0) {
                btnAgregarGrado.click();
            }
        });
    }


    /* ==============================
       FACULTADES
    ============================== */

    const contenedorFacultades = document.getElementById("contenedor-facultades");
    const btnAgregarFacultad = document.getElementById("agregarFacultad");
    const templateFacultad = document.getElementById("template-facultad");

    if (btnAgregarFacultad) {
        btnAgregarFacultad.addEventListener("click", function () {

            const div = document.createElement("div");
            div.innerHTML = templateFacultad.innerHTML;

            const bloque = div.firstElementChild;

            // Agregar name al input
            bloque.querySelector(".input-facultad")
                .setAttribute("name", "facultades[]");

            contenedorFacultades.appendChild(bloque);
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-eliminar-facultad")) {
            e.target.closest(".bloque-facultad").remove();
        }
    });

});