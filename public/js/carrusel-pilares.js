document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('carruselTrack');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    let index = 0;
    const totalCards = 8;

    const getCardsPerView = () => {
        if (window.innerWidth > 1200) return 4;
        if (window.innerWidth > 650) return 2;
        return 1;
    };

    const moveCarrusel = () => {
        const cardsPerView = getCardsPerView();
        const maxIndex = totalCards - cardsPerView;

        // Ajuste para que no pase del máximo
        if (index > maxIndex) index = 0;
        if (index < 0) index = maxIndex;

        const percentage = -(index * (100 / cardsPerView));
        track.style.transform = `translateX(${percentage}%)`;
    };

    nextBtn.addEventListener('click', () => {
        index++;
        moveCarrusel();
    });

    prevBtn.addEventListener('click', () => {
        index--;
        moveCarrusel();
    });

    // Movimiento Automático cada 5 segundos
    let autoPlay = setInterval(() => {
        index++;
        moveCarrusel();
    }, 5000);

    // Detener autoplay al interactuar
    const stopAutoPlay = () => clearInterval(autoPlay);
    nextBtn.addEventListener('mouseenter', stopAutoPlay);
    prevBtn.addEventListener('mouseenter', stopAutoPlay);

    // Ajustar al redimensionar la ventana
    window.addEventListener('resize', moveCarrusel);
});
