<?php
require_once 'controladores/ControladorSesion.php';

   $cs = new ControladorSesion();
    $login = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($login[0] == 0) {
        $redirigir = 'home0.php';
    } else if ($login[0] == 1) {
        $redirigir = 'home1.php';
    }
    else {
        $redirigir = 'login.php?mensaje=' . $login[1];
    }

header('Location: '.$redirigir);
?>