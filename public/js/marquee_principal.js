document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".marquee-track");

    if (track) {

        const content = track.innerHTML;
        track.innerHTML = content.repeat(10);

        let pos = 0;
        const velocidad = 1.1;

        function animar() {
            pos -= velocidad;
            track.style.transform = `translateX(${pos}px)`;

            if (Math.abs(pos) >= track.scrollWidth / 2) {
                pos = 0;
            }

            requestAnimationFrame(animar);
        }

        animar();
    }
});
