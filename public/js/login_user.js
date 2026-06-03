const container = document.getElementById("mainContainer");
const toggleBtn = document.getElementById("toggleBtn");
const overlayTitle = document.getElementById("overlayTitle");
const overlayText = document.getElementById("overlayText");

let isTeacher = true;

toggleBtn.addEventListener("click", () => {
    container.classList.toggle("active");
    isTeacher = !isTeacher;

    if (isTeacher) {
        overlayTitle.textContent = "¿Eres Administrador?";
        overlayText.innerHTML = "Accede con tu documento para la <br> gestión administrativa.";
        toggleBtn.innerHTML = "<span>Soy Administrador</span>";
    } else {
        overlayTitle.textContent = "¿Eres Docente?";
        overlayText.innerHTML = "Ingresa con tu cuenta institucional para <br> gestionar clases y notas.";
        toggleBtn.innerHTML = "<span>Soy Docente</span>";
    }
});