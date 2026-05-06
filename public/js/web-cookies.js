document.addEventListener("DOMContentLoaded", function() {
    const banner = document.getElementById('cookie-banner');
    const btnAccept = document.getElementById('btn-accept-cookies');

    const cookiesAccepted = localStorage.getItem('cookies_accepted_nextlevel');
    const privacidadAccepted = localStorage.getItem('privacidad_accepted_nextlevel');

    if (cookiesAccepted === 'true' && privacidadAccepted === 'true') {
        cargarGoogleAnalytics();
    } else {
        banner.style.display = 'block';
    }

    btnAccept.addEventListener('click', function() {
        localStorage.setItem('cookies_accepted_nextlevel', 'true');
        localStorage.setItem('privacidad_accepted_nextlevel', 'true');

        banner.style.display = 'none';
        cargarGoogleAnalytics();

        console.log("Consentimiento dual registrado: Cookies y Privacidad aceptadas.");
    });
});
