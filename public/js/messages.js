// ===============================
// 🔥 VARIABLES GLOBALES
// ===============================
let destinatarios = [];
let tipoEnvio = 'individual';

let cursoMsgActual = null;
let nombreCursoMsg = null;

let salonMsgActual = null;
let nombreSalonActual = null;
let mensajeActual = null;

const destinatarioInput = document.getElementById('destinatario_msg');
const resultadosBusqueda = document.getElementById('resultados_busqueda');


// ===============================
// 🔥 1. ABRIR CURSO
// ===============================
function abrirCursoMsg(nombre, id) {

    cursoMsgActual = id;
    nombreCursoMsg = nombre;

    // 🔄 CAMBIAR A VISTA SALONES
    cambiarVistaMsg('vista-mensajes-salones');

    // 🏷️ TITULO
    document.getElementById('titulo-curso-msg').innerText = nombre;

    // 📦 CONTENEDOR
    const contenedor = document.getElementById('lista-salones-msg');

    contenedor.innerHTML = `
        <div class="text-center">
            Cargando...
        </div>
    `;

    // 🔥 OBTENER SALONES
    fetch(`/admin/messages/curso/${id}/salones`)

        .then(r => r.json())

        .then(data => {

            let html = '';

            // ❌ SIN SALONES
            if (!data || data.length === 0) {

                html = `
                    <p class="text-center">
                        No hay salones
                    </p>
                `;

            } else {

                // 🔁 RECORRER SALONES
                data.forEach(s => {

                    let grado = s.salon?.grado ?? s.grado ?? '';
                    let seccion = s.salon?.seccion ?? s.seccion ?? '';

                    html += `
                        <div class="col-md-3">

                            <div class="course-card"
                                onclick="abrirSalonMsg(
                                    ${s.id_curso_salon},
                                    '${grado} - ${seccion}'
                                )">

                                <div class="p-3 fw-bold">
                                    🏫 ${grado} - ${seccion}
                                </div>

                            </div>

                        </div>
                    `;
                });
            }

            contenedor.innerHTML = html;
        })

        .catch(err => {

            console.error(err);

            contenedor.innerHTML = `
                <div class="text-danger text-center">
                    Error cargando salones
                </div>
            `;
        });
}


// ===============================
// 🔥 2. CAMBIAR VISTAS
// ===============================
function cambiarVistaMsg(vista) {

    document.querySelectorAll('.view')
        .forEach(v => v.classList.remove('active'));

    document.getElementById(vista)
        .classList.add('active');
}


// ===============================
// 🔥 3. VOLVER A CURSOS
// ===============================
function volverCursosMsg() {

    cambiarVistaMsg('vista-mensajes-cursos');
}


// ===============================
// 🔥 4. VOLVER A SALONES
// ===============================
function volverSalonesMsg() {

    cambiarVistaMsg('vista-mensajes-salones');
}


// ===============================
// 🔥 5. ABRIR SALÓN
// ===============================
function abrirSalonMsg(idSalon, nombreSalon) {

    salonMsgActual = idSalon;
    nombreSalonActual = nombreSalon;

    // 🔄 CAMBIAR A CONVERSACIONES
    cambiarVistaMsg('vista-mensajes-chat');

    // 🏷️ TITULO
    document.getElementById('titulo-chat-msg').innerText =
        nombreCursoMsg + ' - ' + nombreSalon;

    // 🔥 CARGAR CONVERSACIONES
    cargarConversaciones(idSalon);
}


// ===============================
// 🔥 6. CARGAR CONVERSACIONES
// ===============================
function cargarConversaciones(idSalon) {

    const contenedor = document.getElementById('lista-conversaciones');

    contenedor.innerHTML = `
        <div class="text-center">
            Cargando conversaciones...
        </div>
    `;

    // 🔥 ENDPOINT FUTURO
    fetch(`/admin/messages/conversaciones/${idSalon}`)

        .then(res => res.json())

        .then(data => {

            let html = '';

            // ❌ SIN MENSAJES
            if (!data || data.length === 0) {

                html = `
                    <div class="text-center text-muted">
                        No hay conversaciones
                    </div>
                `;

            } else {

                // 🔁 RECORRER CONVERSACIONES
                data.forEach(conv => {

                    html += `
                        <div class="conversation-item"
                            onclick="abrirConversacion(${conv.id})">

                            <div class="fw-bold">
                                Mensaje
                            </div>

                            <small class="text-muted">
                                ${conv.contenido ?? ''}
                            </small>

                        </div>
                    `;
                });
            }

            contenedor.innerHTML = html;
        })

        .catch(err => {

            console.error(err);

            contenedor.innerHTML = `
                <div class="text-danger text-center">
                    Error cargando conversaciones
                </div>
            `;
        });
}

function abrirConversacion(idMensaje) {

    mensajeActual = idMensaje;

    document.getElementById('lista-conversaciones')
        .classList.add('d-none');

    document.getElementById('btnVolverConversaciones')
        .classList.remove('d-none');

    const chatBox =
        document.getElementById('chat-conversacion');

    const mensajesBox =
        document.getElementById('chat-mensajes');

    // MOSTRAR CHAT
    chatBox.classList.remove('d-none');

    mensajesBox.innerHTML = `
        <div class="text-center">
            Cargando mensajes...
        </div>
    `;

    fetch(`/admin/messages/chat/${idMensaje}`)

        .then(res => res.json())

        .then(data => {

            let html = '';

            if (!data || data.length === 0) {

                html = `
                    <div class="text-muted text-center">
                        No hay mensajes
                    </div>
                `;

            } else {

                data.forEach(msg => {

                    const propio =
                        msg.emisor_tipo === window.userTipo &&
                        msg.id_emisor == window.userId;

                    html += `
                        <div class="
                            d-flex
                            mb-3
                            ${propio ? 'justify-content-end' : 'justify-content-start'}
                        ">

                            <div class="
                                p-3
                                rounded
                                ${propio ? 'bg-primary text-white' : 'bg-light'}
                            "
                            style="max-width: 70%;">

                                <div class="fw-bold small mb-1">
                                    ${msg.emisor?.name ?? 'Desconocido'}
                                </div>

                                <div>
                                    ${msg.contenido}
                                </div>

                            </div>
                        </div>`;
                });
            }

            mensajesBox.innerHTML = html;

            mensajesBox.scrollTop =
                mensajesBox.scrollHeight;
        })

        .catch(err => {

            console.error(err);

            mensajesBox.innerHTML = `
                <div class="text-danger text-center">
                    Error cargando chat
                </div>
            `;
        });
}
function responderMensaje() {

    const contenido =
        document.getElementById('respuesta_mensaje').value;

    if (!contenido.trim()) return;

    fetch('/admin/messages/responder', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },

        body: JSON.stringify({

            id_mensaje: mensajeActual,
            contenido: contenido

        })

    })

        .then(res => res.json())

        .then(data => {

            if (data.status === 'success') {

                document.getElementById('respuesta_mensaje').value = '';

                abrirConversacion(mensajeActual);

            }

        })

        .catch(err => console.error(err));
}

function volverConversaciones() {

    // 🔥 MOSTRAR LISTA
    document.getElementById('lista-conversaciones')
        .classList.remove('d-none');

    // 🔥 OCULTAR CHAT
    document.getElementById('chat-conversacion')
        .classList.add('d-none');

    // 🔥 OCULTAR BOTON
    document.getElementById('btnVolverConversaciones')
        .classList.add('d-none');
}


// ===============================
// 🔥 7. ABRIR NUEVO MENSAJE
// ===============================
function abrirNuevoMensaje() {

    // 🏷️ TITULO PANEL
    document.getElementById('displayMateria').innerText =
        nombreCursoMsg + ' - ' + nombreSalonActual;

    // 🔒 IDS
    document.getElementById('current_id_curso').value =
        cursoMsgActual;

    document.getElementById('current_id_curso_salon').value =
        salonMsgActual;

    // 🧹 LIMPIAR FORM
    limpiarFormulario();

    // 📂 ABRIR PANEL
    document.getElementById('panelNuevoMensaje')
        .classList.add('active');

    // 👥 CARGAR USUARIOS
    cargarUsuarios('');
}


// ===============================
// 🔥 8. LIMPIAR FORMULARIO
// ===============================
function limpiarFormulario() {

    document.getElementById('mensaje_contenido').value = '';
    document.getElementById('destinatario_msg').value = '';

    resultadosBusqueda.innerHTML = '';

    mostrarMensaje('', '');

    destinatarios = [];
    tipoEnvio = 'individual';

    renderDestinatarios();
}


// ===============================
// 🔥 9. CARGAR USUARIOS
// ===============================
function cargarUsuarios(query) {

    const idSalon =
        document.getElementById('current_id_curso_salon').value;

    fetch(`${window.buscarAlumnosUrl}?q=${encodeURIComponent(query)}&id_curso_salon=${idSalon}`)

        .then(res => res.json())

        .then(data => renderResultados(data))

        .catch(err => console.error('Error usuarios:', err));
}


// ===============================
// 🔥 10. RENDER RESULTADOS
// ===============================
function renderResultados(data) {

    resultadosBusqueda.innerHTML = `
        <div class="resultado-item px-3 py-2 fw-bold" onclick="seleccionarGrupo()">
            📢 Todo el salón
        </div>
    `;

    data.forEach(user => {

        let rol =
            user.role === 'docente'
                ? 'Profesor'
                : 'Estudiante';

        let icono =
            user.role === 'docente'
                ? '👨‍🏫'
                : '🎓';

        resultadosBusqueda.innerHTML += `
            <div class="resultado-item d-flex align-items-center px-3 py-2" onclick="seleccionarAlumno(${user.id}, '${user.name.replace(/'/g, "\\'")}')">
                <div class="me-3">
                    <div class="avatar-circle">
                        ${icono}
                    </div>
                </div>
                <div>
                    <div class="fw-semibold">
                        ${user.name}
                    </div>
                    <small class="text-muted">
                        ${rol}
                    </small>
                </div>
            </div>
        `;
    });
}


// ===============================
// 🔥 11. SELECCIONAR ALUMNO
// ===============================
function seleccionarAlumno(id, nombre) {

    if (destinatarios.some(u => u.id === id))
        return;

    destinatarios.push({ id, nombre });

    renderDestinatarios();

    document.getElementById('destinatario_msg').value = '';

    resultadosBusqueda.innerHTML = '';
}


// ===============================
// 🔥 12. SELECCIONAR GRUPO
// ===============================
function seleccionarGrupo() {

    tipoEnvio = 'grupo';

    destinatarios = [];

    document.getElementById('destinatario_msg').value =
        '📢 Todo el salón';

    resultadosBusqueda.innerHTML = '';
}


// ===============================
// 🔥 13. RENDER CHIPS
// ===============================
function renderDestinatarios() {

    const contenedor =
        document.getElementById('destinatarios_seleccionados');

    if (!contenedor) return;

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
function eliminarDestinatario(id) {

    destinatarios =
        destinatarios.filter(u => u.id !== id);

    renderDestinatarios();
}


// ===============================
// 🔥 15. ENVIAR MENSAJE
// ===============================
function enviarAccion(url, token) {

    const id_curso =
        document.getElementById('current_id_curso').value;

    const id_curso_salon =
        document.getElementById('current_id_curso_salon').value;

    const contenido =
        document.getElementById('mensaje_contenido').value;

    // ❌ VALIDAR
    if (!contenido.trim()) {

        mostrarMensaje(
            "Escribe un mensaje",
            "error"
        );

        return;
    }

    // 🚀 ENVIAR
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

            destinatario_id: destinatarios.length
                ? destinatarios[0].id
                : null,

            tipo: tipoEnvio
        })

    })

        .then(res => res.json())

        .then(data => {

            if (data.status === 'success') {

                mostrarMensaje(
                    "✔ Enviado",
                    "ok"
                );

                limpiarFormulario();

            } else {

                mostrarMensaje(
                    "Error al enviar",
                    "error"
                );
            }
        })

        .catch(err => {

            console.error(err);

            mostrarMensaje(
                "Error de conexión",
                "error"
            );
        });
}


// ===============================
// 🔥 16. MENSAJES UI
// ===============================
function mostrarMensaje(texto, tipo) {

    const estado =
        document.getElementById('mensajeEstado');

    if (!estado) return;

    if (!texto) {

        estado.style.display = 'none';

        return;
    }

    estado.style.display = 'block';

    estado.className =
        tipo === "ok"
            ? "text-success fw-bold"
            : "text-danger fw-bold";

    estado.innerText = texto;
}


// ===============================
// 🔥 17. EVENTOS INPUT
// ===============================
if (destinatarioInput) {

    destinatarioInput.addEventListener('focus', () => {

        cargarUsuarios('');
    });

    destinatarioInput.addEventListener('keyup', function () {

        const query = this.value.trim();

        cargarUsuarios(query);
    });
}


// ===============================
// 🔥 18. CERRAR PANEL
// ===============================
function cerrarPanel() {

    document.getElementById('panelNuevoMensaje')
        .classList.remove('active');
}

