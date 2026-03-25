document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('alumnosTrack');
    const allVideos = track.querySelectorAll('video');

    allVideos.forEach(video => {
        video.addEventListener('play', () => {
            allVideos.forEach(v => {
                if (v !== video) {
                    v.pause();
                    v.currentTime = 0;
                }
            });
        });
    });
});
