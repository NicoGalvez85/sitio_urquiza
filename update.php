<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="container">
    <?php
    require_once 'controladores/ControladorSesion.php';

    // Verificar si se ha enviado el formulario de búsqueda
    $cuil = $_POST['cuil'];
    $cs = new ControladorSesion();
    $usuario = $cs->buscarPorCUIL($cuil);

    if ($usuario !== false) {
    ?>
    <div class="jumbotron text-center">
        <h1>Editar Usuario</h1>
    </div>
    <div class="col-8 mx-auto">
    <form action="dataProcess.php" method="post" class="mt-4">
        <div class="form-group">
            <label for="cuil">Cuil:</label>
            <input type="text" name="cuil" value="<?php echo $usuario->getCuil(); ?>" class="form-control" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $usuario->getMail(); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre(); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?php echo $usuario->getApellido(); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="1" <?php if ($usuario->getEstado() == 1) echo 'selected="selected"'; ?>>Habilitado</option>
                <option value="0" <?php if ($usuario->getEstado() == 0) echo 'selected="selected"'; ?>>Deshabilitado</option>
            </select>
            <div id="mensajeEstado" style="display: none; color: red;">
                Mientras el estado esté Deshabilitado, el usuario no podrá loguearse.
            </div>
        </div>

        <div class="form-group">
            <input type="checkbox" id="cambiarClaveCheckbox" name="cambiarClaveCheckbox" onchange="activarClave()" class="form-check-input">
            <label for="cambiarClave" class="form-check-label">Seleccione para cambiar Contraseña</label>
        </div>
        <div class="form-group">
            <label id="claveLabel" for="clave" style="display: none;">Contraseña nueva:</label>
            <input type="password" name="clave" id="clave1" minlength="7" style="display: none;" class="form-control" readonly>
        </div>
        <div class="form-group checkboxes mx-5">
            <input type="checkbox" name="rol[]" value="0" id="admin" class="form-check-input" <?php if (in_array(0, $usuario->getRol())) echo 'checked="checked"'; ?> onclick="toggleCheckboxes(this)">
            <label for="rol0" class="form-check-label">Administrador</label><br>
            <input type="checkbox" name="rol[]" value="1" class="form-check-input" <?php if (in_array(1, $usuario->getRol())) echo 'checked'; ?>>
            <label for="rol1" class="form-check-label">Regente</label><br>
            <input type="checkbox" name="rol[]" value="2" class="form-check-input" <?php if (in_array(2, $usuario->getRol())) echo 'checked'; ?>>
            <label for="rol2" class="form-check-label">Profesor</label><br>
            <input type="checkbox" name="rol[]" value="3" class="form-check-input" <?php if (in_array(3, $usuario->getRol())) echo 'checked'; ?>>
            <label for="rol3" class="form-check-label">Alumno</label><br>
            <input type="checkbox" name="rol[]" value="4" class="form-check-input" <?php if (in_array(4, $usuario->getRol())) echo 'checked'; ?>>
            <label for="rol4" class="form-check-label">Bedel</label><br>
            <input type="checkbox" name="rol[]" value="5" class="form-check-input" <?php if (in_array(5, $usuario->getRol())) echo 'checked'; ?>>
            <label for="rol5" class="form-check-label">Secretario</label><br>
        </div>
        <input type="submit" value="Guardar Cambios" class="btn btn-primary mb-3">
    </form>
    </div>
    <script src="js/upload.js"></script>
    <script>
      const estadoSelect = document.getElementById("estado");
  const mensajeEstado = document.getElementById("mensajeEstado");

  estadoSelect.addEventListener("change", function () { 

  if (estadoSelect.value === "0") {
      mensajeEstado.style.display = "block";
  } else {
      mensajeEstado.style.display = "none";
  }
  });

  if (estadoSelect.value === "0") {
    mensajeEstado.style.display = "block";
} else {
    mensajeEstado.style.display = "none";
}
    </script>
    <?php
    } else {
        header('Location: search.php?mensaje= Usuario no encontrado');
    }
    ?>
</body>
</html>
