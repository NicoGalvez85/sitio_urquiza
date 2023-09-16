<?php
require_once 'modelos/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nom = $usuario->getNombre();
  $ape = $usuario->getApellido();
  $roles = $usuario->getRol();
} else {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido <?php echo $nom." ".$ape ;?></h1><br>
    <?php
      echo '<h2>Roles Asignados:</h2><br>';
      foreach($roles as $rol){
        switch($rol){
          case 1: echo '<h3>Regente</h3>'; break;
          case 2: echo '<h3>Profesor</h3>'; break;
          case 3: echo '<h3>Alumno</h3>'; break;
          case 4: echo '<h3>Bedel</h3>'; break;
          case 5: echo '<h3>Secretario</h3>'; break;        
        }
    } ;?>
</body>
</html>

