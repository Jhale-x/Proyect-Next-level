function switchCiclo(event, cicloId) {
    const paneles = document.querySelectorAll('.ciclo-panel');
    const botones = document.querySelectorAll('.tab-btn-next');

    if (paneles.length === 0 || botones.length === 0) return;

    paneles.forEach(panel => {
        panel.classList.remove('active');
    });

    botones.forEach(btn => {
        btn.classList.remove('active');
    });

    const panelSeleccionado = document.getElementById(cicloId);
    if (panelSeleccionado) {
        panelSeleccionado.classList.add('active');
    }

    if (event && event.currentTarget) {
        event.currentTarget.classList.add('active');
    }
}
