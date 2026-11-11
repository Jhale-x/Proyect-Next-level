// ======================================================
// FORMULARIO DE MATRÍCULA (4 pasos)
// El servidor calcula el monto y vuelve a validar todo.
// ======================================================
(function () {
    const CFG = window.MATRICULA || {};
    const form = document.getElementById('mfForm');
    if (!form) return;

    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));
    const campo = (name) => form.elements[name];
    const valor = (name) => {
        const el = campo(name);
        if (!el) return '';
        return (el instanceof RadioNodeList ? el.value : el.value || '').trim();
    };
    const soles = (n) => 'S/ ' + Number(n || 0).toFixed(2);
    const textoSelect = (id) => {
        const s = document.getElementById(id);
        return s && s.value ? s.options[s.selectedIndex].text : '';
    };
    const fechaDMY = (iso) => iso ? iso.split('-').reverse().join('/') : '—';
    const edad = (iso) => {
        if (!iso) return null;
        const n = new Date(iso + 'T00:00:00'), h = new Date();
        let e = h.getFullYear() - n.getFullYear();
        const m = h.getMonth() - n.getMonth();
        if (m < 0 || (m === 0 && h.getDate() < n.getDate())) e--;
        return e;
    };

    let pasoActual = 1;
    let pasoMaximo = 1;
    let ciclo = null;
    let pedidoCiclos = 0;

    const FILTROS = {
        academia: ['id_sede', 'id_entorno', 'id_universidad', 'id_tipo_ciclo', 'id_turno'],
        colegio: ['id_sede', 'id_entorno', 'id_nivel', 'grado', 'seccion', 'id_turno'],
    };

    // ======================================================
    // NAVEGACIÓN
    // ======================================================
    function irA(paso) {
        if (paso > pasoActual) {
            for (let p = pasoActual; p < paso; p++) {
                const error = validarPaso(p);
                if (error) {
                    avisar(error.mensaje, error.campo);
                    return;
                }
            }
        }
        if (paso === 3) armarRevision();

        pasoActual = paso;
        pasoMaximo = Math.max(pasoMaximo, paso);
        $$('.mf-step').forEach(s => { s.hidden = Number(s.dataset.step) !== paso; });
        $$('#mfStepper li').forEach(li => {
            const n = Number(li.dataset.step);
            li.classList.toggle('is-active', n === paso);
            li.classList.toggle('is-done', n < paso && paso < 4);
        });
        $('#mfLayout').classList.toggle('is-final', paso === 4);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    form.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-ir]');
        if (btn) irA(Number(btn.dataset.ir));
    });
    $('#mfStepper').addEventListener('click', (e) => {
        const li = e.target.closest('li.is-done');
        if (li) irA(Number(li.dataset.step));
    });

    function avisar(mensaje, el) {
        if (el) {
            const objetivo = el.closest('.mf-pills') || el;
            objetivo.classList.add('is-invalid');
            (el.focus ? el : objetivo).focus?.();
            objetivo.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        alert(mensaje);
    }

    form.addEventListener('input', (e) => e.target.classList.remove('is-invalid'));
    form.addEventListener('change', (e) => {
        e.target.classList.remove('is-invalid');
        e.target.closest('.mf-pills')?.classList.remove('is-invalid');
    });

    // ======================================================
    // PASO 1: PROGRAMA
    // ======================================================
    $$('input[name="modalidad"]').forEach(r => r.addEventListener('change', () => {
        const modalidad = valor('modalidad');
        $('#mfPrograma').hidden = false;
        $$('[data-solo]').forEach(el => {
            const visible = el.dataset.solo === modalidad;
            el.hidden = !visible;
            const sel = $('select', el);
            if (sel) sel.required = visible;
        });

        // Paso 2 según modalidad
        $('#mfMayorEdad').hidden = modalidad !== 'academia';
        if (modalidad === 'colegio') campo('es_mayor').value = 'no';
        $('#celularOpcional').hidden = modalidad === 'academia';
        campo('alumno_celular').required = modalidad === 'academia';
        actualizarApoderado();

        cargarCiclos();
        actualizarResumen();
    }));

    ['id_sede', 'id_entorno', 'id_universidad', 'id_tipo_ciclo', 'grado', 'seccion', 'id_turno']
        .forEach(id => document.getElementById(id).addEventListener('change', () => { cargarCiclos(); actualizarResumen(); }));

    document.getElementById('id_nivel').addEventListener('change', async function () {
        const grado = document.getElementById('grado');
        grado.disabled = true;
        grado.innerHTML = '<option value="">Cargando...</option>';
        cargarCiclos();
        actualizarResumen();
        if (!this.value) {
            grado.innerHTML = '<option value="">Primero elige el nivel</option>';
            return;
        }
        try {
            const grados = await fetch(`/api/matricula/grados/${encodeURIComponent(this.value)}`, { headers: { Accept: 'application/json' } }).then(r => r.json());
            grado.innerHTML = '<option value="">Selecciona</option>';
            grados.forEach(g => grado.add(new Option(g.nombre, g.id)));
            grado.disabled = false;
        } catch {
            grado.innerHTML = '<option value="">No se pudo cargar</option>';
        }
    });

    async function cargarCiclos() {
        const cont = $('#mfCiclos');
        const modalidad = valor('modalidad');
        ciclo = null;
        actualizarResumen();
        if (!modalidad) return;

        const faltan = FILTROS[modalidad].filter(f => !valor(f));
        if (faltan.length) {
            cont.innerHTML = '<p class="mf-empty"><i class="fa-regular fa-calendar"></i> Completa las opciones de arriba para ver los ciclos y sus precios.</p>';
            return;
        }

        const params = new URLSearchParams({ modalidad });
        FILTROS[modalidad].filter(f => f.startsWith('id_')).forEach(f => params.set(f, valor(f)));

        const pedido = ++pedidoCiclos;
        cont.innerHTML = '<p class="mf-empty"><i class="fa-solid fa-spinner fa-spin"></i> Buscando ciclos disponibles...</p>';

        try {
            const ciclos = await fetch(`/api/matricula/ciclos?${params}`, { headers: { Accept: 'application/json' } }).then(r => r.json());
            if (pedido !== pedidoCiclos) return; // llegó una respuesta más nueva

            if (!Array.isArray(ciclos) || !ciclos.length) {
                cont.innerHTML = '<p class="mf-empty"><i class="fa-regular fa-face-frown"></i> No hay ciclos disponibles para esta combinación. Prueba con otro turno o tipo de ciclo.</p>';
                return;
            }

            cont.innerHTML = '';
            const tpl = $('#tplCiclo');
            ciclos.forEach(c => {
                const nodo = tpl.content.cloneNode(true);
                const radio = $('input', nodo);
                radio.value = c.id;
                $('.mf-ciclo__nombre', nodo).textContent = c.nombre;
                $('.mf-ciclo__fechas', nodo).textContent = `${c.fecha_inicio} – ${c.fecha_fin}`;
                $('.mf-ciclo__antes', nodo).textContent = soles(c.importe);
                $('.mf-ciclo__total', nodo).textContent = soles(c.monto);
                radio.addEventListener('change', () => { ciclo = c; actualizarResumen(); });
                cont.appendChild(nodo);
            });
            if (ciclos.length === 1) {
                $('input', cont).checked = true;
                ciclo = ciclos[0];
                actualizarResumen();
            }
        } catch {
            if (pedido === pedidoCiclos) cont.innerHTML = '<p class="mf-empty">No pudimos cargar los ciclos. Inténtalo nuevamente.</p>';
        }
    }

    // ======================================================
    // PASO 2: DATOS
    // ======================================================
    const PREFIJO = { estudiante: 'alumno', apoderado: 'apoderado' };
    const CAMPOS_VERIFICADOS = { nombres: 'nombres', ape_paterno: 'apellido_paterno', ape_materno: 'apellido_materno' };

    /** Coloca los datos del DNI verificado en el estudiante o en el apoderado. */
    function aplicarVerificado() {
        const quien = valor('verificado_es') || 'estudiante';
        const v = CFG.verificado || {};
        Object.values(PREFIJO).forEach(pre => {
            const esVerificado = PREFIJO[quien] === pre;
            Object.entries(CAMPOS_VERIFICADOS).forEach(([c, k]) => {
                const el = campo(`${pre}_${c}`);
                if (esVerificado) el.value = titulo(v[k] || '');
                else if (el.readOnly) el.value = '';
                el.readOnly = esVerificado;
            });
            const dni = campo(`${pre}_dni`);
            if (esVerificado) dni.value = v.dni || '';
            else if (dni.readOnly) dni.value = '';
            dni.readOnly = esVerificado;
        });
    }

    function titulo(t) {
        return t.toLowerCase().replace(/(^|\s)\S/g, s => s.toUpperCase());
    }

    function requiereApoderado() {
        return valor('modalidad') === 'colegio' || valor('es_mayor') !== 'si';
    }

    function actualizarApoderado() {
        const requiere = requiereApoderado();
        const bloque = $('#mfApoderado');
        bloque.hidden = !requiere;
        $$('input', bloque).forEach(i => { i.disabled = !requiere; });

        // Sin apoderado, el DNI verificado solo puede ser del estudiante.
        const opApoderado = $('input[name="verificado_es"][value="apoderado"]');
        opApoderado.disabled = !requiere;
        opApoderado.closest('label').hidden = !requiere;
        if (!requiere && valor('verificado_es') === 'apoderado') {
            $('input[name="verificado_es"][value="estudiante"]').checked = true;
            aplicarVerificado();
        }
    }

    $$('input[name="verificado_es"]').forEach(r => r.addEventListener('change', aplicarVerificado));
    $$('input[name="es_mayor"]').forEach(r => r.addEventListener('change', actualizarApoderado));

    $$('[data-patron]').forEach(el => el.addEventListener('input', () => {
        el.value = el.value.replace(/\D/g, '').slice(0, el.maxLength);
    }));

    // ======================================================
    // VALIDACIÓN POR PASO
    // ======================================================
    function validarPaso(paso) {
        if (paso === 1) {
            const modalidad = valor('modalidad');
            if (!modalidad) return { mensaje: 'Elige si deseas matricularte en Colegio o Academia.' };
            for (const f of FILTROS[modalidad]) {
                if (!valor(f)) return { mensaje: 'Completa todas las opciones del programa.', campo: document.getElementById(f) };
            }
            if (!ciclo) return { mensaje: 'Elige uno de los ciclos disponibles.', campo: $('#mfCiclos') };
            return null;
        }

        if (paso === 2) {
            const visibles = $$('input[required]', $('.mf-step[data-step="2"]')).filter(i => !i.disabled && !i.closest('[hidden]'));
            for (const i of visibles) {
                if (i.type === 'radio') {
                    if (!form.querySelector(`input[name="${i.name}"]:checked`)) return { mensaje: 'Selecciona el género del estudiante.', campo: i };
                    continue;
                }
                if (!i.value.trim()) return { mensaje: `Completa el campo "${etiqueta(i)}".`, campo: i };
                if (i.type === 'email' && !i.checkValidity()) return { mensaje: 'Ingresa un correo electrónico válido.', campo: i };
                if (i.dataset.patron === 'dni' && !/^\d{8}$/.test(i.value)) return { mensaje: 'El DNI debe tener 8 dígitos.', campo: i };
                if (i.dataset.patron === 'celular' && !/^9\d{8}$/.test(i.value)) return { mensaje: 'El celular debe tener 9 dígitos y empezar con 9.', campo: i };
            }
            const cel = campo('alumno_celular');
            if (cel.value && !/^9\d{8}$/.test(cel.value)) return { mensaje: 'El celular debe tener 9 dígitos y empezar con 9.', campo: cel };

            const e = edad(valor('alumno_fecha_nac'));
            if (e === null || e < 2 || e > 80) return { mensaje: 'Revisa la fecha de nacimiento del estudiante.', campo: campo('alumno_fecha_nac') };
            if (valor('modalidad') === 'academia' && valor('es_mayor') === 'si' && e < 18) {
                return { mensaje: 'Según la fecha de nacimiento el postulante es menor de edad: registra los datos del apoderado.', campo: $('#mfMayorEdad input') };
            }

            if (requiereApoderado()) {
                if (valor('apoderado_dni') === valor('alumno_dni')) return { mensaje: 'El DNI del apoderado debe ser distinto al del estudiante.', campo: campo('apoderado_dni') };
                const ea = edad(valor('apoderado_fecha_nac'));
                if (ea === null || ea < 18) return { mensaje: 'Revisa la fecha de nacimiento del apoderado (debe ser mayor de edad).', campo: campo('apoderado_fecha_nac') };
            }
            return null;
        }
        return null;
    }

    function etiqueta(input) {
        return (form.querySelector(`label[for="${input.id}"]`)?.childNodes[0]?.textContent || input.name).trim();
    }

    // ======================================================
    // RESUMEN LATERAL Y REVISIÓN
    // ======================================================
    function programaTexto() {
        const m = valor('modalidad');
        if (m === 'academia') return [textoSelect('id_universidad'), textoSelect('id_tipo_ciclo').split(' · ')[0]].filter(Boolean).join(' · ');
        if (m === 'colegio') return [textoSelect('id_nivel'), textoSelect('grado'), textoSelect('seccion')].filter(Boolean).join(' · ');
        return '';
    }

    function actualizarResumen() {
        const m = valor('modalidad');
        $('#sumModalidad').textContent = m ? (m === 'colegio' ? 'Colegio' : 'Academia') : '—';
        $('#sumPrograma').textContent = programaTexto() || '—';
        $('#sumCiclo').textContent = ciclo ? ciclo.nombre : '—';
        $('#sumTurno').textContent = textoSelect('id_turno').split(' · ')[0] || '—';
        $('#sumDinero').hidden = !ciclo;
        $('#mfSummary').classList.toggle('has-ciclo', !!ciclo);
        if (ciclo) {
            $('#sumImporte').textContent = soles(ciclo.importe);
            $('#sumDescuento').textContent = '− ' + soles(ciclo.descuento);
            $('#sumTotal').textContent = soles(ciclo.monto);
        }
    }

    function llenarLista(dl, filas) {
        dl.innerHTML = '';
        filas.filter(([, v]) => v).forEach(([k, v]) => {
            const div = document.createElement('div');
            const dt = document.createElement('dt'); dt.textContent = k;
            const dd = document.createElement('dd'); dd.textContent = v;
            div.append(dt, dd);
            dl.appendChild(div);
        });
    }

    function armarRevision() {
        $('#mfErrores').hidden = true;
        llenarLista($('#revPrograma'), [
            ['Modalidad', valor('modalidad') === 'colegio' ? 'Colegio' : 'Academia'],
            ['Programa', programaTexto()],
            ['Ciclo', ciclo?.nombre],
            ['Fechas', ciclo ? `${ciclo.fecha_inicio} – ${ciclo.fecha_fin}` : ''],
            ['Sede / Entorno', `${textoSelect('id_sede')} · ${textoSelect('id_entorno')}`],
            ['Turno', textoSelect('id_turno')],
            ['Total a pagar', ciclo ? `${soles(ciclo.monto)} (incluye 5% de descuento)` : ''],
        ]);
        llenarLista($('#revEstudiante'), [
            ['Nombre completo', `${valor('alumno_nombres')} ${valor('alumno_ape_paterno')} ${valor('alumno_ape_materno')}`],
            ['DNI', valor('alumno_dni')],
            ['Nacimiento', fechaDMY(valor('alumno_fecha_nac'))],
            ['Género', valor('alumno_genero') === 'M' ? 'Masculino' : 'Femenino'],
            ['Correo', valor('alumno_email')],
            ['Celular', valor('alumno_celular') || 'No registrado'],
        ]);
        const conApo = requiereApoderado();
        $('#revApoderadoBlock').hidden = !conApo;
        if (conApo) {
            llenarLista($('#revApoderado'), [
                ['Nombre completo', `${valor('apoderado_nombres')} ${valor('apoderado_ape_paterno')} ${valor('apoderado_ape_materno')}`],
                ['DNI', valor('apoderado_dni')],
                ['Nacimiento', fechaDMY(valor('apoderado_fecha_nac'))],
                ['Celular', valor('apoderado_celular')],
                ['Correo', valor('apoderado_email')],
            ]);
        }
        validarChecks();
    }

    const checks = ['terminos_aceptados', 'politicas_aceptadas'].map(id => document.getElementById(id));
    function validarChecks() {
        $('#mfConfirmar').disabled = !checks.every(c => c.checked);
    }
    checks.forEach(c => c.addEventListener('change', validarChecks));

    // ======================================================
    // ENVÍO
    // ======================================================
    let enviando = false;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (enviando || pasoActual !== 3) return;

        const btn = $('#mfConfirmar');
        const errores = $('#mfErrores');
        enviando = true;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Registrando...';
        errores.hidden = true;

        const conApo = requiereApoderado();
        const datos = {
            modalidad: valor('modalidad'),
            id_ciclo: ciclo.id,
            es_mayor: valor('modalidad') === 'academia' ? valor('es_mayor') : 'no',
            grado: valor('grado') || null,
            seccion: valor('seccion') || null,
            terminos_aceptados: 1,
            politicas_aceptadas: 1,
        };
        ['nombres', 'ape_paterno', 'ape_materno', 'dni', 'email', 'genero', 'fecha_nac', 'celular']
            .forEach(c => { datos[`alumno_${c}`] = valor(`alumno_${c}`) || null; });
        if (conApo) {
            ['nombres', 'ape_paterno', 'ape_materno', 'dni', 'email', 'celular', 'fecha_nac']
                .forEach(c => { datos[`apoderado_${c}`] = valor(`apoderado_${c}`) || null; });
        }

        try {
            const res = await fetch(CFG.rutaGuardar, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify(datos),
            });
            const r = await res.json().catch(() => ({}));

            if (res.ok && r.success) {
                mostrarFinal(r);
                return;
            }
            if (r.redirect) {
                alert(r.error || 'Tu sesión expiró.');
                window.location.href = r.redirect;
                return;
            }
            const lista = r.errors ? Object.values(r.errors).flat()
                : [res.status === 419 ? 'Tu sesión expiró. Recarga la página.' : (r.error || r.message || 'No se pudo registrar la matrícula.')];
            errores.innerHTML = '';
            const icono = document.createElement('i');
            icono.className = 'fa-solid fa-circle-exclamation';
            const ul = document.createElement('div');
            lista.forEach(t => { const p = document.createElement('div'); p.textContent = t; ul.appendChild(p); });
            errores.append(icono, ul);
            errores.hidden = false;
            errores.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } catch {
            alert('No se pudo conectar con el servidor. Inténtalo nuevamente.');
        } finally {
            enviando = false;
            if (pasoActual === 3) {
                btn.innerHTML = 'Confirmar matrícula <i class="fa-solid fa-check"></i>';
                validarChecks();
            }
        }
    });

    function mostrarFinal(r) {
        $('#finCodigo').textContent = r.codigo;
        $('#finMonto').textContent = Number(r.monto_total).toFixed(2);
        $('#finExpira').textContent = r.fecha_expiracion;
        $('#finEmail').textContent = r.email || 'tu correo';
        $('#finWhatsapp').href = `https://wa.me/${CFG.whatsapp}?text=${encodeURIComponent(`Hola Next Level, adjunto el comprobante de pago de mi matrícula ${r.codigo}.`)}`;
        irA(4);
        // Matrícula enviada: los pasos anteriores quedan completos y ya no se pueden reabrir.
        $$('#mfStepper li').forEach(li => {
            li.classList.toggle('is-done', Number(li.dataset.step) < 4);
            li.style.pointerEvents = 'none';
        });
        prepararPagoEnLinea(r);
    }

    // Pago en línea con Culqi (solo si está configurado: window.PagoCulqi)
    function prepararPagoEnLinea(r) {
        if (!window.PagoCulqi) return;
        const btn = $('#finPagar');
        const msg = $('#finPagoMsg');
        $('#finOnline').hidden = false;
        $('#finOr').hidden = false;
        $('#finPrueba').hidden = !window.PagoCulqi.modoPrueba;
        $('#finPagarMonto').textContent = Number(r.monto_total).toFixed(2);

        const avisar = (texto, error) => {
            msg.textContent = texto;
            msg.classList.toggle('is-error', !!error);
            msg.hidden = false;
        };

        btn.addEventListener('click', () => {
            msg.hidden = true;
            window.PagoCulqi.pagar({
                codigo: r.codigo,
                monto: r.monto_total,
                onExito: (res) => {
                    $('#finTitulo').textContent = '¡Pago aprobado!';
                    $('#finSubtitulo').textContent = 'Tu matrícula quedó confirmada. Este es tu código:';
                    $('.mf-due').hidden = true;
                    $('#finManual').hidden = true;
                    $('#finOr').hidden = true;
                    $('#finPasos').hidden = true;
                    $('#finWhatsapp').hidden = true;
                    btn.hidden = true;
                    $('#finOnline h3').innerHTML = '<i class="fa-solid fa-circle-check"></i> Bienvenido(a) a Next Level';
                    $('#finOnline .mf-online__info p').textContent = 'Tu usuario es tu DNI y tu contraseña es tu fecha de nacimiento (ddmmaaaa).';
                    $('#finPrueba').hidden = true;
                    avisar(res.mensaje, false);
                },
                onError: (texto) => avisar(texto, true),
            });
        });
    }

    // Copiar al portapapeles
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('[data-copiar]');
        if (!btn) return;
        const texto = $(btn.dataset.copiar)?.textContent.trim();
        try {
            await navigator.clipboard.writeText(texto);
            const antes = btn.innerHTML;
            btn.textContent = '¡Copiado!';
            setTimeout(() => { btn.innerHTML = antes; }, 1500);
        } catch { /* sin permiso de portapapeles */ }
    });

    // Aviso al salir con datos sin enviar
    window.addEventListener('beforeunload', (e) => {
        if (pasoActual > 1 && pasoActual < 4) { e.preventDefault(); e.returnValue = ''; }
    });

    // ======================================================
    // INICIO
    // ======================================================
    aplicarVerificado();
    actualizarApoderado();
    actualizarResumen();
})();
