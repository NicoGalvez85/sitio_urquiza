<?php
require_once 'controladores/ControladorSesion.php';

if (isset($_POST['email']) && isset($_POST['clave']))
{

    $roles = $_POST['rol'];

    $cs = new ControladorSesion();
    $result = $cs->create($_POST['cuil'], $_POST['email'], $roles, $_POST['nombre'], $_POST['apellido'], $_POST['clave']);

    if( $result[0] === true )
    {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    else
    {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Gestor del sistema</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style2.css">
</head>
<body class="container">
    <div class="jumbotron text-center">
        <h1>REGISTRO DE USUARIOS</h1>
    </div>
    <div class="text-center">
        <h3>Crear nuevo usuario</h3>
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje" class="alert alert-primary text-center">
                <p>' . $_GET['mensaje'] . '</p></div>';
        }
        ?>
        <div class="col-8 mx-auto">

            <form action="create.php" method="post">
                <input name="cuil" class="form-control form-control-lg" placeholder="CUIL" required><br>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required><br>
                <input name="nombre" class="form-control form-control-lg" placeholder="Nombre" required><br>
                <input name="apellido" class="form-control form-control-lg" placeholder="Apellido" required><br>
                <input name="clave" type="text" minlength="7" class="form-control form-control-lg" placeholder="Contraseña" required><br>
                
                    <div class="form-group checkboxes mx-5">
                        <label for="roles" class="form-label"><h2>Seleccione el/los rol/es</h2></label><br>
                        <input type="checkbox" name="rol[]" value="0" class="form-check-input">
                        <label for="rol0" class="form-check-label">Administrador</label><br>
                        <input type="checkbox" name="rol[]" value="1" class="form-check-input">
                        <label for="rol1" class="form-check-label">Regente</label><br>
                        <input type="checkbox" name="rol[]" value="2" class="form-check-input">
                        <label for="rol2" class="form-check-label">Profesor</label><br>
                        <input type="checkbox" name="rol[]" value="3" class="form-check-input">
                        <label for="rol3" class="form-check-label">Alumno</label><br>
                        <input type="checkbox" name="rol[]" value="4" class="form-check-input">
                        <label for="rol4" class="form-check-label">Bedel</label><br>
                        <input type="checkbox" name="rol[]" value="5" class="form-check-input">
                        <label for="rol5" class="form-check-label">Secretario</label><br>
                    </div>                
                <input type="submit" value="Registrar" class="btn btn-primary mb-2">
            </form>
        </div>
    </div>

    <script src="js/checkbox.js"></script>
</body>
</html>
