document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    const heroSection = document.querySelector('.hero-full-width');

    if (slides.length === 0 || !heroSection) return;

    let currentSlide = 0;
    let slideInterval;
    const timeInterval = 5000
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, timeInterval);
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    startAutoSlide();

    heroSection.addEventListener('mouseenter', stopAutoSlide);
    heroSection.addEventListener('mouseleave', startAutoSlide);
});
