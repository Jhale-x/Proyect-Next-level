/*

document.addEventListener('DOMContentLoaded', () => {
    const isMinorCheckbox = document.getElementById('es_menor_edad');
    const guardianFields = document.getElementById('guardian_fields');
    const guardianName = document.getElementById('nombre_apoderado');
    const guardianDoc = document.getElementById('documento_apoderado');
    const claimForm = document.getElementById('claimForm');
    const headerCode = document.getElementById('claim-number-header');
    const termsCheckbox = document.getElementById('terms');

    if (isMinorCheckbox && guardianFields) {
        isMinorCheckbox.addEventListener('change', (e) => {
            const isChecked = e.target.checked;

            guardianFields.hidden = !isChecked;

            if (isChecked) {
                guardianName.setAttribute('required', 'required');
                guardianDoc.setAttribute('required', 'required');
            } else {
                guardianName.removeAttribute('required');
                guardianDoc.removeAttribute('required');
                guardianName.value = '';
                guardianDoc.value = '';
            }
        });
    }

    if (claimForm) {
        claimForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (!claimForm.checkValidity()) {
                alert('Por favor, complete todos los campos obligatorios marcados con (*).');
                return;
            }
            if (termsCheckbox && !termsCheckbox.checked) {
                alert('Debe aceptar la declaración de conformidad para continuar.');
                return;
            }

            const formData = new FormData(claimForm);

            try {
                const response = await fetch(claimForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    if (headerCode) {
                        headerCode.textContent = result.codigo;
                    }
                    alert(`${result.message}\nTu código único de seguimiento es: ${result.codigo}`);
                    claimForm.reset();
                    if (guardianFields) {
                        guardianFields.hidden = true;
                    }
                } else {
                    alert(result.message || 'Ocurrió un error inesperado.');
                }

            } catch (error) {
                console.error('Error:', error);
                alert('No se pudo establecer conexión con el servidor.');
            }
        });
    }
});

*/
