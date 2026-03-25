document.addEventListener('DOMContentLoaded', function() {
    const gridItems = document.querySelectorAll('.grid-item');
    const images = [];
    let currentImageIndex = 0;

    function createLightbox() {

        if (document.getElementById('lightboxModal')) return;

        const modal = document.createElement('div');
        modal.id = 'lightboxModal';
        modal.className = 'lightbox-modal';

        modal.innerHTML = `
            <span class="close-lightbox">&times;</span>
            <a class="lightbox-prev">&#10094;</a>
            <a class="lightbox-next">&#10095;</a>
            <div class="lightbox-content">
                <div class="lightbox-image-container">
                    <img src="" alt="Imagen ampliada">
                </div>
            </div>
            <div class="lightbox-counter">1/20</div>
        `;

        document.body.appendChild(modal);
        const closeBtn = modal.querySelector('.close-lightbox');
        const prevBtn = modal.querySelector('.lightbox-prev');
        const nextBtn = modal.querySelector('.lightbox-next');

        closeBtn.addEventListener('click', closeLightbox);
        prevBtn.addEventListener('click', showPrevImage);
        nextBtn.addEventListener('click', showNextImage);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft' && modal.style.display === 'block') {
                showPrevImage();
            } else if (e.key === 'ArrowRight' && modal.style.display === 'block') {
                showNextImage();
            }
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLightbox();
            }
        });
    }

    function openLightbox(index) {
        const modal = document.getElementById('lightboxModal');
        const modalImg = modal.querySelector('.lightbox-image-container img');
        const counter = modal.querySelector('.lightbox-counter');

        currentImageIndex = index;
        modalImg.src = images[currentImageIndex].src;
        modalImg.alt = images[currentImageIndex].alt;
        counter.textContent = `${currentImageIndex + 1}/${images.length}`;

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightboxModal');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateLightboxImage();
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateLightboxImage();
    }

    function updateLightboxImage() {
        const modal = document.getElementById('lightboxModal');
        const modalImg = modal.querySelector('.lightbox-image-container img');
        const counter = modal.querySelector('.lightbox-counter');

        modalImg.style.opacity = '0';

        setTimeout(() => {
            modalImg.src = images[currentImageIndex].src;
            modalImg.alt = images[currentImageIndex].alt;
            counter.textContent = `${currentImageIndex + 1}/${images.length}`;
            modalImg.style.opacity = '1';
        }, 150);
    }

    gridItems.forEach((item, index) => {
        const img = item.querySelector('img');
        if (img) {
            images.push({
                src: img.src,
                alt: img.alt
            });
        }

        let rowSpan;

        if (index % 5 === 0) {
            rowSpan = 22;
        } else if (index % 4 === 0) {
            rowSpan = 20;
        } else if (index % 3 === 0) {
            rowSpan = 18;
        } else if (index % 2 === 0) {
            rowSpan = 16;
        } else {
            rowSpan = 14;
        }

        rowSpan += Math.floor(Math.random() * 3) - 1;
        rowSpan = Math.max(12, Math.min(24, rowSpan));

        item.style.setProperty('--row-span', rowSpan);

        item.addEventListener('click', function() {
            openLightbox(index);
        });
    });

    createLightbox();
});
