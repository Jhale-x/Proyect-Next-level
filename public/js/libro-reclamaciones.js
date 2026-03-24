libro-reclamaciones.js:document.addEventListener('DOMContentLoaded', function() {
const sede = document.getElementById('sede');
const nivel = document.getElementById('nivel');
const wrapper = document.getElementById('wrapper-formulario');
const fechaSpan = document.getElementById('fecha-actual');
const gradoField = document.querySelector('select[name="grado"]').closest('.form-group');

if(fechaSpan) {
const hoy = new Date();
fechaSpan.textContent = hoy.toLocaleDateString('es-PE');
}

function actualizarFormulario() {
if (sede.value !== "" && nivel.value !== "") {
wrapper.style.display = 'block';
document.getElementById('hidden_sede').value = sede.value;
document.getElementById('hidden_nivel').value = nivel.value;

// Mostrar u ocultar el campo de grado según el nivel seleccionado
if (nivel.value === "ACADEMIA") {
gradoField.style.display = 'none';
} else {
gradoField.style.display = 'block';
}

// Scroll suave
setTimeout(() => {
wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
}, 100);
} else {
     wrapper.style.display = 'none';
}
}

sede.addEventListener('change', actualizarFormulario);
nivel.addEventListener('change', actualizarFormulario);

// Inicializar el estado del formulario
 actualizarFormulario();
});