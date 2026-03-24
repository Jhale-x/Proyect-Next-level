document.addEventListener('DOMContentLoaded', function() {
  console.log('LibroReclamaciones JS loaded');
  
  const sede = document.getElementById('sede');
  const nivel = document.getElementById('nivel');
  const wrapper = document.getElementById('wrapper-formulario');
  const fechaSpan = document.getElementById('fecha-actual');
  const gradoSelect = document.querySelector('select[name="grado"]');
  const gradoField = gradoSelect ? gradoSelect.closest('.form-group') : null;

  if (!sede || !nivel || !wrapper) {
    console.error('Missing elements: sede, nivel, or wrapper');
    return;
  }

  if (fechaSpan) {
    const hoy = new Date();
    fechaSpan.textContent = hoy.toLocaleDateString('es-PE');
  }

  function actualizarFormulario() {
    console.log('actualizarFormulario called', {sedeValue: sede.value, nivelValue: nivel.value});
    
    if (sede.value !== '' && nivel.value !== '') {
      console.log('Showing form');
      wrapper.style.display = 'block';
      document.getElementById('hidden_sede').value = sede.value;
      document.getElementById('hidden_nivel').value = nivel.value;

      if (gradoField && gradoSelect) {
        if (nivel.value === 'ACADEMIA') {
          gradoField.style.display = 'none';
          gradoSelect.required = false;
          gradoSelect.value = '';
        } else {
          gradoField.style.display = 'block';
          gradoSelect.required = true;
        }
      }

      setTimeout(() => {
        wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100);
    } else {
      console.log('Hiding form');
      wrapper.style.display = 'none';
    }
  }

  sede.addEventListener('change', function() {
    console.log('Sede change:', sede.value);
    actualizarFormulario();
  });

  nivel.addEventListener('change', function() {
    console.log('Nivel change:', nivel.value);
    actualizarFormulario();
  });

  actualizarFormulario();
});
