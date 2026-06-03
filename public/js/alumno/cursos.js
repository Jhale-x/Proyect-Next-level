let cursoActual = null;

function abrirCurso(idCurso, nombreCurso) {

    cursoActual = idCurso;

    document.getElementById('vista-cursos').classList.add('d-none');
    document.getElementById('vista-detalle').classList.remove('d-none');

    document.getElementById('titulo-curso').textContent = nombreCurso;

    const tabla = document.getElementById('tabla-actividades');

    tabla.innerHTML = `
        <tr>
            <td colspan="4" class="text-center">
                Cargando actividades...
            </td>
        </tr>
    `;

    fetch(`/alumno/courses/${idCurso}/detalle`)
        .then(response => response.json())
        .then(data => {

            let html = '';
            let suma = 0;
            let cantidad = 0;

            if (data.actividades.length === 0) {

                html = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No hay actividades registradas.
                        </td>
                    </tr>
                `;

            } else {

                data.actividades.forEach(act => {

                    let nota = '-';

                    if (act.nota !== null && act.nota !== undefined) {
                        nota = act.nota;
                        suma += parseFloat(act.nota);
                        cantidad++;
                    }

                    html += `
                        <tr>
                            <td>${act.actividad}</td>
                            <td>${act.fecha_entrega ?? '-'}</td>
                            <td>${act.hora_entrega ?? '-'}</td>
                            <td>
                                <span class="badge bg-primary">
                                    ${nota}
                                </span>
                            </td>
                        </tr>
                    `;
                });
            }

            tabla.innerHTML = html;

            const promedio = cantidad > 0
                ? (suma / cantidad).toFixed(2)
                : '-';

            document.getElementById('promedio-general').textContent = promedio;
        })
        .catch(error => {

            console.error(error);

            tabla.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center text-danger">
                        Error al cargar actividades.
                    </td>
                </tr>
            `;
        });
}

function volverCursos() {

    document.getElementById('vista-detalle').classList.add('d-none');
    document.getElementById('vista-cursos').classList.remove('d-none');

    document.getElementById('tabla-actividades').innerHTML = `
        <tr>
            <td colspan="4" class="text-center text-muted">
                Selecciona un curso
            </td>
        </tr>
    `;

    document.getElementById('promedio-general').textContent = '-';

    cursoActual = null;
}

document.addEventListener('DOMContentLoaded', () => {

    console.log('Módulo de cursos del alumno cargado');

});