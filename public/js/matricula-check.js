/*

document.addEventListener('DOMContentLoaded', () => {
    const enrollmentForm = document.querySelector('.enrollment-form');
    const verifyBtn = document.querySelector('.btn-verify');
    const helpIcon = document.getElementById('helpIcon');
    const helpTooltip = document.getElementById('helpTooltip');

    if (enrollmentForm) {
        enrollmentForm.addEventListener('submit', (e) => {

            e.preventDefault();

            verifyBtn.innerText = 'Verificando...';
            verifyBtn.style.opacity = '0.6';
            verifyBtn.style.cursor = 'not-allowed';

            setTimeout(() => {
                window.location.href = "/matricula_formulario";
            }, 1200);
        });
    }

    if (helpIcon && helpTooltip) {

    helpIcon.addEventListener('mouseenter', () => {
        helpTooltip.style.display = 'block';
    });

    helpIcon.addEventListener('mouseleave', () => {
        helpTooltip.style.display = 'none';
    });
}
});

*/
