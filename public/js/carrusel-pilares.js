document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('carruselTrack');
    const originalCards = Array.from(track.querySelectorAll('.info-blob-card'));
    const totalOriginal = originalCards.length;

    originalCards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });

    let index = 0;
    let autoPlay;
    let isTransitioning = false;

    const getCardsPerView = () => {
        if (window.innerWidth > 1200) return 4;
        if (window.innerWidth > 650) return 2;
        return 1;
    };

    const updateTrack = (animate = true) => {
        const cardsPerView = getCardsPerView();
        const cardWidth = 100 / (totalOriginal * 2 / (totalOriginal * 2));

        const containerWidth = track.parentElement.offsetWidth;
        const scrollAmount = (containerWidth / cardsPerView) * index;

        if (animate) {
            track.style.transition = "transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)";
            isTransitioning = true;
        } else {
            track.style.transition = "none";
        }

        track.style.transform = `translateX(-${scrollAmount}px)`;

        if (animate) {
            track.addEventListener('transitionend', function handler() {
                track.removeEventListener('transitionend', handler);
                isTransitioning = false;

                if (index >= totalOriginal) {
                    track.style.transition = "none";
                    index = 0;
                    track.style.transform = `translateX(0)`;
                }
            });
        }
    };

    const moveNext = () => {
        if (isTransitioning) return;
        index++;
        updateTrack(true);
    };

    const startAutoPlay = () => {
        autoPlay = setInterval(moveNext, 4000);
    };

    const stopAutoPlay = () => clearInterval(autoPlay);

    startAutoPlay();

    const container = document.querySelector('.info-organic-section');
    container.addEventListener('mouseenter', stopAutoPlay);
    container.addEventListener('mouseleave', startAutoPlay);

    window.addEventListener('resize', () => {
        index = 0;
        track.style.transition = "none";
        updateTrack(false);
    });
});
