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
        $q1 = "SELECT cuil, password, nombre, apellido, mail, estado FROM persona ";
        $q1 .= "WHERE mail = ?";
        $query1 = self::$conexion->prepare($q1);
        $query1->bind_param("s", $mail);
        if ($query1->execute()) {
            $query1->bind_result($cuil, $clave_encriptada, $nombre, $apellido, $mail, $estado);
    
            if ($query1->fetch()) {
                if (password_verify($clave, $clave_encriptada) === true) {
                    if ($estado != 0) {
                        $query1->close(); // Cerrar la consulta $query1
    
                        $q2 = "SELECT rol_id_rol FROM persona_roles ";
                        $q2 .= "WHERE persona_cuil = ?";
                        $query2 = self::$conexion->prepare($q2);
                        $query2->bind_param("i", $cuil);
                        $query2->execute();
    
                        $roles = array();

                        $query2->bind_result($rol_id);
    
                        while ($row = $query2->fetch()) {
                            $roles[] = $rol_id;
                        }

                        $query2->close(); // Cerrar la consulta $query2
                        return new Usuario($cuil, $mail, $roles, $nombre, $apellido, $estado);
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