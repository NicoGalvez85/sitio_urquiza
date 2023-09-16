<?php
require_once 'controladores/ControladorSesion.php';

   $cs = new ControladorSesion();
    $login = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($login[0] === false) {
        $redirigir = 'login.php?mensaje=' . $login[1];
    }
    else {

        $redirigir = 'home0.php?mensaje=' . $login[1];
    }

header('Location: '.$redirigir);
?>