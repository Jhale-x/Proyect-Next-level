function abrirNuevoMensaje(materia, id) {
    // Seteamos la info del curso seleccionado
    document.getElementById('displayMateria').innerText = materia;
    document.getElementById('current_id_curso').value = id;
    
    // Limpiamos el texto anterior
    document.getElementById('mensaje_contenido').value = '';

    // Mostramos el panel
    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.add('active');
}

function cerrarPanel() {
    const panel = document.getElementById('panelNuevoMensaje');
    panel.classList.remove('active');
}

function enviarAccion(url, token) {
    const id_curso = document.getElementById('current_id_curso').value;
    const contenido = document.getElementById('mensaje_contenido').value;

    if (!contenido.trim()) {
        alert("Escribe un mensaje antes de enviar.");
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ id_curso, contenido })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("¡Mensaje enviado!");
            cerrarPanel();
        }
    })
    .catch(err => console.error("Error:", err));
}