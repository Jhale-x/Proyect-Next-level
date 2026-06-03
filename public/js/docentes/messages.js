const DocenteMessages = (() => {

    let cursoActual = null;
    let salonActual = null;

    let usuarioActual = null;
    let tipoActual = null;

    let lastHash = "";

    function init() {
        console.log("Mensajes Docente iniciado");
    }

    // =========================
    // CURSO
    // =========================
    function abrirCurso(idCurso, materia) {

        cursoActual = idCurso;

        document.getElementById("chatTitle").innerText =
            `Salones - ${materia}`;

        document.getElementById("inboxModal")
            .classList.add("active");

        cargarSalones(idCurso);
    }

    // =========================
    // SALONES
    // =========================
    function cargarSalones(idCurso) {

        fetch(`/docente/messages/curso/${idCurso}/salones`)
            .then(r => r.json())
            .then(data => {

                const box = document.getElementById("inboxList");

                if (!data.length) {
                    box.innerHTML = `<div class="text-center text-muted">No hay salones</div>`;
                    return;
                }

                box.innerHTML = data.map(s => `
                    <div class="inbox-item"
                        onclick="DocenteMessages.abrirSalon(${s.id_curso_salon})">

                        <div class="inbox-name">
                            ${s.salon?.grado ?? 'N/A'} - ${s.salon?.seccion ?? 'N/A'}
                        </div>

                        <div class="inbox-last">Ver conversaciones</div>
                    </div>
                `).join("");
            })
            .catch(console.error);
    }

    // =========================
    // CONVERSACIONES
    // =========================
    function abrirSalon(idSalon) {

        salonActual = idSalon;

        // Mostrar botón de nueva conversación
        document.querySelector(".chat-float-button")
            .classList.add("show");

        fetch(`/docente/messages/conversaciones/${idSalon}`)
            .then(r => r.json())
            .then(data => {

                const box = document.getElementById("inboxList");

                if (!data.length) {
                    box.innerHTML = `<div class="text-center text-muted">Sin conversaciones</div>`;
                    return;
                }

                box.innerHTML = data.map(c => `
                    <div class="inbox-item"
                        onclick="DocenteMessages.abrirChat(${c.id}, '${c.tipo}')">

                        <div class="inbox-name">
                            ${c.nombre}
                        </div>

                        <div class="inbox-last">
                            ${c.contenido}
                        </div>

                        <div class="inbox-time">
                            ${c.fecha}
                        </div>
                    </div>
                `).join("");

            })
            .catch(console.error);
    }

    // =========================
    // CHAT
    // =========================
    function abrirChat(idUsuario, tipo) {

        usuarioActual = idUsuario;
        tipoActual = tipo;

        document.getElementById("chatModal")
            .classList.add("active");

        document.getElementById("chatUserTitle").innerText =
            `Chat con ${tipo} #${idUsuario}`;

        cargarChat();
    }

    // =========================
    // CARGAR CHAT
    // =========================
    function cargarChat() {

        if (!usuarioActual || !tipoActual || !salonActual) return;

        fetch(`/docente/messages/chat/${salonActual}?usuario=${usuarioActual}&tipo=${tipoActual}`)
            .then(r => r.json())
            .then(data => {

                const box = document.getElementById("chatMessages");

                const hash = JSON.stringify(data);
                if (hash === lastHash) return;
                lastHash = hash;

                box.innerHTML = data.map(m => {

                    const esDocente = m.emisor?.tipo === "user";

                    return `
                        <div class="message-bubble ${esDocente ? "outgoing" : "incoming"}">
                            <div class="bubble">

                                <strong>${m.emisor?.name ?? 'Usuario'}</strong>
                                <br>

                                ${m.contenido}

                                <div class="small text-muted mt-1">
                                    ${m.fecha}
                                </div>

                            </div>
                        </div>
                    `;
                }).join("");

                box.scrollTop = box.scrollHeight;
            })
            .catch(console.error);
    }

    // =========================
    // ENVIAR
    // =========================
    function sendMessage() {

        const input = document.getElementById("chatInput");
        const contenido = input.value.trim();

        if (!contenido) return;

        fetch("/docente/messages/responder", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken
            },
            body: JSON.stringify({
                id_usuario: usuarioActual,
                tipo: tipoActual,
                id_curso: cursoActual,
                id_curso_salon: salonActual,
                contenido: contenido
            })
        })
            .then(r => r.json())
            .then(() => {
                input.value = "";
                cargarChat();
            })
            .catch(console.error);
    }

    // =========================
    // NUEVA CONVERSACIÓN
    // =========================
    function nuevaConversacion() {

        if (!salonActual || !cursoActual) {
            alert("Debes seleccionar un salón primero");
            return;
        }

        // Abrir modal de selección
        document.getElementById("selectUserModal")
            .classList.add("active");

        // Limpiar búsqueda anterior
        document.getElementById("searchUserInput").value = "";
        cargarUsuariosSalon();
    }

    // =========================
    // CARGAR USUARIOS DEL SALÓN
    // =========================
    function cargarUsuariosSalon(buscar = "") {

        // Construir parámetro de búsqueda
        const params = new URLSearchParams();
        if (buscar) params.append("q", buscar);

        fetch(`/docente/messages/usuarios/${salonActual}?${params}`)
            .then(r => r.json())
            .then(usuarios => {

                const box = document.getElementById("usersList");

                if (!usuarios || usuarios.length === 0) {
                    box.innerHTML = `<div class="text-center text-muted p-3">No hay usuarios</div>`;
                    return;
                }

                box.innerHTML = usuarios.map(u => `
                    <div class="user-item" 
                        onclick="DocenteMessages.selectarUsuario(${u.id}, '${u.tipo}', '${u.nombre}')">
                        
                        <div class="user-icon">
                            ${u.tipo === 'alumno' ? '👤' : '👨‍🏫'}
                        </div>

                        <div class="user-info">
                            <div class="user-name">${u.nombre}</div>
                            <div class="user-role">${u.tipo === 'alumno' ? 'Alumno' : 'Docente'}</div>
                        </div>
                    </div>
                `).join("");

            })
            .catch(console.error);
    }

    // =========================
    // BUSCAR USUARIOS
    // =========================
    function buscarUsuario() {

        const input = document.getElementById("searchUserInput");
        const buscar = input.value.trim();

        cargarUsuariosSalon(buscar);
    }

    // =========================
    // SELECCIONAR USUARIO
    // =========================
    function selectarUsuario(idUsuario, tipo, nombre) {

        usuarioActual = idUsuario;
        tipoActual = tipo;

        // Cerrar modal de selección
        document.getElementById("selectUserModal")
            .classList.remove("active");

        // Abrir chat
        abrirChat(idUsuario, tipo, nombre);
    }

    // =========================
    // ABRIR CHAT (MEJORADO)
    // =========================
    function abrirChat(idUsuario, tipo, nombre = null) {

        usuarioActual = idUsuario;
        tipoActual = tipo;

        document.getElementById("chatModal")
            .classList.add("active");

        // Mostrar nombre del usuario
        const display = nombre || `${tipo} #${idUsuario}`;
        document.getElementById("chatUserTitle").innerText = `Chat con ${display}`;

        // Limpiar chat anterior
        document.getElementById("chatMessages").innerHTML = "";
        document.getElementById("chatInput").value = "";

        cargarChat();
    }

    // =========================
    // CERRAR
    // =========================
    function closeInbox() {
        document.getElementById("inboxModal").classList.remove("active");

        // Ocultar botón de nueva conversación
        document.querySelector(".chat-float-button")
            .classList.remove("show");

        cursoActual = null;
        salonActual = null;
    }

    function closeChat() {
        document.getElementById("chatModal").classList.remove("active");
        usuarioActual = null;
        tipoActual = null;
        lastHash = "";
    }

    function closeSelectUser() {
        document.getElementById("selectUserModal").classList.remove("active");
    }

    return {
        init,
        abrirCurso,
        abrirSalon,
        abrirChat,
        nuevaConversacion,
        cargarUsuariosSalon,
        buscarUsuario,
        selectarUsuario,
        sendMessage,
        closeInbox,
        closeChat,
        closeSelectUser
    };

})();

document.addEventListener("DOMContentLoaded", () => {
    DocenteMessages.init();
});