<?php
require_once 'controladores/ControladorSesion.php';

if (isset($_POST['email']) && isset($_POST['clave']))
{

    $roles = $_POST['rol'];

    $cs = new ControladorSesion();
    $result = $cs->create($_POST['cuil'], $_POST['email'], $roles, $_POST['nombre'], $_POST['apellido'], $_POST['clave']);

    if( $result[0] === true )
    {
        $redirigir = 'home.php?mensaje='.$result[1];
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
    </head>
    <body class="container">
        
      <div class="jumbotron text-center">
      <h1>REGISTRO DE USUARIOS</h1>
      </div>    
      <div class="text-center">
        <h3>Crear nuevo usuario</h3>
        <?php
            if (isset($_GET['mensaje']))
            {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

        <form action="create.php" method="post">
            <input name="cuil" class="form-control form-control-lg" placeholder="CUIL" required><br>
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required><br>
            <ul id="roles-list"></ul>
            <button type="button" id="agregar-rol" class="btn btn-success">Agregar Rol</button><br><br>        
            <input name="nombre" class="form-control form-control-lg" placeholder="Nombre" required><br>
            <input name="apellido" class="form-control form-control-lg" placeholder="Apellido" required><br>
            <input name="clave" type="password" class="form-control form-control-lg" placeholder="Contraseña" required><br>
            
            <input type="submit" value="Registrar" class="btn btn-primary">
        </form>        
      </div>

      <script src="js/create.js"></script>

    </body>
</html>