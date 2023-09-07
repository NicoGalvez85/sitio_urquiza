<?php
require_once 'modelos/Usuario.php';
require_once 'repo/RepositorioUsuario.php';

class ControladorSesion
{
    protected $usuario = null;

    public function login($nombre_usuario, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);
        if ($usuario === false)
        {
            return [false, "Error de credenciales"];
        } 
        else 
        {
            session_start();
            $rol = $usuario->getRol();
            $_SESSION['usuario'] = serialize($usuario);
            return [$rol, "Usuario autenticado correctamente"];
        }
    }

    public function create($cuil, $mail, $roles, $nombre, $apellido, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($cuil, $mail, $roles, $nombre, $apellido, $clave, true);
        
        $creat = $repo->save($usuario, $clave);

        if ($creat === false)
        {
            return [ false, "Error al crear el usuario"];
        }
        else 
        {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [ true, "Usuario creado correctamente" ];
        }
    }

    public function modificar($nombre_usuario, $nombre, $apellido, $email, Usuario $usuario)
    {
        $repo = new RepositorioUsuario();
        $usuario->setDatos($nombre_usuario, $nombre, $apellido, $email);

        if ($repo->actualizar($usuario))
        {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Los datos se actualizaron correctamente"];
        } 
        else
        {
            return [false, "Error al actualizar los datos"];
        }
    }

    public function eliminar(Usuario $usuario)
    {
        $repo = new RepositorioUsuario();
        if($repo->eliminar($usuario))
        {
            return [true, "Usuario eliminado correctamente"];
        } 
        else
        {
            return [false, "Error al eliminar el usuario"];
        }
    }
}
?>