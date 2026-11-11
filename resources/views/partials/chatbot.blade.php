{{-- Asistente de matrícula (requiere css/web/chatbot.css y js/chatbot.js) --}}
<div class="cb" id="chatbotContainer" data-logo="{{ asset('images/next-level-logo.png') }}">
    <section class="cb-window" id="chatbotWindow" role="dialog" aria-label="Asistente de matrícula Next Level" aria-hidden="true">
        <header class="cb-header">
            <img src="{{ asset('images/next-level-logo.png') }}" alt="" class="cb-header__logo">
            <div class="cb-header__text">
                <strong>Asistente Next Level</strong>
                <span><i class="cb-dot"></i> En línea · Matrícula 2027</span>
            </div>
            <button type="button" class="cb-icon-btn" id="chatbotRestart" title="Reiniciar conversación" aria-label="Reiniciar conversación">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button type="button" class="cb-icon-btn" id="chatbotClose" title="Cerrar" aria-label="Cerrar chat">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>

        <div class="cb-messages" id="chatbotMessages" aria-live="polite"></div>

        <div class="cb-options" id="chatbotOptions"></div>

        <form class="cb-input" id="chatbotForm" autocomplete="off">
            <input type="text" id="chatbotInput" placeholder="Escribe tu mensaje..." maxlength="300" aria-label="Mensaje">
            <button type="submit" id="chatbotSend" disabled aria-label="Enviar">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>
    </section>

    <button type="button" class="cb-launcher" id="chatbotToggle" aria-controls="chatbotWindow" aria-expanded="false">
        <span class="cb-launcher__label">¿Te ayudo a matricularte?</span>
        <span class="cb-launcher__btn">
            <img src="{{ asset('images/next-level-logo.png') }}" alt="Abrir asistente">
            <span class="cb-launcher__badge" id="chatbotBadge">1</span>
        </span>
    </button>
</div>
