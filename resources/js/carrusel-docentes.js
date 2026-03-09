document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('docentesTrack');
    const next = document.getElementById('docNextBtn');
    const prev = document.getElementById('docPrevBtn');

    let index = 0;
    let autoPlayInterval;

    const getVisibleCards = () => {
        if (window.innerWidth <= 600) return 1;
        if (window.innerWidth <= 900) return 2;
        if (window.innerWidth <= 1200) return 3;
        return 4;
    };

    // Función para mover al siguiente slide
    const moveNext = () => {
        const visibleCards = getVisibleCards();
        const totalCards = track.querySelectorAll('.docente-card-modern').length;

        if (index < totalCards - visibleCards) {
            index++;
        } else {
            index = 0; // Regresa al inicio
        }
        updateTrack();
    };

    // Función para mover al anterior slide
    const movePrev = () => {
        const visibleCards = getVisibleCards();
        const totalCards = track.querySelectorAll('.docente-card-modern').length;

        if (index > 0) {
            index--;
        } else {
            index = totalCards - visibleCards; // Va al final
        }
        updateTrack();
    };

    // Eventos Manuales
    next.addEventListener('click', () => {
        moveNext();
        resetAutoPlay(); // Reinicia el tiempo si el usuario hace clic
    });

    prev.addEventListener('click', () => {
        movePrev();
        resetAutoPlay(); // Reinicia el tiempo si el usuario hace clic
    });

    function updateTrack() {
        const card = track.querySelector('.docente-card-modern');
        if (!card) return;

        const gap = 25;
        const cardWidth = card.offsetWidth;
        track.style.transform = `translateX(-${index * (cardWidth + gap)}px)`;
    }

    // --- Lógica de Automático ---

    const startAutoPlay = () => {
        autoPlayInterval = setInterval(moveNext, 5000); // Cambia cada 5 segundos
    };

    const stopAutoPlay = () => {
        clearInterval(autoPlayInterval);
    };

    const resetAutoPlay = () => {
        stopAutoPlay();
        startAutoPlay();
    };

    // Iniciar el carrusel automático
    startAutoPlay();

    // Pausar cuando el mouse está encima del carrusel
    track.parentElement.addEventListener('mouseenter', stopAutoPlay);
    track.parentElement.addEventListener('mouseleave', startAutoPlay);

    // Ajustar si se cambia el tamaño de la ventana
    window.addEventListener('resize', () => {
        index = 0;
        updateTrack();
    });
});
