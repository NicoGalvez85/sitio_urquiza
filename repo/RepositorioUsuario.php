<?php
require_once '.env.php';
require_once 'modelos/usuario.php';

class RepositorioUsuario
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion))
        {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error)
            {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
            }
            self::$conexion->set_charset('utf8');
        }
    }

    public function login($mail, $clave)
    {
        $q = "SELECT cuil, password, nombre, apellido, mail, rol_id, estado FROM persona ";
        $q.= "WHERE mail = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $mail);
        if ( $query->execute() )
        {
            $query->bind_result($cuil, $clave_encriptada, $nombre, $apellido, $mail, $rol, $estado);
            if ( $query->fetch() )
            {
                if( password_verify($clave, $clave_encriptada) === true)
                {
                    if($estado != 0){
                        return new Usuario($cuil, $mail, $rol, $nombre, $apellido, $estado);
                    }
                }
            }
        }
        return false;
    }

    public function save(Usuario $u, $clave)
    {
        $cuil = $u->getCuil();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $mail = $u->getMail();
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $roles = $u->getRol();
        $estado = 1;

        $queryPersona = 'INSERT INTO persona (cuil, nombre, apellido, mail, password, estado)';
        $queryPersona.= "VALUES (?, ?, ?, ?, ?, ?)";
        $queryP = self::$conexion->prepare($queryPersona);

        $queryP->bind_param("ssssss", $cuil, $nombre, $apellido, $mail, $clave, $estado);

        $queryRoles = 'INSERT INTO persona_roles (persona_cuil, rol_id_rol)';
        $queryRoles.= "VALUES (?, ?)";
        $queryR = self::$conexion->prepare($queryRoles);
        $succesP= $queryP->execute();

        foreach ($roles as $rol_id) {
            $queryR->bind_param("si", $cuil, $rol_id);
            $queryR->execute();
        }

        if ($succesP)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function actualizar(Usuario $u)
    {
        $q = "UPDATE usuarios ";
        $q.= "SET usuario = ?, nombre = ?, apellido = ?, email = ? ";
        $q.= "WHERE id = ?";
        $query = self::$conexion->prepare($q);

        $usuario = $u->getUsuario();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $email = $u->getEmail();
        $id = $u->getId();

        $query->bind_param("ssssd", $usuario, $nombre, $apellido, $email, $id);

        if ($query->execute())
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function eliminar(Usuario $u)
    {
        $q = "DELETE FROM usuarios WHERE id = ?";
        $query = self::$conexion->prepare($q);

        $id = $u->getId();

        $query->bind_param("d", $id);

        if ($query->execute())
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}
?>