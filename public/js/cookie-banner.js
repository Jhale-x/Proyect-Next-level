document.addEventListener('DOMContentLoaded', () => {
    const cookieBanner = document.getElementById('cookie-banner');
    const btnAccept = document.getElementById('btn-accept-cookies');
    const btnDecline = document.getElementById('btn-decline-cookies');
    const COOKIE_STORAGE_KEY = 'nextlevel_cookies_accepted';
    const hasUserDecided = localStorage.getItem(COOKIE_STORAGE_KEY);

    const initGoogleAnalytics = () => {
        const gaScript = document.createElement('script');
        gaScript.async = true;
        gaScript.src = 'https://www.googletagmanager.com/gtag/js?id=G-Y6G6C1F5EP';
        document.head.appendChild(gaScript);

        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        window.gtag = gtag;

        gtag('js', new Date());
        gtag('config', 'G-D9WK16EBHE');

        console.log('Google Analytics inicializado correctamente.');
    };

    if (hasUserDecided === 'true') {
        initGoogleAnalytics();
    } else if (!hasUserDecided) {
        cookieBanner.classList.remove('cookie-banner--hidden');
    }

    const hideBanner = () => {
        cookieBanner.classList.add('cookie-banner--hidden');
    };

    if (btnAccept) {
        btnAccept.addEventListener('click', () => {
            localStorage.setItem(COOKIE_STORAGE_KEY, 'true');
            hideBanner();
            initGoogleAnalytics();
        });
    }

    if (btnDecline) {
        btnDecline.addEventListener('click', () => {
            localStorage.setItem(COOKIE_STORAGE_KEY, 'false');
            hideBanner();
            console.log('Cookies rechazadas. No se realizará seguimiento.');
        });
    }
});
