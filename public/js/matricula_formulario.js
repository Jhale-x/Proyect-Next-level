// ======================================================
// API HELPER FUNCTIONS
// ======================================================
const API = {
    base: '/api/matricula',
    
    async get(endpoint, params = {}) {
        const url = new URL(this.base + endpoint, window.location.origin);
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
        
        try {
            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return await response.json();
        } catch (error) {
            console.error(`Error en GET ${endpoint}:`, error);
            return [];
        }
    },
    
    async post(endpoint, data) {
        try {
            const response = await fetch(this.base + endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.CSRF_TOKEN || document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            });
            return await response.json();
        } catch (error) {
            console.error('Error en POST:', error);
            return { success: false, error: error.message };
        }
    }
};

// ======================================================
// FUNCIONES PARA CARGAR DATOS DESDE LA BD
// ======================================================

async function cargarSelect(selectId, endpoint, textoDefault) {
    const select = document.getElementById(selectId);
    if (!select) return;
    
    select.disabled = true;
    select.innerHTML = `<option value="" disabled selected hidden>Cargando ${textoDefault}...</option>`;
    
    const datos = await API.get(endpoint);
    
    select.innerHTML = `<option value="" disabled selected hidden>Seleccionar ${textoDefault}</option>`;
    
    if (datos && datos.length > 0) {
        datos.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            let texto = item.nombre;
            if (item.hora_texto) texto += ` (${item.hora_texto})`;
            option.textContent = texto;
            select.appendChild(option);
        });
        select.disabled = false;
        console.log(`✅ ${textoDefault} cargados: ${datos.length} opciones`);
    } else {
        console.warn(`⚠️ No se recibieron ${textoDefault}`);
        select.disabled = false;
    }
}

// Cargar ciclos de academia
async function cargarCiclosAcademia() {
    const container = document.getElementById('ciclos-container-academia');
    if (!container) return;
    
    const sede = document.getElementById('sedeacademiaSelector')?.value;
    const entorno = document.getElementById('entornoacademiaSelector')?.value;
    const universidad = document.getElementById('universidadSelector')?.value;
    const tipoCiclo = document.getElementById('tipoCicloSelector')?.value;
    const turno = document.getElementById('turnoAcademiaSelector')?.value;
    
    console.log('Filtros para ciclos:', { sede, entorno, universidad, tipoCiclo, turno });
    
    if (!sede || !entorno || !universidad || !tipoCiclo || !turno) {
        console.log('Faltan filtros para cargar ciclos');
        return;
    }
    
    const filtros = {
        modalidad: 'academia',
        id_sede: sede,
        id_entorno: entorno,
        id_universidad: universidad,
        id_tipo_ciclo: tipoCiclo,
        id_turno: turno
    };
    
    container.innerHTML = '<div class="loading">Cargando ciclos...</div>';
    container.classList.remove('hidden-section');
    
    const ciclos = await API.get('/ciclos', filtros);
    
    container.innerHTML = '';
    
    if (ciclos && ciclos.length > 0) {
        const template = document.getElementById('template-ciclo');
        ciclos.forEach(ciclo => {
            const clone = template.content.cloneNode(true);
            const radio = clone.querySelector('.ciclo-radio');
            radio.value = ciclo.id;
            radio.name = 'ciclo_op';
            clone.querySelector('.nombre-ciclo').textContent = ciclo.nombre;
            clone.querySelector('.fechas-ciclo').textContent = `${ciclo.fecha_inicio} - ${ciclo.fecha_fin}`;
            container.appendChild(clone);
        });
        console.log(`✅ Ciclos cargados: ${ciclos.length} opciones`);
    } else {
        container.innerHTML = '<div class="no-data">No hay ciclos disponibles</div>';
    }
}

// ======================================================
// INICIALIZAR ACADEMIA - CADENA DE SELECTS
// ======================================================
function inicializarAcademia() {
    console.log('🎓 Inicializando Academia...');
    
    const sedeSelect = document.getElementById('sedeacademiaSelector');
    const entornoSelect = document.getElementById('entornoacademiaSelector');
    const universidadSelect = document.getElementById('universidadSelector');
    const tipoSelect = document.getElementById('tipoCicloSelector');
    const turnoSelect = document.getElementById('turnoAcademiaSelector');
    const ciclosContainer = document.getElementById('ciclos-container-academia');
    
    sedeSelect.disabled = false;
    entornoSelect.disabled = true;
    universidadSelect.disabled = true;
    tipoSelect.disabled = true;
    turnoSelect.disabled = true;
    if (ciclosContainer) ciclosContainer.classList.add('hidden-section');
    
    cargarSelect('sedeacademiaSelector', '/sedes', 'Sede');
    
    sedeSelect.addEventListener('change', async function() {
        if (this.value && this.value !== "") {
            entornoSelect.disabled = true;
            universidadSelect.disabled = true;
            tipoSelect.disabled = true;
            turnoSelect.disabled = true;
            if (ciclosContainer) ciclosContainer.classList.add('hidden-section');
            
            entornoSelect.innerHTML = '<option value="" disabled selected hidden>Seleccionar Entorno</option>';
            universidadSelect.innerHTML = '<option value="" disabled selected hidden>Universidad Objetivo</option>';
            tipoSelect.innerHTML = '<option value="" disabled selected hidden>Tipo de Ciclo</option>';
            turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
            
            await cargarSelect('entornoacademiaSelector', '/entornos', 'Entorno');
            entornoSelect.disabled = false;
        }
    });
    
    entornoSelect.addEventListener('change', async function() {
        if (this.value && this.value !== "") {
            universidadSelect.disabled = true;
            tipoSelect.disabled = true;
            turnoSelect.disabled = true;
            if (ciclosContainer) ciclosContainer.classList.add('hidden-section');
            
            tipoSelect.innerHTML = '<option value="" disabled selected hidden>Tipo de Ciclo</option>';
            turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
            
            await cargarSelect('universidadSelector', '/universidades', 'Universidad');
            universidadSelect.disabled = false;
        }
    });
    
    universidadSelect.addEventListener('change', async function() {
        if (this.value && this.value !== "") {
            tipoSelect.disabled = true;
            turnoSelect.disabled = true;
            if (ciclosContainer) ciclosContainer.classList.add('hidden-section');
            
            turnoSelect.innerHTML = '<option value="" disabled selected hidden>Turno de Estudio</option>';
            
            await cargarSelect('tipoCicloSelector', '/tipos-ciclo', 'Tipo de Ciclo');
            tipoSelect.disabled = false;
        }
    });
    
    tipoSelect.addEventListener('change', async function() {
        if (this.value && this.value !== "") {
            turnoSelect.disabled = true;
            if (ciclosContainer) ciclosContainer.classList.add('hidden-section');
            
            await cargarSelect('turnoAcademiaSelector', '/turnos', 'Turno');
            turnoSelect.disabled = false;
        }
    });
    
    turnoSelect.addEventListener('change', function() {
        if (this.value && this.value !== "") {
            cargarCiclosAcademia();
        }
    });
}

// ======================================================
// CARGAR CUOTAS AL SELECCIONAR CICLO
// ======================================================
async function cargarCuotas(cicloId) {
    const modalidad = document.getElementById('modalidadSelector')?.value;
    const bodyTarget = modalidad === 'colegio'
        ? document.getElementById('cronograma-body-colegio')
        : document.getElementById('cronograma-body');
    const container = modalidad === 'colegio'
        ? document.getElementById('cronograma-container-colegio')
        : document.getElementById('cronograma-container');
    
    if (!bodyTarget) return;
    
    bodyTarget.innerHTML = '<tr><td colspan="5">Cargando cuotas...</td></tr>';
    if (container) container.classList.remove('hidden-section');
    
    const cuotas = await API.get(`/cuotas/${cicloId}`);
    
    bodyTarget.innerHTML = '';
    const template = document.getElementById('template-fila-cronograma');
    let total = 0;
    
    if (cuotas && cuotas.length > 0) {
        cuotas.forEach(cuota => {
            const clone = template.content.cloneNode(true);
            clone.querySelector('.col-cuota').textContent = cuota.nombre;
            clone.querySelector('.col-vencimiento').textContent = cuota.fecha_vencimiento;
            clone.querySelector('.col-importe').textContent = cuota.monto.toFixed(2);
            clone.querySelector('.col-descuento').textContent = '0.00';
            clone.querySelector('.col-total').textContent = cuota.monto.toFixed(2);
            bodyTarget.appendChild(clone);
            total += cuota.monto;
        });
    } else {
        bodyTarget.innerHTML = '<tr><td colspan="5">No hay cuotas disponibles</td></tr>';
    }
    
    const totalSpan = modalidad === 'colegio'
        ? document.getElementById('cronograma-total-general-colegio')
        : document.getElementById('cronograma-total-general');
    
    if (totalSpan) totalSpan.textContent = total.toFixed(2);
}

// ======================================================
// ACTUALIZAR TOTAL CON DESCUENTO
// ======================================================
function actualizarTotalConDescuento() {
    const modalidad = document.getElementById('modalidadSelector')?.value;
    const bodyTarget = modalidad === 'colegio'
        ? document.getElementById('cronograma-body-colegio')
        : document.getElementById('cronograma-body');
    
    const celdasImporte = bodyTarget.querySelectorAll('.col-importe');
    let totalOriginal = 0;
    celdasImporte.forEach(celda => {
        totalOriginal += parseFloat(celda.textContent) || 0;
    });
    
    const totalSpan = modalidad === 'colegio'
        ? document.getElementById('cronograma-total-general-colegio')
        : document.getElementById('cronograma-total-general');
    
    const radioPago = document.querySelector(`input[name="${modalidad === 'colegio' ? 'p_col' : 'p'}"]:checked`);
    
    if (radioPago && radioPago.value === 'co') {
        const descuento = totalOriginal * 0.05;
        const neto = totalOriginal - descuento;
        if (totalSpan) totalSpan.textContent = neto.toFixed(2);
    } else {
        if (totalSpan) totalSpan.textContent = totalOriginal.toFixed(2);
    }
}

// ======================================================
// ACTUALIZAR RESUMEN (Paso 2 → Paso 3)
// ======================================================
function actualizarResumen() {
    const modalidad = document.getElementById('modalidadSelector').value;
    const cicloRadio = document.querySelector('input[name="ciclo_op"]:checked');
    const fechasCiclo = cicloRadio?.closest('.ciclo-card')?.querySelector('.fechas-ciclo')?.textContent || "";
    
    document.getElementById('res-modalidad').textContent = modalidad.toUpperCase();
    
    if (modalidad === 'colegio') {
        const gradoTexto = document.getElementById('grado_escolar')?.options[document.getElementById('grado_escolar').selectedIndex]?.text || '';
        const seccionTexto = document.getElementById('seccion_escolar')?.options[document.getElementById('seccion_escolar').selectedIndex]?.text || '';
        const eleccionTexto = document.getElementById('nivel_escolar')?.options[document.getElementById('nivel_escolar').selectedIndex]?.text || '';

        document.getElementById('res-eleccion').textContent = eleccionTexto.toUpperCase();
        document.getElementById('res-ciclo').textContent = `${gradoTexto.toUpperCase()} - ${seccionTexto.toUpperCase()}`;
        document.getElementById('res-turno').textContent = `${document.getElementById('turno_escolar')?.value.toUpperCase()} | ${fechasCiclo}`;
        document.getElementById('res-sede').textContent = document.getElementById('sedecolegioSelector')?.value.toUpperCase() || '';
        document.getElementById('res-entorno').textContent = document.getElementById('entornocolegioSelector')?.value.toUpperCase() || '';

        document.getElementById('res-alumno-full').textContent = `${document.querySelector('input[name="col_nombres"]')?.value || ''} ${document.querySelector('input[name="col_ape_paterno"]')?.value || ''} ${document.querySelector('input[name="col_ape_materno"]')?.value || ''}`.toUpperCase();
        document.getElementById('res-alumno-dni').textContent = document.querySelector('input[name="col_dni"]')?.value || '';
        document.getElementById('res-alumno-email').textContent = (document.querySelector('input[name="col_email"]')?.value || '').toUpperCase();
        document.getElementById('res-alumno-celular').textContent = "NO REGISTRADO";
        document.getElementById('res-alumno-extra').textContent = `${document.querySelector('select[name="col_genero"]')?.value || ''} | NAC: ${document.querySelector('input[name="col_fecha_nac"]')?.value || ''}`.toUpperCase();

        document.getElementById('res-apo-nombre').textContent = `${document.querySelector('input[name="apo_nombres"]')?.value || ''} ${document.querySelector('input[name="apo_ape_paterno"]')?.value || ''}`.toUpperCase();
        document.getElementById('res-apo-dni').textContent = document.querySelector('input[name="apo_dni"]')?.value || '';
        document.getElementById('res-apo-cel').textContent = document.querySelector('input[name="apo_celular"]')?.value || '';
        document.getElementById('res-apo-nac').textContent = document.querySelector('input[name="apo_fecha_nac"]')?.value || '';
        if (document.getElementById('res-card-apoderado')) {
            document.getElementById('res-card-apoderado').style.display = 'block';
        }
    } else {
        const eleccionAcaTexto = document.getElementById('universidadSelector')?.options[document.getElementById('universidadSelector').selectedIndex]?.text || '';
        const cicloTxt = cicloRadio?.closest('.ciclo-card')?.querySelector('.nombre-ciclo')?.textContent || "-";

        document.getElementById('res-eleccion').textContent = eleccionAcaTexto.toUpperCase();
        document.getElementById('res-ciclo').textContent = cicloTxt.toUpperCase();
        document.getElementById('res-turno').textContent = `${document.getElementById('turnoAcademiaSelector')?.value.toUpperCase()} | ${fechasCiclo}`;
        document.getElementById('res-sede').textContent = document.getElementById('sedeacademiaSelector')?.value.toUpperCase() || '';
        document.getElementById('res-entorno').textContent = document.getElementById('entornoacademiaSelector')?.value.toUpperCase() || '';

        document.getElementById('res-alumno-full').textContent = `${document.querySelector('input[name="aca_nombres"]')?.value || ''} ${document.querySelector('input[name="aca_ape_paterno"]')?.value || ''} ${document.querySelector('input[name="aca_ape_materno"]')?.value || ''}`.toUpperCase();
        document.getElementById('res-alumno-dni').textContent = document.querySelector('input[name="aca_dni"]')?.value || '';
        document.getElementById('res-alumno-email').textContent = (document.querySelector('input[name="aca_email"]')?.value || '').toUpperCase();
        document.getElementById('res-alumno-celular').textContent = document.querySelector('input[name="aca_celular"]')?.value || '';
        document.getElementById('res-alumno-extra').textContent = `${document.querySelector('select[name="aca_genero"]')?.value || ''} | NAC: ${document.querySelector('input[name="aca_fecha_nac"]')?.value || ''}`.toUpperCase();

        const esMayor = document.querySelector('input[name="es_mayor"]:checked')?.value === 'si';
        if (esMayor) {
            if (document.getElementById('res-card-apoderado')) {
                document.getElementById('res-card-apoderado').style.display = 'none';
            }
        } else {
            if (document.getElementById('res-card-apoderado')) {
                document.getElementById('res-apo-nombre').textContent = `${document.querySelector('input[name="aca_apo_nombres"]')?.value || ''} ${document.querySelector('input[name="aca_apo_ape_paterno"]')?.value || ''}`.toUpperCase();
                document.getElementById('res-apo-dni').textContent = document.querySelector('input[name="aca_apo_dni"]')?.value || '';
                document.getElementById('res-apo-cel').textContent = document.querySelector('input[name="aca_apo_celular"]')?.value || '';
                document.getElementById('res-apo-nac').textContent = document.querySelector('input[name="aca_apo_fecha_nac"]')?.value || '';
                document.getElementById('res-card-apoderado').style.display = 'block';
            }
        }
    }
    
    const tablaOrigen = modalidad === 'colegio' 
        ? document.getElementById('cronograma-body-colegio')
        : document.getElementById('cronograma-body');
    const resCronogramaBody = document.getElementById('res-cronograma-body-final');
    const templateFilaRes = document.getElementById('template-fila-resumen');
    
    if (resCronogramaBody && tablaOrigen) {
        while (resCronogramaBody.firstChild) resCronogramaBody.removeChild(resCronogramaBody.firstChild);
        tablaOrigen.querySelectorAll('tr').forEach(filaOriginal => {
            const instancia = templateFilaRes.content.cloneNode(true);
            instancia.querySelector('.res-col-cuota').textContent = filaOriginal.querySelector('.col-cuota')?.textContent || '';
            instancia.querySelector('.res-col-vencimiento').textContent = filaOriginal.querySelector('.col-vencimiento')?.textContent || '';
            instancia.querySelector('.res-col-descuento').textContent = "S/ " + (filaOriginal.querySelector('.col-descuento')?.textContent || '0');
            instancia.querySelector('.res-col-total').textContent = "S/ " + (filaOriginal.querySelector('.col-total')?.textContent || '0');
            resCronogramaBody.appendChild(instancia);
        });
    }
    
    const totalGeneral = modalidad === 'colegio' 
        ? document.getElementById('cronograma-total-general-colegio')?.textContent 
        : document.getElementById('cronograma-total-general')?.textContent;
    
    if (document.getElementById('res-pago-total')) {
        document.getElementById('res-pago-total').textContent = totalGeneral || '0';
    }
}

// ======================================================
// GUARDAR MATRÍCULA Y AVANZAR AL PASO 4
// ======================================================
async function guardarMatricula() {
    const modalidad = document.getElementById('modalidadSelector').value;
    const cicloRadio = document.querySelector('input[name="ciclo_op"]:checked');
    
    if (!cicloRadio) {
        alert('Seleccione un ciclo');
        return false;
    }
    
    if (!document.getElementById('check-terminos')?.checked || !document.getElementById('check-politicas')?.checked) {
        alert('Debe aceptar los términos y condiciones');
        return false;
    }
    
    let datos = {
        modalidad: modalidad,
        id_ciclo: cicloRadio.value,
        modalidad_pago: document.querySelector(`input[name="${modalidad === 'colegio' ? 'p_col' : 'p'}"]:checked`)?.value || 'c',
        monto_total: parseFloat(document.getElementById(modalidad === 'colegio' ? 'cronograma-total-general-colegio' : 'cronograma-total-general')?.textContent || 0),
        terminos_aceptados: 1,
        politicas_aceptadas: 1,
        es_mayor: document.querySelector('input[name="es_mayor"]:checked')?.value || 'no'
    };
    
    if (modalidad === 'colegio') {
        datos.alumno_nombres = document.querySelector('input[name="col_nombres"]')?.value;
        datos.alumno_ape_paterno = document.querySelector('input[name="col_ape_paterno"]')?.value;
        datos.alumno_ape_materno = document.querySelector('input[name="col_ape_materno"]')?.value;
        datos.alumno_dni = document.querySelector('input[name="col_dni"]')?.value;
        datos.alumno_email = document.querySelector('input[name="col_email"]')?.value;
        datos.alumno_genero = document.querySelector('select[name="col_genero"]')?.value;
        datos.alumno_fecha_nac = document.querySelector('input[name="col_fecha_nac"]')?.value;
        datos.alumno_celular = document.querySelector('input[name="col_celular"]')?.value;
        
        datos.apoderado_nombres = document.querySelector('input[name="apo_nombres"]')?.value;
        datos.apoderado_ape_paterno = document.querySelector('input[name="apo_ape_paterno"]')?.value;
        datos.apoderado_ape_materno = document.querySelector('input[name="apo_ape_materno"]')?.value;
        datos.apoderado_dni = document.querySelector('input[name="apo_dni"]')?.value;
        datos.apoderado_email = document.querySelector('input[name="apo_email"]')?.value;
        datos.apoderado_celular = document.querySelector('input[name="apo_celular"]')?.value;
        datos.apoderado_fecha_nac = document.querySelector('input[name="apo_fecha_nac"]')?.value;
    } else {
        datos.alumno_nombres = document.querySelector('input[name="aca_nombres"]')?.value;
        datos.alumno_ape_paterno = document.querySelector('input[name="aca_ape_paterno"]')?.value;
        datos.alumno_ape_materno = document.querySelector('input[name="aca_ape_materno"]')?.value;
        datos.alumno_dni = document.querySelector('input[name="aca_dni"]')?.value;
        datos.alumno_email = document.querySelector('input[name="aca_email"]')?.value;
        datos.alumno_genero = document.querySelector('select[name="aca_genero"]')?.value;
        datos.alumno_fecha_nac = document.querySelector('input[name="aca_fecha_nac"]')?.value;
        datos.alumno_celular = document.querySelector('input[name="aca_celular"]')?.value;
        
        datos.apoderado_nombres = document.querySelector('input[name="aca_apo_nombres"]')?.value;
        datos.apoderado_ape_paterno = document.querySelector('input[name="aca_apo_ape_paterno"]')?.value;
        datos.apoderado_ape_materno = document.querySelector('input[name="aca_apo_ape_materno"]')?.value;
        datos.apoderado_dni = document.querySelector('input[name="aca_apo_dni"]')?.value;
        datos.apoderado_email = document.querySelector('input[name="aca_apo_email"]')?.value;
        datos.apoderado_celular = document.querySelector('input[name="aca_apo_celular"]')?.value;
        datos.apoderado_fecha_nac = document.querySelector('input[name="aca_apo_fecha_nac"]')?.value;
    }
    
    try {
        const response = await API.post('/guardar', datos);
        
        if (response.success) {
            // Mostrar el código generado en el paso 4
            document.getElementById('codigo-generado').textContent = response.codigo;
            
            // Copiar datos al paso 4
            document.getElementById('final-modalidad').textContent = document.getElementById('res-modalidad')?.textContent || '';
            document.getElementById('final-eleccion').textContent = document.getElementById('res-eleccion')?.textContent || '';
            document.getElementById('final-ciclo').textContent = document.getElementById('res-ciclo')?.textContent || '';
            document.getElementById('final-sede').textContent = document.getElementById('res-sede')?.textContent || '';
            document.getElementById('final-entorno').textContent = document.getElementById('res-entorno')?.textContent || '';
            document.getElementById('final-turno').textContent = document.getElementById('res-turno')?.textContent || '';
            
            // ==== AVANZAR AL PASO 4 (FINAL) ====
            // Ocultar paso 3
            const step3Resumen = document.getElementById('step-3-resumen');
            if (step3Resumen) step3Resumen.classList.add('hidden-section');
            
            // Mostrar paso 4
            const step4Final = document.getElementById('step-4-final');
            if (step4Final) step4Final.classList.remove('hidden-section');
            
            // Ocultar botones de navegación del paso 2
            const navStep2 = document.getElementById('nav-step-2');
            if (navStep2) navStep2.classList.add('hidden-section');
            
            // Mostrar botones del paso 4
            const step4Nav = document.getElementById('step4-navigation-actions');
            if (step4Nav) step4Nav.classList.remove('hidden-section');
            
            // Actualizar indicadores
            const step3Indicator = document.getElementById('step-3-indicator');
            const step4Indicator = document.getElementById('step-4-indicator');
            if (step3Indicator) step3Indicator.classList.remove('active');
            if (step4Indicator) step4Indicator.classList.add('active');
            
            // Scroll al inicio
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            return true;
        } else {
            alert(response.message || response.error || 'Error al guardar');
            return false;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la matrícula');
        return false;
    }
}

// ======================================================
// INICIALIZACIÓN PRINCIPAL
// ======================================================
function inicializarSistema() {
    console.log('🚀 Inicializando sistema...');
    
    const modalidadSelect = document.getElementById('modalidadSelector');
    if (modalidadSelect) {
        modalidadSelect.addEventListener('change', function() {
            const modalidad = this.value;
            console.log('Modalidad seleccionada:', modalidad);
            
            const sectionColegio = document.getElementById('section-colegio');
            const sectionAcademia = document.getElementById('section-academia');
            const footerActions = document.getElementById('footer-actions');
            
            if (sectionColegio) sectionColegio.classList.add('hidden-section');
            if (sectionAcademia) sectionAcademia.classList.add('hidden-section');
            if (footerActions) footerActions.classList.add('hidden-section');
            
            if (modalidad === 'colegio') {
                if (sectionColegio) sectionColegio.classList.remove('hidden-section');
                if (footerActions) footerActions.classList.remove('hidden-section');
                console.log('🏫 Modulo Colegio seleccionado');
            } else if (modalidad === 'academia') {
                if (sectionAcademia) sectionAcademia.classList.remove('hidden-section');
                if (footerActions) footerActions.classList.remove('hidden-section');
                console.log('🎓 Modulo Academia seleccionado');
                inicializarAcademia();
            }
        });
    }
}

// ======================================================
// BOTÓN DE NAVEGACIÓN - PASO 1 A PASO 2
// ======================================================
function inicializarBotonContinuar() {
    const btnContinuar = document.querySelector('.btn-premium-next');
    if (btnContinuar) {
        const nuevoBtn = btnContinuar.cloneNode(true);
        btnContinuar.parentNode.replaceChild(nuevoBtn, btnContinuar);
        
        nuevoBtn.addEventListener('click', function() {
            const modalidad = document.getElementById('modalidadSelector')?.value;
            if (!modalidad) {
                alert('Seleccione una modalidad');
                return;
            }
            
            document.getElementById('welcome-card')?.classList.add('hidden-section');
            document.getElementById('section-colegio')?.classList.add('hidden-section');
            document.getElementById('section-academia')?.classList.add('hidden-section');
            document.getElementById('footer-actions')?.classList.add('hidden-section');
            
            const navStep2 = document.getElementById('nav-step-2');
            if (navStep2) {
                navStep2.classList.remove('hidden-section');
                navStep2.classList.add('step2-active');
            }
            
            if (modalidad === 'colegio') {
                document.getElementById('step-2-colegio')?.classList.remove('hidden-section');
            } else {
                document.getElementById('step-2-academia')?.classList.remove('hidden-section');
            }
            
            document.getElementById('step-1-indicator')?.classList.remove('active');
            document.getElementById('step-2-indicator')?.classList.add('active');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        console.log('✅ Botón Continuar inicializado');
    }
}

// ======================================================
// BOTÓN DE NAVEGACIÓN - PASO 2 A PASO 3
// ======================================================
function inicializarBotonPaso2() {
    const btnPaso2 = document.getElementById('btn-finalizar-matricula');
    
    if (btnPaso2) {
        const nuevoBtn = btnPaso2.cloneNode(true);
        btnPaso2.parentNode.replaceChild(nuevoBtn, btnPaso2);
        
        nuevoBtn.addEventListener('click', async function() {
            console.log('Botón paso 2 clickeado');
            
            const step3Resumen = document.getElementById('step-3-resumen');
            
            if (step3Resumen && !step3Resumen.classList.contains('hidden-section')) {
                nuevoBtn.disabled = true;
                nuevoBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> PROCESANDO...';
                
                const exito = await guardarMatricula();
                
                if (!exito) {
                    nuevoBtn.disabled = false;
                    nuevoBtn.innerHTML = 'MATRICULARSE <i class="fa-solid fa-check"></i>';
                }
                return;
            }
            
            const cicloRadio = document.querySelector('input[name="ciclo_op"]:checked');
            if (!cicloRadio) {
                alert('Debe seleccionar un ciclo');
                return;
            }
            
            const modalidad = document.getElementById('modalidadSelector').value;
            const container = modalidad === 'colegio' 
                ? document.getElementById('step-2-colegio')
                : document.getElementById('step-2-academia');
            
            let esValido = true;
            container.querySelectorAll('input[required], select[required]').forEach(input => {
                if (!input.closest('.hidden-section') && (!input.value || !input.value.trim())) {
                    esValido = false;
                }
            });
            
            if (modalidad === 'academia') {
                const esMayorChecked = document.querySelector('input[name="es_mayor"]:checked');
                if (!esMayorChecked) {
                    esValido = false;
                }
            }
            
            if (!esValido) {
                alert('Complete todos los campos requeridos');
                return;
            }
            
            actualizarResumen();
            
            nuevoBtn.innerHTML = 'MATRICULARSE <i class="fa-solid fa-check"></i>';
            
            document.getElementById('step-2-colegio')?.classList.add('hidden-section');
            document.getElementById('step-2-academia')?.classList.add('hidden-section');
            if (step3Resumen) step3Resumen.classList.remove('hidden-section');
            
            document.getElementById('step-2-indicator')?.classList.remove('active');
            document.getElementById('step-3-indicator')?.classList.add('active');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        console.log('✅ Botón paso 2 inicializado');
    } else {
        console.error('❌ No se encontró el botón #btn-finalizar-matricula');
    }
}

// ======================================================
// BOTÓN REGRESAR
// ======================================================
function inicializarBotonRegresar() {
    const btnRegresar = document.querySelector('.btn-premium-prev');
    if (btnRegresar) {
        const nuevoBtn = btnRegresar.cloneNode(true);
        btnRegresar.parentNode.replaceChild(nuevoBtn, btnRegresar);
        
        nuevoBtn.addEventListener('click', function() {
            const step3Resumen = document.getElementById('step-3-resumen');
            const navStep2 = document.getElementById('nav-step-2');
            const btnPaso2 = document.getElementById('btn-finalizar-matricula');
            
            if (step3Resumen && !step3Resumen.classList.contains('hidden-section')) {
                step3Resumen.classList.add('hidden-section');
                const modalidad = document.getElementById('modalidadSelector')?.value;
                if (modalidad === 'colegio') {
                    document.getElementById('step-2-colegio')?.classList.remove('hidden-section');
                } else {
                    document.getElementById('step-2-academia')?.classList.remove('hidden-section');
                }
                if (navStep2) navStep2.classList.add('step2-active');
                if (btnPaso2) btnPaso2.innerHTML = 'Continuar Proceso <i class="fa-solid fa-arrow-right-long"></i>';
                document.getElementById('step-3-indicator')?.classList.remove('active');
                document.getElementById('step-2-indicator')?.classList.add('active');
            } else {
                document.getElementById('step-2-colegio')?.classList.add('hidden-section');
                document.getElementById('step-2-academia')?.classList.add('hidden-section');
                if (navStep2) {
                    navStep2.classList.remove('step2-active');
                    navStep2.classList.add('hidden-section');
                }
                document.getElementById('welcome-card')?.classList.remove('hidden-section');
                document.getElementById('step-2-indicator')?.classList.remove('active');
                document.getElementById('step-1-indicator')?.classList.add('active');
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        console.log('✅ Botón Regresar inicializado');
    }
}

// ======================================================
// EVENTOS GLOBALES
// ======================================================
document.addEventListener('change', async (e) => {
    if (e.target.name === 'ciclo_op') {
        await cargarCuotas(e.target.value);
    }
    
    if (e.target.name === 'p' || e.target.name === 'p_col') {
        actualizarTotalConDescuento();
    }
    
    if (e.target.name === 'es_mayor') {
        const seccionApoderadoAca = document.getElementById('seccion-apoderado-academia');
        const seccionApoderadoCol = document.getElementById('seccion-apoderado-colegio');
        const debeOcultar = e.target.value === 'si';
        if (seccionApoderadoAca) seccionApoderadoAca.classList.toggle('hidden-section', debeOcultar);
        if (seccionApoderadoCol) seccionApoderadoCol.classList.toggle('hidden-section', debeOcultar);
    }
});

document.querySelectorAll('input[name*="dni"], input[name*="celular"]').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

function validarChecksPaso3() {
    const step3Resumen = document.getElementById('step-3-resumen');
    if (step3Resumen && !step3Resumen.classList.contains('hidden-section')) {
        const terminos = document.getElementById('check-terminos')?.checked;
        const politicas = document.getElementById('check-politicas')?.checked;
        const btnPaso2 = document.getElementById('btn-finalizar-matricula');
        if (btnPaso2) {
            btnPaso2.disabled = !(terminos && politicas);
        }
    }
}

document.getElementById('check-terminos')?.addEventListener('change', validarChecksPaso3);
document.getElementById('check-politicas')?.addEventListener('change', validarChecksPaso3);

// ======================================================
// INICIAR SISTEMA
// ======================================================
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM cargado, iniciando sistema...');
    inicializarSistema();
    inicializarBotonContinuar();
    inicializarBotonPaso2();
    inicializarBotonRegresar();
    console.log('Sistema de matrícula listo');
});