let destinatarioSeleccionado = null;
let tipoEnvio = 'individual';

// 🔥 Variables para navegación de mensajes
let cursoMsgActual = null;
let nombreCursoMsg = null;
let salonMsgActual = null;

// 🔥 3. ABRIR CURSO
function abrirCursoMsg(nombre, id) {
    console.log('🔥 abrirCursoMsg llamado con:', {nombre, id});
    
    cursoMsgActual = id;
    nombreCursoMsg = nombre;

    cambiarVistaMsg('vista-mensajes-salones');
    document.getElementById('titulo-curso-msg').innerText = nombre;

    const contenedor = document.getElementById('lista-salones-msg');
    contenedor.innerHTML = `<div class="text-center"><span class="spinner-border spinner-border-sm"></span> Cargando...</div>`;

    console.log('📡 Fetch a:', `/admin/messages/curso/${id}/salones`);
    
    fetch(`/admin/messages/curso/${id}/salones`)
        .then(r => {
            console.log('📦 Response status:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('✅ Datos recibidos:', data);
            
            let html = '';

            if (!data || data.length === 0) {
                html = '<div class="col-12"><p class="text-muted text-center">No hay salones asignados</p></div>';
                console.warn('⚠️ No hay salones');
            } else {
                data.forEach(s => {
                    console.log('🏫 Procesando salón:', s);
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
        })
        .catch(err => {
            console.error('❌ Error:', err);
            contenedor.innerHTML = `<div class="alert alert-danger">Error al cargar salones: ${err.message}</div>`;
        });
}

// 🔥 4. CAMBIO DE VISTA
function cambiarVistaMsg(vista) {
    document.querySelectorAll('#vista-mensajes-cursos, #vista-mensajes-salones')
        .forEach(v => v.classList.remove('active'));

    document.getElementById(vista).classList.add('active');
}

function volverCursosMsg() {
    cambiarVistaMsg('vista-mensajes-cursos');
}

// 🔥 5. ABRIR SALÓN → MOSTRAR PANEL
function abrirSalonMsg(idSalon, nombreSalon) {
    salonMsgActual = idSalon;

    document.getElementById('displayMateria').innerText = nombreCursoMsg + ' - ' + nombreSalon;
    document.getElementById('current_id_curso').value = cursoMsgActual;
    document.getElementById('current_id_curso_salon').value = idSalon;

    document.getElementById('mensaje_contenido').value = '';
    document.getElementById('destinatario_msg').value = '';
    document.getElementById('resultados_busqueda').innerHTML = '';
    mostrarMensaje('', '');
    destinatarioSeleccionado = null;
    tipoEnvio = 'individual';

    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.add('active');

    document.getElementById('destinatario_msg').focus();
}

function cargarSalones(idCurso, materia) {
    fetch(`/admin/messages/curso/${idCurso}/salones`)
        .then(res => res.json())
        .then(data => {
            const contenedor = document.getElementById('listaSalones');
            contenedor.classList.remove('d-none');

            contenedor.innerHTML = `<h5 class="mb-3">Salones de ${materia}</h5>`;

            data.forEach(item => {
                contenedor.innerHTML += `
                    <div class="course-item" style="margin-bottom: 8px;">
                        <div class="course-info">
                            <span>${item.salon.grado} - ${item.salon.seccion}</span>
                        </div>
                        <button class="btn btn-sm btn-primary"
                            onclick="abrirMensajeSalon(${idCurso}, ${item.id_curso_salon}, '${materia}')">
                            Enviar mensaje
                        </button>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error('Error al cargar salones:', err);
            document.getElementById('listaSalones').innerHTML = '<div class="alert alert-danger">Error al cargar salones</div>';
        });
}

function abrirMensajeSalon(idCurso, idCursoSalon, materia) {
    document.getElementById('displayMateria').innerText = materia;
    document.getElementById('current_id_curso').value = idCurso;
    document.getElementById('current_id_curso_salon').value = idCursoSalon;

    document.getElementById('mensaje_contenido').value = '';
    document.getElementById('destinatario_msg').value = '';
    document.getElementById('resultados_busqueda').innerHTML = '';
    mostrarMensaje('', '');
    destinatarioSeleccionado = null;
    tipoEnvio = 'individual';

    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.add('active');

    document.getElementById('destinatario_msg').focus();
}

function abrirNuevoMensaje(materia, id) {

    // Seteamos la info del curso seleccionado
    document.getElementById('displayMateria').innerText = materia;
    document.getElementById('current_id_curso').value = id; 
    
    // Limpiamos el texto anterior
    document.getElementById('mensaje_contenido').value = '';
    document.getElementById('destinatario_msg').value = '';
    document.getElementById('resultados_busqueda').innerHTML = '';
    mostrarMensaje('', '');
    destinatarioSeleccionado = null;
    tipoEnvio = 'individual';

    // Mostramos el panel
    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.add('active');

    // Mejor UX: enfocamos destinatario
    document.getElementById('destinatario_msg').focus();
}

function cerrarPanel() {
    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.remove('active');
}

function enviarAccion(url, token) {
    const id_curso = document.getElementById('current_id_curso').value;
    const id_curso_salon = document.getElementById('current_id_curso_salon').value;
    const contenido = document.getElementById('mensaje_contenido').value;
    const destinatario = document.getElementById('destinatario_msg').value;

    if (!destinatario.trim()) {
        mostrarMensaje("Selecciona un destinatario.", "error");
        return;
    }

    if (!contenido.trim()) {
        mostrarMensaje("Escribe un mensaje antes de enviar.", "error");
        return;
    }

    if (tipoEnvio === 'individual' && !destinatarioSeleccionado) {
        mostrarMensaje("Selecciona un destinatario válido de la lista.", "error");
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
            destinatario_id: destinatarioSeleccionado,
            tipo: tipoEnvio
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            mostrarMensaje("✔ Mensaje enviado correctamente", "ok");
            document.getElementById('mensaje_contenido').value = '';
            document.getElementById('destinatario_msg').value = '';
            document.getElementById('resultados_busqueda').innerHTML = '';
            destinatarioSeleccionado = null;
            tipoEnvio = 'individual';
            cerrarPanel();
        } else {
            mostrarMensaje(data.message || "Error al enviar mensaje", "error");
        }
    })
    .catch(err => {
        mostrarMensaje("Error al enviar mensaje", "error");
        console.error("Error:", err);
    });
}

function seleccionarAlumno(id, nombre) {
    destinatarioSeleccionado = id;
    tipoEnvio = 'individual';

    document.getElementById('destinatario_msg').value = nombre;
    document.getElementById('resultados_busqueda').innerHTML = '';
}

function seleccionarGrupo() {
    tipoEnvio = 'grupo';
    destinatarioSeleccionado = null;

    document.getElementById('destinatario_msg').value = '📢 Todo el salón';
    document.getElementById('resultados_busqueda').innerHTML = '';
}

function mostrarMensaje(texto, tipo) {
    const estado = document.getElementById('mensajeEstado');
    if (!estado) {
        return;
    }

    if (!texto) {
        estado.style.display = 'none';
        estado.innerText = '';
        estado.className = '';
        return;
    }

    estado.style.display = 'block';
    estado.className = tipo === "ok" ? "text-success fw-bold" : "text-danger fw-bold";
    estado.innerText = texto;
}

const destinatarioInput = document.getElementById('destinatario_msg');
const resultadosBusqueda = document.getElementById('resultados_busqueda');

if (destinatarioInput && resultadosBusqueda) {
    destinatarioInput.addEventListener('keyup', function () {
        let query = this.value.trim();

        if (query === '📢 Todo el salón') {
            return;
        }

        tipoEnvio = 'individual';
        destinatarioSeleccionado = null;

        if (query.length < 2) {
            resultadosBusqueda.innerHTML = '';
            return;
        }

        const idSalon = document.getElementById('current_id_curso_salon').value;

        fetch(`${window.buscarAlumnosUrl}?q=${encodeURIComponent(query)}&id_curso_salon=${idSalon}`)
            .then(res => res.json())
            .then(data => {
                console.log("🔍 DATA BACKEND:", data);
                
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
                            onclick="seleccionarAlumno(${user.id}, ${JSON.stringify(user.name)})">

                            <div class="me-3">
                                <div class="avatar-circle">
                                    ${icono}
                                </div>
                            </div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold">${user.name}</div>
                                <small class="text-muted">${rol}</small>
                            </div>
                        </div>
                    `;
                });
            });
    });
}