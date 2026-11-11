/**
 * Pago en línea con Niubiz (Botón de Pago Web), compartido por el formulario,
 * el chatbot y la página de resultado.
 * Requiere window.NIUBIZ = { rutaSesion, modoPrueba } (lo define partials/niubiz.blade.php).
 *
 * Uso: PagoOnline.pagar({ codigo, onError(mensaje) })
 *
 * Al pagar, el formulario de Niubiz envía el resultado a nuestro servidor (POST a la URL
 * "action"), que autoriza el cobro y muestra la página de resultado. Por eso no hay
 * callback de éxito en el navegador: la confirmación siempre la decide el servidor.
 */
(function () {
    const CFG = window.NIUBIZ;
    if (!CFG || !CFG.rutaSesion) return;

    const scripts = {};
    let enCurso = false;

    function cargarScript(url) {
        if (!scripts[url]) {
            scripts[url] = new Promise((resolver, rechazar) => {
                const s = document.createElement('script');
                s.src = url;
                s.onload = resolver;
                s.onerror = () => { delete scripts[url]; rechazar(new Error('No se pudo cargar Niubiz')); };
                document.head.appendChild(s);
            });
        }
        return scripts[url];
    }

    async function pagar({ codigo, onError }) {
        if (enCurso) return;
        enCurso = true;
        try {
            // 1. El servidor crea la sesión de pago con el monto real de la matrícula.
            const res = await fetch(CFG.rutaSesion.replace('__CODIGO__', encodeURIComponent(codigo)), {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
            const r = await res.json().catch(() => ({}));
            if (!res.ok || !r.success) {
                onError(r.mensaje || 'No se pudo iniciar el pago. Inténtalo nuevamente.');
                return;
            }

            // 2. Se abre el formulario de Niubiz.
            await cargarScript(r.script);
            if (!window.VisanetCheckout) throw new Error('Niubiz no disponible');
            window.VisanetCheckout.configure(r.config);
            window.VisanetCheckout.open();
        } catch {
            onError('No se pudo abrir la pasarela de pago. Revisa tu conexión e inténtalo nuevamente.');
        } finally {
            enCurso = false;
        }
    }

    window.PagoOnline = { pagar, modoPrueba: !!CFG.modoPrueba };
})();
