document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.getElementById('dropdownSexo');
    const selectedText = document.getElementById('selectedText');
    const inputSexo = document.getElementById('inputSexo');
    const options = dropdown.querySelectorAll('.dropdown-list li');

    if (dropdown) {
        dropdown.addEventListener('click', () => {
            dropdown.classList.toggle('active');
        });

        options.forEach(option => {
            option.addEventListener('click', (e) => {
                const value = e.target.getAttribute('data-value');
                const text = e.target.innerText;

                selectedText.innerText = text;
                inputSexo.value = value;

                dropdown.classList.remove('active');
                e.stopPropagation();
            });
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    }
});
