document.addEventListener('DOMContentLoaded', () => {
    const selectorModalidad = document.getElementById('modalidadSelector');
    const secAcademia = document.getElementById('section-academia');
    const secColegio = document.getElementById('section-colegio');
    const footerActions = document.getElementById('footer-actions');

    selectorModalidad.addEventListener('change', function() {
        secAcademia.classList.add('hidden-section');
        secColegio.classList.add('hidden-section');
        footerActions.classList.remove('hidden-section');

        if (this.value === 'academia') secAcademia.classList.remove('hidden-section');
        else if (this.value === 'colegio') secColegio.classList.remove('hidden-section');
    });

    const nivelSelect = document.getElementById('nivel_escolar');
    const gradoSelect = document.getElementById('grado_escolar');

    nivelSelect.addEventListener('change', function() {
        gradoSelect.innerHTML = '<option value="" disabled selected hidden>Grado Correspondiente</option>';
        const maxGrado = (this.value === 'primaria') ? 6 : 5;
        for (let i = 1; i <= maxGrado; i++) {
            const option = document.createElement('option');
            option.value = i;
            let suf = (i === 1 || i === 3) ? "ero" : (i === 2) ? "do" : "to";
            option.textContent = i + suf;
            gradoSelect.appendChild(option);
        }
    });

    const uniSelect = document.getElementById('universidadSelector');
    const turnoSelect = document.getElementById('turnoAcademiaSelector');

    const horarios = {
        unu: { mañana: "7:30 AM - 1:00 PM", tarde: "3:00 PM - 8:00 PM" },
        unia: { mañana: "8:00 AM - 1:30 PM", tarde: "3:30 PM - 8:30 PM" },
        san_marcos: { mañana: "8:30 AM - 2:00 PM", tarde: "4:00 PM - 9:00 PM" },
        uni: { mañana: "9:00 AM - 2:30 PM", tarde: "4:30 PM - 9:30 PM" },
        catolica: { mañana: "9:30 AM - 3:00 PM", tarde: "5:00 PM - 10:00 PM" }
    };

    uniSelect.addEventListener('change', function() {
        const seleccion = this.value;
        turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';

        if (horarios[seleccion]) {
            const optMañana = document.createElement('option');
            optMañana.value = "mañana";
            optMañana.textContent = `Mañana (${horarios[seleccion].mañana})`;
            turnoSelect.appendChild(optMañana);

            const optTarde = document.createElement('option');
            optTarde.value = "tarde";
            optTarde.textContent = `Tarde (${horarios[seleccion].tarde})`;
            turnoSelect.appendChild(optTarde);
        }
    });
});
