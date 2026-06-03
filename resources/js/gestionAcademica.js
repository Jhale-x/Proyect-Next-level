// resources/js/gestionAcademica.js

/**
 * FunciÃ³n para entrar a la vista de detalle de un curso
 */
window.entrarAlCurso = function(nombre, docente) {
    const vistaPrincipal = document.getElementById('vista-principal');
    const vistaCurso = document.getElementById('vista-curso');

    // Inyectamos los datos en el header del curso
    document.getElementById('det-titulo').innerText = nombre;
    document.getElementById('det-profe').innerText = docente;

    // Intercambio de vistas con animaciÃ³n simple
    vistaPrincipal.classList.add('d-none');
    vistaCurso.classList.remove('d-none');

    // Scroll al inicio suave
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

/**
 * FunciÃ³n para regresar al listado general
 */
window.regresar = function() {
    document.getElementById('vista-curso').classList.add('d-none');
    document.getElementById('vista-principal').classList.remove('d-none');
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

/**
 * Manejador de pestaÃ±as de Bimestres
 */
window.cambiarBimestre = function(numero, elemento) {
    // Quitar clase activa de todos los botones en este grupo
    const botones = elemento.closest('.nav-pills').querySelectorAll('.nav-link');
    botones.forEach(btn => btn.classList.remove('active'));

    // Agregar clase activa al presionado
    elemento.classList.add('active');

    console.log("Cambiando al Bimestre: " + numero);
    // AquÃ­ podrÃ­as agregar una peticiÃ³n AJAX para traer notas reales
};