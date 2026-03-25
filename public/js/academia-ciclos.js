const swiper = new Swiper('.ciclos-swiper', {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    slideToClickedSlide: true,
    slidesPerView: 1,
    breakpoints: {
        1200: { slidesPerView: 3, spaceBetween: 40 }
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    }
});
