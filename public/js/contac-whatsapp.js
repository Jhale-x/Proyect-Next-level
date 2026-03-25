document.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("formWhatsapp");

    form.addEventListener("submit", function(e){
        e.preventDefault();

        let dni = document.getElementById("dni").value;
        let nombre = document.getElementById("nombre").value;
        let apellido_paterno = document.getElementById("apellido_paterno").value;
        let apellido_materno = document.getElementById("apellido_materno").value;
        let edad = document.getElementById("edad").value;
        let sexo = document.getElementById("sexo").value;
        let email = document.getElementById("email").value;
        let celular = document.getElementById("celular").value;
        let mensaje = document.getElementById("mensaje").value;

        let texto =
`Hola Next Level, deseo más información:

° Nombre: ${nombre}
° Apellidos: ${apellido_paterno} ${apellido_materno}
° DNI: ${dni}
° Edad: ${edad}
° Sexo: ${sexo}
° Celular: ${celular}
° Email: ${email}

° Consulta:
${mensaje}`;

        let numero = "51923317625";

        let url = "https://wa.me/" + numero + "?text=" + encodeURIComponent(texto);

        window.open(url, "_blank");
    });

});
