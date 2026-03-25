document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.banco-link');
    const allLogos = document.querySelectorAll('.logo-filter');
    const grid = document.querySelector('.bancos-grid-minimal');
    const resetAllLogos = () => {
        allLogos.forEach(logo => {
            logo.classList.remove('logo-muted');
            logo.classList.remove('logo-active');
        });
    };

    links.forEach((link) => {
        link.addEventListener('mouseenter', () => {
            resetAllLogos();

            const currentLogo = link.querySelector('.logo-filter');

            allLogos.forEach(logo => logo.classList.add('logo-muted'));

            currentLogo.classList.remove('logo-muted');
            currentLogo.classList.add('logo-active');
        });
    });

    grid.addEventListener('mouseleave', () => {
        resetAllLogos();
    });
});
