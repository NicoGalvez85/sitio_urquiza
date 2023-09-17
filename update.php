<?php
require_once 'controladores/ControladorSesion.php';

// Verificar si se ha enviado el formulario de búsqueda
    $cuil = $_POST['cuil'];
    $cs = new ControladorSesion();
    $usuario = $cs->buscarPorCUIL($cuil);

    if ($usuario !== false) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
            <title>Editar Usuario</title>
        </head>
        <body>
            <h1>Editar Usuario</h1>
            <form action="procesar_actualizacion.php" method="post">
                <label for="cuil">Cuil:</label>
                <input type="text" name="cuil" value="<?php echo $usuario->getCuil(); ?>" required><br>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $usuario->getMail(); ?>" required><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $usuario->getNombre(); ?>" required><br>
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $usuario->getApellido(); ?>" required><br>
                <label for="estado">Estado:</label>
                <input type="number" name="estado" value="<?php echo $usuario->getEstado(); ?>" min=0 max=1 required><br>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" minlength="7" required><br>

                <div class="form-group checkboxes mx-5">
                    <label for="roles" class="form-label"><h2>Roles</h2></label>

                    <input type="checkbox" name="rol[]" value="0" class="form-check-input" 
                    <?php if (in_array(0, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol0" class="form-check-label">Administrador</label><br>
                    
                    <input type="checkbox" name="rol[]" value="1" class="form-check-input" 
                    <?php if (in_array(1, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol1" class="form-check-label">Regente</label><br>

                    <input type="checkbox" name="rol[]" value="2" class="form-check-input" 
                    <?php if (in_array(2, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol2" class="form-check-label">Profesor</label><br>

                    <input type="checkbox" name="rol[]" value="3" class="form-check-input" 
                    <?php if (in_array(3, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol3" class="form-check-label">Alumno</label><br>

                    <input type="checkbox" name="rol[]" value="4" class="form-check-input" 
                    <?php if (in_array(4, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol4" class="form-check-label">Bedel</label><br>

                    <input type="checkbox" name="rol[]" value="5" class="form-check-input" 
                    <?php if (in_array(5, $usuario->getRol())) echo 'checked'; ?>>
                    <label for="rol5" class="form-check-label">Secretario</label><br>

                </div>

                <input type="submit" value="Guardar Cambios">
            </form>
                <script src="js/checkbox.js"></script>
        </body>
        </html>
        <?php
    } else {

        header('Location: search.php?mensaje= Usuario no encontrado');
    }

?>
