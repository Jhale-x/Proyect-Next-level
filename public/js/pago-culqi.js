/**
 * Pago en línea con Culqi (tarjeta y Yape), compartido por el formulario y el chatbot.
 * Requiere window.CULQI = { publicKey, ruta, titulo, logo } (lo define partials/culqi.blade.php).
 *
 * Uso: PagoCulqi.pagar({ codigo, monto, onExito(respuesta), onError(mensaje) })
 */
(function () {
    const CFG = window.CULQI;
    if (!CFG || !CFG.publicKey) return;

    let cargado = null;
    let actual = null;   // pago en curso: { codigo, onExito, onError }

    function cargarScript() {
        if (cargado) return cargado;
        cargado = new Promise((resolver, rechazar) => {
            const s = document.createElement('script');
            s.src = 'https://checkout.culqi.com/js/v4';
            s.onload = resolver;
            s.onerror = () => { cargado = null; rechazar(new Error('No se pudo cargar Culqi')); };
            document.head.appendChild(s);
        });
        return cargado;
    }

    // Culqi llama a esta función global cuando el usuario termina en su formulario.
    window.culqi = async function () {
        const pago = actual;
        if (!pago) return;

        if (!window.Culqi.token) {
            const e = window.Culqi.error;
            if (e && e.user_message) pago.onError(e.user_message);
            return;
        }

        const token = window.Culqi.token.id;
        const email = window.Culqi.token.email;
        window.Culqi.close();

        try {
            const res = await fetch(CFG.ruta.replace('__CODIGO__', encodeURIComponent(pago.codigo)), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ token, email }),
            });
            const r = await res.json().catch(() => ({}));
            if (res.ok && r.success) pago.onExito(r);
            else pago.onError(r.mensaje || 'No se pudo procesar el pago. Inténtalo nuevamente.');
        } catch {
            pago.onError('No pudimos conectar con el servidor. Revisa tu conexión e inténtalo nuevamente.');
        } finally {
            actual = null;
        }
    };

    async function pagar({ codigo, monto, onExito, onError }) {
        actual = { codigo, onExito, onError };
        try {
            await cargarScript();
        } catch {
            actual = null;
            onError('No se pudo abrir la pasarela de pago. Revisa tu conexión e inténtalo nuevamente.');
            return;
        }
        window.Culqi.publicKey = CFG.publicKey;
        window.Culqi.settings({
            title: CFG.titulo,
            currency: 'PEN',
            amount: Math.round(Number(monto) * 100),
            description: `Matrícula ${codigo}`,
        });
        window.Culqi.options({
            lang: 'auto',
            installments: false,
            paymentMethods: { tarjeta: true, yape: true, bancaMovil: false, agente: false, billetera: false, cuotealo: false },
            style: { logo: CFG.logo, bannerColor: '#0B2C5C', buttonBackground: '#E63946', buttonText: 'Pagar' },
        });
        window.Culqi.open();
    }

    window.PagoCulqi = { pagar, modoPrueba: !!CFG.modoPrueba };
})();
