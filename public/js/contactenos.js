document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById("formWhatsapp");
    const dropdown = document.getElementById('dropdownSexo');
    const selectedText = document.getElementById('selectedText');
    const inputSexo = document.getElementById('inputSexo');
    const options = dropdown.querySelectorAll('.dropdown-list li');

    if (dropdown) {
        dropdown.addEventListener('click', (e) => {
            dropdown.classList.toggle('active');
            e.stopPropagation();
        });

        options.forEach(option => {
            option.addEventListener('click', (e) => {
                const value = e.currentTarget.getAttribute('data-value');
                const text = e.currentTarget.innerText;

                selectedText.innerText = text;
                inputSexo.value = value;
                dropdown.classList.remove('active');
                e.stopPropagation();
            });
        });

        document.addEventListener('click', () => dropdown.classList.remove('active'));
    }

    if (form) {
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const datos = {
                dni: document.getElementById("dni").value,
                nombre: document.getElementById("nombre").value,
                apellidos: `${document.getElementById("apellido_paterno").value} ${document.getElementById("apellido_materno").value}`,
                edad: document.getElementById("edad").value,
                sexo: inputSexo.value === "M" ? "Masculino" : (inputSexo.value === "F" ? "Femenino" : "No especificado"),
                email: document.getElementById("email").value || "No proporcionado",
                celular: document.getElementById("celular").value,
                mensaje: document.getElementById("mensaje").value
            };

            if (datos.dni.length < 8) return alert("Por favor, ingresa un DNI válido.");

            const numeroWhatsApp = "51923317625";
            const textoMensaje =
`*NUEVA SOLICITUD - NEXT LEVEL 2026*
---------------------------------------
• *Nombre:* ${datos.nombre}
• *Apellidos:* ${datos.apellidos}
• *DNI:* ${datos.dni}
• *Edad:* ${datos.edad} años
• *Sexo:* ${datos.sexo}
---------------------------------------
• *Celular:* ${datos.celular}
• *Email:* ${datos.email}
---------------------------------------
*CONSULTA:*
${datos.mensaje}`;

            const urlFinal = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(textoMensaje)}`;
            window.open(urlFinal, "_blank");
        });
    }
});
