let lastScrollTop = 0;
const navbar = document.querySelector('.main-nav');
const topBar = document.querySelector('.top-bar');

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    let topBarHeight = topBar.offsetHeight;

    if (scrollTop > topBarHeight) {
        navbar.classList.add('nav-fixed');

        if (scrollTop > lastScrollTop && scrollTop > topBarHeight + 100) {
            navbar.classList.add('nav-hidden');
        } else {
            navbar.classList.remove('nav-hidden');
        }
    } else {
        navbar.classList.remove('nav-fixed');
        navbar.classList.remove('nav-hidden');
    }

    lastScrollTop = Math.max(0, scrollTop);
}, { passive: true });
