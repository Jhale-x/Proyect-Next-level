document.addEventListener('DOMContentLoaded', function () {

    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

            if (eyeOpen && eyeClosed) {
                eyeOpen.classList.toggle('hidden');
                eyeClosed.classList.toggle('hidden');
            }
        });
    }

    const container = document.getElementById('mainContainer');
    const toggleBtn = document.getElementById('toggleBtn');
    const title = document.getElementById('overlayTitle');
    const text = document.getElementById('overlayText');

    if (toggleBtn && container) {
        toggleBtn.addEventListener('click', function () {
            container.classList.toggle('active');
            const isActive = container.classList.contains('active');

            title.innerText = isActive ? "¿Eres Familia?" : "¿Eres Alumno?";

            const isAcademia = document.body.innerText.includes('Academia');

            if (isActive) {
                text.innerHTML = "Accede con tu documento de identidad para el <br> seguimiento de tus hijos.";
                toggleBtn.innerHTML = "<span>Soy Familia</span>";
            } else {
                if (isAcademia) {
                    text.innerHTML = "Ingresa con tu código para acceder a tus <br> notas y material de clase.";
                } else {
                    text.innerHTML = "Ingresa con tu código de estudiante para acceder a tus notas y cursos.";
                }
                toggleBtn.innerHTML = "<span>Soy Alumno</span>";
            }
        });
    }
});
