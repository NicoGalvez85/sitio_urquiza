<?php
require_once 'controladores/ControladorSesion.php';

if (!isset($_POST['usuario']) || !isset($_POST['clave']))
{
    $redirigir = 'formlog.php?mensaje=Error: E-mail y/o contraseña incorrectos';
} 
else 
{
    $cs = new ControladorSesion();
    $login = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($login[0] == 0) 
    {
        $redirigir = 'home0.php';
    } else if ($login[0] == 1) {
        $redirigir = 'home1.php';

    }
    else 
    {
        $redirigir = 'login.php?mensaje=' . $login[1];
    }
}
header('Location: '.$redirigir);
?>