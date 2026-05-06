document.addEventListener('DOMContentLoaded', () => {
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('menuOverlay');
    const btnOpen = document.getElementById('menuOpen');
    const btnClose = document.getElementById('menuClose');
    const mainPanel = document.getElementById('mainPanel');
    const currentUrl = window.location.href;
    const mobileLinks = document.querySelectorAll('.mobile-nav-list a');

    mobileLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add('active');

            const parentPanel = link.closest('.menu-panel');
            if (parentPanel && parentPanel.id !== 'mainPanel') {
                document.querySelectorAll('.menu-panel').forEach(p => p.classList.remove('active'));
                parentPanel.classList.add('active');
            }
        }
    });

    if (btnOpen) {
        btnOpen.addEventListener('click', () => {
            sideMenu.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    const closeAll = () => {
        sideMenu.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = 'auto';
        setTimeout(() => {
            document.querySelectorAll('.menu-panel').forEach(p => p.classList.remove('active'));
            mainPanel.classList.add('active');
        }, 400);
    };

    if (btnClose) btnClose.addEventListener('click', closeAll);
    if (overlay) overlay.addEventListener('click', closeAll);

    document.querySelectorAll('.has-submenu').forEach(item => {
        item.addEventListener('click', () => {
            const targetId = item.getAttribute('data-target');
            const targetPanel = document.getElementById(targetId);
            if (targetPanel) {
                mainPanel.classList.remove('active');
                targetPanel.classList.add('active');
            }
        });
    });

    document.querySelectorAll('.back-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.parentElement.classList.remove('active');
            mainPanel.classList.add('active');
        });
    });
});
