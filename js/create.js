
// Variables para el manejo de roles dinámicos
const rolesList = document.getElementById('roles-list');
const agregarRolButton = document.getElementById('agregar-rol');
const formulario = document.querySelector('form');

// Función para agregar un campo de entrada de rol
function agregarCampoRol() {
    const nuevoCampoRol = document.createElement('li');
    const nuevoCampoRolHTML = `
    <div class="form-group row align-items-center">
        <div class="col-6 mx-0">
            <select name="rol[]" class="form-control form-control-lg" style="max-width: 100%;">
                <option value="" disabled selected>Seleccione un Rol</option>
                <option value="Administrador">Administrador</option>
                <option value="Regente">Regente</option>
                <option value="Profesor">Profesor</option>
                <option value="Alumno">Alumno</option>
                <option value="Bedel">Bedel</option>
                <option value="Secretario">Secretario</option>
            </select>
        </div>
        <div class="col-7 mx-0 pt-1">
            <button type="button" class="btn btn-danger eliminar-rol">Eliminar Rol</button>
        </div>
    </div>
    `;
    nuevoCampoRol.innerHTML = nuevoCampoRolHTML;
    rolesList.appendChild(nuevoCampoRol);

    // Agregar evento de eliminación para el botón
    const eliminarRolButton = nuevoCampoRol.querySelector('.eliminar-rol');
    eliminarRolButton.addEventListener('click', function() {
        rolesList.removeChild(nuevoCampoRol);
    });

    // Evento para controlar selecciones duplicadas
    const selectElement = nuevoCampoRol.querySelector('select');
    selectElement.addEventListener('change', function() {
        const selectedValue = selectElement.value;
        if (selectedValue !== '' && rolesSeleccionados.has(selectedValue)) {
            alert('Este rol ya ha sido seleccionado.');
            selectElement.value = ''; // Reiniciar la selección
        } else {
            rolesSeleccionados.add(selectedValue);
        }
    });
}

// Función para validar la selección de roles antes de enviar el formulario
function validarRoles(event) {
    const selectElements = document.querySelectorAll('select[name^="rol"]');
    let alMenosUnRolSeleccionado = false;

    selectElements.forEach((selectElement) => {
        if (selectElement.value !== '') {
            alMenosUnRolSeleccionado = true;
        }
    });

    if (!alMenosUnRolSeleccionado) {
        alert('Debe seleccionar al menos un rol.');
        event.preventDefault(); // Evitar el envío del formulario
    }
}

// Agregar el evento de validación al formulario
formulario.addEventListener('submit', validarRoles);

// Evento para agregar un campo de entrada de rol al hacer clic en el botón
agregarRolButton.addEventListener('click', agregarCampoRol);
