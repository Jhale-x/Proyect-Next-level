// ===============================
// 🔥 VARIABLES GLOBALES
// ===============================
let destinatarioSeleccionado = null;
let destinatarios = [];
let tipoEnvio = 'individual';

let cursoMsgActual = null;
let nombreCursoMsg = null;
let salonMsgActual = null;

const destinatarioInput = document.getElementById('destinatario_msg');
const resultadosBusqueda = document.getElementById('resultados_busqueda');


// ===============================
// 🔥 1. ABRIR CURSO
// ===============================
function abrirCursoMsg(nombre, id) {
    cursoMsgActual = id;
    nombreCursoMsg = nombre;

    cambiarVistaMsg('vista-mensajes-salones');
    document.getElementById('titulo-curso-msg').innerText = nombre;

    const contenedor = document.getElementById('lista-salones-msg');
    contenedor.innerHTML = `<div class="text-center">Cargando...</div>`;

    fetch(`/admin/messages/curso/${id}/salones`)
        .then(r => r.json())
        .then(data => {

            let html = '';

            if (!data || data.length === 0) {
                html = '<p class="text-center">No hay salones</p>';
            } else {
                data.forEach(s => {
                    html += `
                        <div class="col-md-3">
                            <div class="course-card"
                                onclick="abrirSalonMsg(${s.id_curso_salon}, '${s.salon.grado} - ${s.salon.seccion}')">
                                <div class="p-3 fw-bold">
                                    🏫 ${s.salon.grado} - ${s.salon.seccion}
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            contenedor.innerHTML = html;
        });
}


// ===============================
// 🔥 2. CAMBIO DE VISTA
// ===============================
function cambiarVistaMsg(vista) {
    document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
    document.getElementById(vista).classList.add('active');
}

function irNuevoMensaje() {
    cambiarVistaMsg('vista-mensajes-cursos');
}

function volverCursosMsg() {
    cambiarVistaMsg('vista-mensajes-cursos');
}


// ===============================
// 🔥 3. ABRIR SALÓN
// ===============================
function abrirSalonMsg(idSalon, nombreSalon) {
    salonMsgActual = idSalon;

    document.getElementById('displayMateria').innerText =
        nombreCursoMsg + ' - ' + nombreSalon;

    document.getElementById('current_id_curso').value = cursoMsgActual;
    document.getElementById('current_id_curso_salon').value = idSalon;

    limpiarFormulario();

    document.getElementById('panelNuevoMensaje').classList.add('active');

    // 👉 IMPORTANTE: cargar usuarios automáticamente
    cargarUsuarios('');
}


// ===============================
// 🔥 4. LIMPIAR FORMULARIO
// ===============================
function limpiarFormulario() {
    document.getElementById('mensaje_contenido').value = '';
    document.getElementById('destinatario_msg').value = '';
    resultadosBusqueda.innerHTML = '';
    mostrarMensaje('', '');

    destinatarioSeleccionado = null;
    destinatarios = [];
    tipoEnvio = 'individual';

    renderDestinatarios();
}


// ===============================
// 🔥 5. CARGAR USUARIOS (CLAVE 🔥)
// ===============================
function cargarUsuarios(query) {
    const idSalon = document.getElementById('current_id_curso_salon').value;

    fetch(`${window.buscarAlumnosUrl}?q=${encodeURIComponent(query)}&id_curso_salon=${idSalon}`)
        .then(res => res.json())
        .then(data => renderResultados(data));
}


// ===============================
// 🔥 6. RENDER RESULTADOS
// ===============================
function renderResultados(data) {

    resultadosBusqueda.innerHTML = `
        <div class="resultado-item px-3 py-2 fw-bold"
            onclick="seleccionarGrupo()">
            📢 Todo el salón
        </div>
    `;

    data.forEach(user => {

        let rol = user.role === 'docente' ? 'Profesor' : 'Estudiante';
        let icono = user.role === 'docente' ? '👨‍🏫' : '🎓';

        resultadosBusqueda.innerHTML += `
            <div class="resultado-item d-flex align-items-center px-3 py-2"
                onclick="seleccionarAlumno(${user.id}, '${user.name.replace(/'/g, "\\'")}')"

                <div class="me-3">
                    <div class="avatar-circle">${icono}</div>
                </div>

                <div>
                    <div class="fw-semibold">${user.name}</div>
                    <small class="text-muted">${rol}</small>
                </div>
            </div>
        `;
    });
}


// ===============================
// 🔥 7. SELECCIONAR USUARIO
// ===============================
function seleccionarAlumno(id, nombre) {

    if (destinatarios.some(u => u.id === id)) return;

    destinatarios.push({ id, nombre });

    renderDestinatarios();

    document.getElementById('destinatario_msg').value = '';
    resultadosBusqueda.innerHTML = '';
}


// ===============================
// 🔥 8. SELECCIONAR GRUPO
// ===============================
function seleccionarGrupo() {
    tipoEnvio = 'grupo';
    destinatarios = [];

    document.getElementById('destinatario_msg').value = '📢 Todo el salón';
    resultadosBusqueda.innerHTML = '';
}


// ===============================
// 🔥 9. RENDER CHIPS
// ===============================
function renderDestinatarios() {
    const contenedor = document.getElementById('destinatarios_seleccionados');

    contenedor.innerHTML = '';

    destinatarios.forEach(user => {
        contenedor.innerHTML += `
            <span class="chip">
                ${user.nombre}
                <span class="chip-close" onclick="eliminarDestinatario(${user.id})">×</span>
            </span>
        `;
    });
}


// ===============================
// 🔥 10. ELIMINAR CHIP
// ===============================
function eliminarDestinatario(id) {
    destinatarios = destinatarios.filter(u => u.id !== id);
    renderDestinatarios();
}


// ===============================
// 🔥 11. ENVIAR MENSAJE
// ===============================
function enviarAccion(url, token) {

    const id_curso = document.getElementById('current_id_curso').value;
    const id_curso_salon = document.getElementById('current_id_curso_salon').value;
    const contenido = document.getElementById('mensaje_contenido').value;

    if (!contenido.trim()) {
        mostrarMensaje("Escribe un mensaje", "error");
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            id_curso,
            id_curso_salon,
            contenido,
            destinatarios: destinatarios.map(u => u.id),
            tipo: tipoEnvio
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === 'success') {
            mostrarMensaje("✔ Enviado", "ok");
            limpiarFormulario();
        } else {
            mostrarMensaje("Error", "error");
        }

    });
}


// ===============================
// 🔥 12. MENSAJES UI
// ===============================
function mostrarMensaje(texto, tipo) {

    const estado = document.getElementById('mensajeEstado');
    if (!estado) return;

    if (!texto) {
        estado.style.display = 'none';
        return;
    }

    estado.style.display = 'block';
    estado.className = tipo === "ok" ? "text-success" : "text-danger";
    estado.innerText = texto;
}


// ===============================
// 🔥 13. EVENTOS (AL FINAL)
// ===============================
if (destinatarioInput) {

    // 👉 Mostrar TODOS al hacer focus
    destinatarioInput.addEventListener('focus', () => {
        cargarUsuarios('');
    });

    // 👉 Filtrar al escribir
    destinatarioInput.addEventListener('keyup', function () {
        const query = this.value.trim();
        cargarUsuarios(query);
    });
}