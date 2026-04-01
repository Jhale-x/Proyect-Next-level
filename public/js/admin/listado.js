// Buscador dinámico de Alumnos
document.getElementById('searchAlumno')?.addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('.alumno-row');

    rows.forEach(row => {
        let text = row.querySelector('.nombre-completo').textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});

// Filtro de Curso para Personal
function filterByCurso(curso) {
    let rows = document.querySelectorAll('.personal-row');
    
    rows.forEach(row => {
        if (curso === 'todos') {
            row.style.display = '';
        } else {
            let userCurso = row.getAttribute('data-curso');
            row.style.display = (userCurso === curso) ? '' : 'none';
        }
    });
}

// Buscador dinámico de Personal
document.getElementById('searchPersonal')?.addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('.personal-row');

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});