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

                <!-- Agregar los checkboxes de roles -->
                <div class="form-group checkboxes mx-5">
                    <label for="roles" class="form-label"><h2>Roles</h2></label><br>
                    <!-- Agrega aquí los checkboxes de roles con los valores actuales -->
                    <!-- Ejemplo:
                    <input type="checkbox" name="rol[]" value="0" class="form-check-input" 
                    <?php if (in_array(0, $usuario->getRoles())) echo 'checked'; ?>>
                    <label for="rol0" class="form-check-label">Administrador</label><br>
                    -->
                </div>

                <input type="submit" value="Guardar Cambios">
            </form>
        </body>
        </html>
        <?php
    } else {

        header('Location: search.php?mensaje= Usuario no encontrado');
    }

?>
