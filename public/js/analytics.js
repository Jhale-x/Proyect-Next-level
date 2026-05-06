function cargarGoogleAnalytics() {
    const GA_ID = 'G-D9WK16EBHE';

    const script = document.createElement('script');
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${GA_ID}`;
    document.head.appendChild(script);

    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', GA_ID);

    console.log("Google Analytics activado legalmente para Next Level.");
}
