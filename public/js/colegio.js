const menuOpen = document.getElementById('menuOpen');
const menuClose = document.getElementById('menuClose');
const menuOverlay = document.getElementById('menuOverlay');
const sideMenu = document.getElementById('sideMenu');
const panels = document.querySelectorAll('.menu-panel');
const submenuItems = document.querySelectorAll('.has-submenu');
const backBtns = document.querySelectorAll('.back-btn');

function openMenu() {
    sideMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMenu() {
    sideMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
    panels.forEach(panel => panel.classList.remove('active'));
    document.getElementById('mainPanel').classList.add('active');
}

menuOpen.addEventListener('click', openMenu);
menuClose.addEventListener('click', closeMenu);
menuOverlay.addEventListener('click', closeMenu);

submenuItems.forEach(item => {
    item.addEventListener('click', () => {
        const targetId = item.getAttribute('data-target');
        panels.forEach(panel => panel.classList.remove('active'));
        document.getElementById(targetId).classList.add('active');
    });
});

backBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        panels.forEach(panel => panel.classList.remove('active'));
        document.getElementById('mainPanel').classList.add('active');
    });
});

const marqueeTrack = document.getElementById('marqueeTrack');
if (marqueeTrack) {
    const marqueeContent = marqueeTrack.innerHTML;
    marqueeTrack.innerHTML = marqueeContent + marqueeContent;
}

new Swiper('.actividades-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        }
    }
});

new Swiper('.testimonios-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        }
    }
});
