document.addEventListener('DOMContentLoaded', () => {
    // 1. SELECTORES
    const selectorModalidad = document.getElementById('modalidadSelector');
    const secAcademia = document.getElementById('section-academia');
    const secColegio = document.getElementById('section-colegio');
    const footerActions = document.getElementById('footer-actions');

    const uniSelect = document.getElementById('universidadSelector');
    const turnoSelect = document.getElementById('turnoAcademiaSelector');
    const ciclosCont = document.getElementById('ciclos-container');
    const cronogramaCont = document.getElementById('cronograma-container');
    const cronogramaBody = document.getElementById('cronograma-body');

    // 2. LÓGICA DE DESPLIEGUE DE SECCIONES PRINCIPALES
    selectorModalidad.addEventListener('change', function() {
        // Ocultar todo por defecto al cambiar
        secAcademia.classList.add('hidden-section');
        secColegio.classList.add('hidden-section');
        footerActions.classList.add('hidden-section');

        // Resetear academia si se cambia de modalidad
        if(ciclosCont) ciclosCont.classList.add('hidden-section');
        if(cronogramaCont) cronogramaCont.classList.add('hidden-section');

        if (this.value === 'academia') {
            secAcademia.classList.remove('hidden-section');
        } else if (this.value === 'colegio') {
            secColegio.classList.remove('hidden-section');
            footerActions.classList.remove('hidden-section');
        }
    });

    // 3. LÓGICA DE GRADOS COLEGIO
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

    // 4. CONFIGURACIÓN DE HORARIOS ACADEMIA
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

        // Ocultar pasos siguientes al cambiar universidad
        ciclosCont.classList.add('hidden-section');
        cronogramaCont.classList.add('hidden-section');

        if (horarios[seleccion]) {
            const optMañana = new Option(`Mañana (${horarios[seleccion].mañana})`, "mañana");
            const optTarde = new Option(`Tarde (${horarios[seleccion].tarde})`, "tarde");
            turnoSelect.add(optMañana);
            turnoSelect.add(optTarde);
        }
    });

    // 5. MOSTRAR CICLOS (YA EXISTENTES EN HTML)
    turnoSelect.addEventListener('change', function() {
        ciclosCont.classList.remove('hidden-section');
    });

    // 6. EVENTO PARA RADIOS DE CICLOS (USANDO DELEGACIÓN DE EVENTOS)
    document.addEventListener('change', (e) => {
        if (e.target.name === 'ciclo_op') {
            const uniNombre = uniSelect.options[uniSelect.selectedIndex].text;
            generarCronograma(uniNombre);
        }
    });

    // 7. FUNCIÓN GENERAR CRONOGRAMA (SOLO INSERTA FILAS)
    function generarCronograma(uniNombre) {
        cronogramaCont.classList.remove('hidden-section');

        // Insertamos solo el contenido de la tabla para mantener el JS limpio
        cronogramaBody.innerHTML = `
            <tr><td>CUOTA 1 ${uniNombre}</td><td>31/03/2026</td><td>222.00</td><td>0.00</td><td>222.00</td></tr>
            <tr><td>CUOTA 2 ${uniNombre}</td><td>23/04/2026</td><td>300.00</td><td>0.00</td><td>300.00</td></tr>
            <tr><td>CUOTA 3 ${uniNombre}</td><td>23/05/2026</td><td>300.00</td><td>0.00</td><td>300.00</td></tr>
            <tr><td>CUOTA 4 ${uniNombre}</td><td>23/06/2026</td><td>260.00</td><td>0.00</td><td>260.00</td></tr>
            <tr class="total-row-bold">
                <td colspan="2" style="text-align:right">Totales</td>
                <td>1,082.00</td><td>0.00</td><td>1,082.00</td>
            </tr>
        `;

        footerActions.classList.remove('hidden-section');
    }
});
