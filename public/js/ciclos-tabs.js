function switchCiclo(event, cicloId) {
    // 1. Seleccionar todos los paneles y botones
    const paneles = document.querySelectorAll('.ciclo-panel');
    const botones = document.querySelectorAll('.tab-btn-next');

    // 2. Validar que existan elementos antes de iterar
    if (paneles.length === 0 || botones.length === 0) return;

    // 3. Ocultar todos los paneles con una transición suave
    paneles.forEach(panel => {
        panel.classList.remove('active');
    });

    // 4. Quitar el estado activo de todos los botones
    botones.forEach(btn => {
        btn.classList.remove('active');
    });

    // 5. Mostrar el panel seleccionado
    const panelSeleccionado = document.getElementById(cicloId);
    if (panelSeleccionado) {
        panelSeleccionado.classList.add('active');
    }

    // 6. Marcar el botón que disparó el evento como activo
    if (event && event.currentTarget) {
        event.currentTarget.classList.add('active');
    }
}
