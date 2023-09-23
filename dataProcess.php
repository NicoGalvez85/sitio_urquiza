<?php
require_once 'controladores/ControladorSesion.php';

if (isset($_POST['cuil'], $_POST['email'], $_POST['nombre'], $_POST['apellido'],$_POST['estado'])) {

    $cuil= $_POST['cuil'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $estado = $_POST['estado'];
    $clave = $_POST['clave'];
    

    // Procesar los checkboxes de roles
    $roles = isset($_POST['rol']) ? $_POST['rol'] : array();

    $cs = new ControladorSesion();
    $resultado = $cs->modificar($cuil, $email, $roles, $nombre, $apellido, $estado, $clave);

    if ($resultado[0] === true) {
        header('Location: search.php?mensaje='.$resultado[1]);
    } else {
        header('Location: update.php?mensaje='.$resultado[1]);
    }
} 
?>