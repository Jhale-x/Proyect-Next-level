document.addEventListener('DOMContentLoaded', function() {
    const gridItems = document.querySelectorAll('.grid-item');
    const modal     = document.getElementById('lightboxModal');
    const modalImg  = document.getElementById('lightboxMainImg');
    const counter   = document.getElementById('lightboxCounter');

    let images = [];
    let currentIndex = 0;

    gridItems.forEach((item, index) => {
        const img = item.querySelector('img');
        if (img) {
            images.push({ src: img.src, alt: img.alt });
        }

        let rowSpan = [14, 16, 18, 20, 22][index % 5] || 16;
        rowSpan += Math.floor(Math.random() * 3) - 1;
        item.style.setProperty('--row-span', Math.max(12, Math.min(24, rowSpan)));

        item.addEventListener('click', () => openModal(index));
    });

    function openModal(index) {
        currentIndex = index;
        updateContent();
        modal.classList.add('is-active');
        document.body.classList.add('u-no-scroll');
    }

    function closeModal() {
        modal.classList.remove('is-active');
        document.body.classList.remove('u-no-scroll');
    }

    function updateContent() {
        modalImg.src = images[currentIndex].src;
        modalImg.alt = images[currentIndex].alt;
        counter.textContent = `${currentIndex + 1} / ${images.length}`;
    }

    function navigate(direction) {
        modalImg.classList.add('is-fading');

        setTimeout(() => {
            currentIndex = (currentIndex + direction + images.length) % images.length;
            updateContent();
            modalImg.classList.remove('is-fading');
        }, 150);
    }

    modal.querySelector('.close-lightbox').onclick = closeModal;
    modal.querySelector('.lightbox-prev').onclick   = () => navigate(-1);
    modal.querySelector('.lightbox-next').onclick   = () => navigate(1);

    modal.onclick = (e) => {
        if (e.target === modal || e.target.classList.contains('lightbox-content')) {
            closeModal();
        }
    };

    document.onkeydown = (e) => {
        if (!modal.classList.contains('is-active')) return;

        if (e.key === 'Escape') closeModal();
        if (e.key === 'ArrowLeft') navigate(-1);
        if (e.key === 'ArrowRight') navigate(1);
    };
});
