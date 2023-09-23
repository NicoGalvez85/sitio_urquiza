document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const checkboxes = document.querySelectorAll('input[name="rol[]"]');
  const adminCheckbox = document.querySelector('input[name="rol[]"][value="0"]');        

  

  // Almacena el estado de los checkboxes antes de marcar "Administrador"
  const initialState = {};

  // Registra el estado inicial de los checkboxes
  checkboxes.forEach(function (checkbox) {
    initialState[checkbox.value] = checkbox.checked;
  });

  // Agrega un evento de cambio al checkbox de Administrador
  adminCheckbox.addEventListener("change", function () {
    const adminChecked = this.checked;

    // Si se marca el checkbox de Administrador, deshabilita los otros checkboxes
    checkboxes.forEach(function (checkbox) {
      if (checkbox !== adminCheckbox) {
        checkbox.disabled = adminChecked;
      }
    });

    // Si se desmarca el checkbox de Administrador, habilita los otros checkboxes
    if (!adminChecked) {
      checkboxes.forEach(function (checkbox) {
        if (checkbox !== adminCheckbox) {
          checkbox.disabled = false;
        }
      });

      // Restaura el estado inicial de los checkboxes
      for (const value in initialState) {
        checkboxes.forEach(function (checkbox) {
          if (checkbox.value === value) {
            checkbox.checked = initialState[value];
          }
        });
      }
    }
  });

  // Agrega un evento de envío al formulario
  form.addEventListener("submit", function (event) {
    let rolesSeleccionados = 0;

    // Cuenta cuántos checkboxes de roles están seleccionados
    checkboxes.forEach(function (checkbox) {
      if (checkbox.checked) {
        rolesSeleccionados++;
      }
    });

    // Verifica si al menos un rol está seleccionado
    if (rolesSeleccionados === 0) {
      event.preventDefault(); // Evita que se envíe el formulario
      alert("Debe seleccionar al menos un rol.");
    }
  });
});

