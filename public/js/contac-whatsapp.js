document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("formWhatsapp");

    if (form) {
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const dni = document.getElementById("dni").value;
            const nombre = document.getElementById("nombre").value;
            const apellido_paterno = document.getElementById("apellido_paterno").value;
            const apellido_materno = document.getElementById("apellido_materno").value;
            const edad = document.getElementById("edad").value;

            const sexo = document.getElementById("inputSexo").value || "No especificado";

            const email = document.getElementById("email").value || "No proporcionado";
            const celular = document.getElementById("celular").value;
            const mensaje = document.getElementById("mensaje").value;

            const numeroWhatsApp = "51923317625";

            const textoMensaje =
`*NUEVA SOLICITUD DE INFORMACIÓN - NEXT LEVEL 2026*

*DATOS DEL INTERESADO:*
• *Nombre:* ${nombre}
• *Apellidos:* ${apellido_paterno} ${apellido_materno}
• *DNI:* ${dni}
• *Edad:* ${edad} años
• *Sexo:* ${sexo}

*DATOS DE CONTACTO:*
• *Celular:* ${celular}
• *Email:* ${email}

*CONSULTA ADICIONAL:*
${mensaje}`;

            const urlFinal = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(textoMensaje)}`;

            window.open(urlFinal, "_blank");
        });
    }
});
