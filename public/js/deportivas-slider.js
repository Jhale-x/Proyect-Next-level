document.addEventListener('DOMContentLoaded', function () {
    const swiperDeportes = new Swiper('.deportivas-swiper', {
        // CAMBIO CLAVE: De 1.2 a 1 para que no se asomen las de los lados
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        slideToClickedSlide: true,
        grabCursor: true,

        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        breakpoints: {
            // A partir de tablets (768px), sí podemos mostrar más
            768: {
                slidesPerView: 2,
                spaceBetween: 20, // Un poco de espacio para que no se peguen
                centeredSlides: false,
            },
            // A partir de pantallas grandes (1100px)
            1100: {
                slidesPerView: 3,
                spaceBetween: 30,
                centeredSlides: true,
            }
        }
    });
});
