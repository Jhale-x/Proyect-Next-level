document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.acordeon-header');

    headers.forEach(header => {
        header.addEventListener('click', () => {

            const parent = header.parentElement;

            parent.classList.toggle('collapsed');
        });
    });
});
