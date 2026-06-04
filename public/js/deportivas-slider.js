document.addEventListener('DOMContentLoaded', function () {
    const swiperDeportes = new Swiper('.deportivas-swiper', {
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
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
                centeredSlides: false,
            },
            1100: {
                slidesPerView: 3,
                spaceBetween: 30,
                centeredSlides: true,
            }
        }
    });
});

