/**
 * Asistente de matrícula Next Level.
 * El servidor conduce la conversación (mismos pasos que el formulario);
 * aquí solo se muestran mensajes, botones de opción y la tarjeta de pago.
 */
(function () {
    const raiz = document.getElementById('chatbotContainer');
    if (!raiz) return;

    const ventana = document.getElementById('chatbotWindow');
    const lanzador = document.getElementById('chatbotToggle');
    const mensajes = document.getElementById('chatbotMessages');
    const opciones = document.getElementById('chatbotOptions');
    const form = document.getElementById('chatbotForm');
    const input = document.getElementById('chatbotInput');
    const enviarBtn = document.getElementById('chatbotSend');
    const badge = document.getElementById('chatbotBadge');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

    let abierto = false;
    let iniciado = false;
    let ocupado = false;

    // ---------- Abrir / cerrar ----------
    function abrir(mensajeInicial) {
        abierto = true;
        raiz.classList.add('is-open');
        ventana.setAttribute('aria-hidden', 'false');
        lanzador.setAttribute('aria-expanded', 'true');
        if (badge) badge.hidden = true;

        if (mensajeInicial) {
            enviar(mensajeInicial);
        } else if (!iniciado) {
            enviar('hola', { silencioso: true });
        }
        iniciado = true;
        setTimeout(() => input.focus(), 200);
    }

    function cerrar() {
        abierto = false;
        raiz.classList.remove('is-open');
        ventana.setAttribute('aria-hidden', 'true');
        lanzador.setAttribute('aria-expanded', 'false');
    }

    lanzador.addEventListener('click', () => (abierto ? cerrar() : abrir()));
    document.getElementById('chatbotClose')?.addEventListener('click', cerrar);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && abierto) cerrar(); });

    document.getElementById('chatbotRestart')?.addEventListener('click', async () => {
        if (ocupado) return;
        await fetch('/chatbot/cerrar', { method: 'POST', headers: cabeceras() }).catch(() => {});
        mensajes.innerHTML = '';
        opciones.innerHTML = '';
        enviar('hola', { silencioso: true });
    });

    /** Permite abrir el chat desde otros botones de la página. */
    window.abrirChatbot = (mensaje) => abrir(mensaje);

    // ---------- Envío ----------
    input.addEventListener('input', () => { enviarBtn.disabled = !input.value.trim() || ocupado; });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const texto = input.value.trim();
        if (texto) enviar(texto);
    });

    function cabeceras() {
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'X-Requested-With': 'XMLHttpRequest',
        };
    }

    async function enviar(texto, { silencioso = false, etiqueta = null } = {}) {
        if (ocupado) return;
        ocupado = true;
        enviarBtn.disabled = true;

        if (!silencioso) agregarMensaje('user', etiqueta || texto);
        input.value = '';
        opciones.innerHTML = '';
        const typing = mostrarEscribiendo();

        try {
            const res = await fetch('/chatbot/procesar', {
                method: 'POST',
                headers: cabeceras(),
                body: JSON.stringify({ mensaje: texto }),
            });

            if (res.status === 419) {
                throw new Error('La sesión expiró. Recarga la página para continuar.');
            }
            const data = await res.json();
            typing.remove();

            if (!data.success) {
                agregarMensaje('bot', data.error || 'Ocurrió un error.', true);
                return;
            }

            agregarMensaje('bot', data.respuesta, data.respuesta.startsWith('❌') || data.respuesta.startsWith('⚠️'));
            if (data.tarjeta) agregarTarjetaPago(data.tarjeta);
            mostrarOpciones(data.opciones || []);
            ajustarEntrada(data.entrada);
        } catch (err) {
            typing.remove();
            agregarMensaje('bot', err.message && err.message.includes('sesión')
                ? err.message
                : 'No pude conectar con el servidor. Inténtalo nuevamente o escríbenos al WhatsApp 923 317 625.', true);
        } finally {
            ocupado = false;
            enviarBtn.disabled = !input.value.trim();
            if (abierto) input.focus();
        }
    }

    // ---------- Render ----------
    /** Escapa el HTML y luego aplica **negrita**, *énfasis* y saltos de línea. */
    function formatear(texto) {
        const seguro = texto
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
        return seguro
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.+?)\*/g, '<em>$1</em>');
    }

    function agregarMensaje(tipo, texto, error = false) {
        const div = document.createElement('div');
        div.className = `cb-msg cb-msg--${tipo}` + (error ? ' cb-msg--error' : '');
        if (tipo === 'bot') {
            div.innerHTML = formatear(texto);
        } else {
            div.textContent = texto;
        }
        mensajes.appendChild(div);
        bajar();
    }

    function mostrarEscribiendo() {
        const div = document.createElement('div');
        div.className = 'cb-msg cb-msg--bot cb-typing';
        div.setAttribute('aria-label', 'El asistente está escribiendo');
        div.innerHTML = '<span></span><span></span><span></span>';
        mensajes.appendChild(div);
        bajar();
        return div;
    }

    function mostrarOpciones(lista) {
        opciones.innerHTML = '';
        lista.forEach(op => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'cb-chip' + (op.secundaria ? ' cb-chip--sec' : '') + (op.detalle ? ' cb-chip--wide' : '');
            b.textContent = op.texto;
            if (op.detalle) {
                const small = document.createElement('small');
                small.textContent = op.detalle;
                b.appendChild(small);
            }
            b.addEventListener('click', () => enviar(op.valor, { etiqueta: op.texto }));
            opciones.appendChild(b);
        });
    }

    function ajustarEntrada(entrada) {
        const tipos = { numeric: ['text', 'numeric'], tel: ['tel', 'tel'], email: ['email', 'email'], fecha: ['text', 'numeric'] };
        const [type, mode] = tipos[entrada?.tipo] || ['text', 'text'];
        input.type = type;
        input.inputMode = mode;
        input.placeholder = entrada?.placeholder || 'Escribe tu mensaje...';
        input.maxLength = entrada?.max || 300;
    }

    // Autoformato DD/MM/AAAA para las fechas
    input.addEventListener('input', () => {
        if (input.placeholder !== 'DD/MM/AAAA') return;
        const d = input.value.replace(/\D/g, '').slice(0, 8);
        input.value = [d.slice(0, 2), d.slice(2, 4), d.slice(4)].filter(Boolean).join('/');
    });

    function agregarTarjetaPago(t) {
        const card = document.createElement('div');
        card.className = 'cb-pay';
        const fila = (k, v) => {
            const row = document.createElement('div');
            row.className = 'cb-pay__row';
            const a = document.createElement('span'); a.textContent = k;
            const b = document.createElement('b'); b.textContent = v;
            row.append(a, b);
            return row;
        };

        const code = document.createElement('div');
        code.className = 'cb-pay__code';
        code.innerHTML = '<small>CÓDIGO DE MATRÍCULA</small>';
        const b = document.createElement('b');
        b.textContent = t.codigo;
        code.appendChild(b);

        const img = document.createElement('img');
        img.src = t.qr;
        img.alt = 'QR de pago';

        const wa = document.createElement('a');
        wa.href = `https://wa.me/${t.whatsapp}?text=${encodeURIComponent(`Hola, adjunto el comprobante de pago de mi matrícula ${t.codigo}.`)}`;
        wa.target = '_blank';
        wa.rel = 'noopener';
        wa.innerHTML = '<i class="fa-brands fa-whatsapp"></i> Enviar comprobante';

        card.append(code, fila('Total a pagar', `S/ ${t.monto}`), fila('Pagar antes del', t.expira));

        // Pago en línea con Niubiz (solo si está configurado)
        if (window.PagoOnline) {
            const pagar = document.createElement('button');
            pagar.type = 'button';
            pagar.className = 'cb-pay__online';
            pagar.innerHTML = '<i class="fa-solid fa-lock"></i> Pagar ahora con tarjeta o Yape';
            const nota = document.createElement('p');
            nota.className = 'cb-pay__nota';
            nota.textContent = window.PagoOnline.modoPrueba
                ? 'Modo de prueba: no se cobra dinero real.'
                : 'Recibes tu constancia y credenciales al instante.';
            pagar.addEventListener('click', () => {
                window.PagoOnline.pagar({
                    codigo: t.codigo,
                    onError: (texto) => agregarMensaje('bot', `⚠️ ${texto}`, true),
                });
            });
            card.append(pagar, nota);
            const o = document.createElement('p');
            o.className = 'cb-pay__nota';
            o.textContent = 'o paga por QR o transferencia:';
            card.append(o);
        }

        card.append(img, fila(`Cuenta ${t.banco}`, t.cuenta), fila('CCI', t.cci), fila('Titular', t.titular), wa);
        mensajes.appendChild(card);
        bajar();
    }

    function bajar() {
        mensajes.scrollTop = mensajes.scrollHeight;
    }
})();
