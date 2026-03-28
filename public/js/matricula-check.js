document.addEventListener('DOMContentLoaded', () => {
    const enrollmentForm = document.querySelector('.enrollment-form');
    const verifyBtn = document.querySelector('.btn-verify');
    const helpIcon = document.getElementById('helpIcon');
    const helpTooltip = document.getElementById('helpTooltip');

    if (enrollmentForm) {
        enrollmentForm.addEventListener('submit', (e) => {
            // Detenemos el envío real al backend
            e.preventDefault();

            // Feedback visual: deshabilitar botón y cambiar texto
            verifyBtn.innerText = 'Verificando...';
            verifyBtn.style.opacity = '0.6';
            verifyBtn.style.cursor = 'not-allowed';

            // Simulamos un tiempo de espera de 1.2 segundos antes de saltar
            setTimeout(() => {
                // Cambia esto por la URL que definieron para el formulario
                // Si la ruta en Laravel es /matricula/registro, pon esa.
                window.location.href = "/matricula-formulario";
            }, 1200);
        });
    }

    if (helpIcon && helpTooltip) {
    // Cuando el mouse entra
    helpIcon.addEventListener('mouseenter', () => {
        helpTooltip.style.display = 'block';
    });

    // Cuando el mouse sale
    helpIcon.addEventListener('mouseleave', () => {
        helpTooltip.style.display = 'none';
    });
}
});
