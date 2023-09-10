document.addEventListener("DOMContentLoaded", function () {
    const adminCheckbox = document.querySelector('input[name="rol[]"][value="0"]');
    const otherCheckboxes = document.querySelectorAll('input[name="rol[]"]:not([value="0"])');
  
    adminCheckbox.addEventListener("change", function () {
      if (this.checked) {
        // Si se selecciona el checkbox de Administrador, deselecciona y deshabilita los otros checkboxes
        otherCheckboxes.forEach(function (checkbox) {
          checkbox.checked = false;
          checkbox.disabled = true;
        });
      } else {
        // Si se deselecciona el checkbox de Administrador, habilita los otros checkboxes
        otherCheckboxes.forEach(function (checkbox) {
          checkbox.disabled = false;
        });
      }
    });
  
    // Verificar si el checkbox de Administrador está seleccionado inicialmente
    if (adminCheckbox.checked) {
      // Si está seleccionado, deshabilita y deselecciona los otros checkboxes
      otherCheckboxes.forEach(function (checkbox) {
        checkbox.checked = false;
        checkbox.disabled = true;
      });
    }
  });
  