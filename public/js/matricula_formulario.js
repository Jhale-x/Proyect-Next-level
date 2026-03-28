document.addEventListener('DOMContentLoaded', () => {
    const selector = document.getElementById('modalidadSelector');
    const secAcademia = document.getElementById('section-academia');
    const secColegio = document.getElementById('section-colegio');
    const footerActions = document.getElementById('footer-actions');

    if (!selector) return;

    selector.addEventListener('change', function() {
        // 1. Ocultamos todo por defecto usando tu clase de CSS
        secAcademia.classList.add('hidden-section');
        secColegio.classList.add('hidden-section');

        // 2. El botón de continuar siempre debe aparecer si hay algo seleccionado
        footerActions.classList.remove('hidden-section');

        // 3. Mostramos la sección correspondiente quitando la clase
        if (this.value === 'academia') {
            secAcademia.classList.remove('hidden-section');
        } else if (this.value === 'colegio') {
            secColegio.classList.remove('hidden-section');
        }
    });
});
