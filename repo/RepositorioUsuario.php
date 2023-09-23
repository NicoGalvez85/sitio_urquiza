<?php
require_once '.env.php';
require_once 'modelos/Usuario.php';

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

        try {
            $queryP->execute();
            foreach ($roles as $rol_id) {
                $queryR->bind_param("si", $cuil, $rol_id);
                    try {
                        $queryR->execute();
                    } catch (mysqli_sql_exception $e) {
                        return [false, "Error de Roles"];
                    }
               }
               return true;
        } catch (mysqli_sql_exception $e) {
            return [false, "No se pudo crear el usuario debido a incompatibilidades con BBDD."];
        }
    }


    public function buscarPorCUIL($cuil)
    {
        $q = "SELECT cuil, nombre, apellido, mail, estado FROM persona WHERE cuil = ?";
        
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $cuil);
        
        if ($query->execute()) {
            $query->bind_result($cuil, $nombre, $apellido, $mail, $estado);
            
            if ($query->fetch()) {
                $query->close();
        
                $roles = $this->obtenerRolesPorCUIL($cuil);
                
                return new Usuario($cuil, $mail, $roles, $nombre, $apellido, $estado);
            }
        }
        return false;
    }
    
    public function obtenerRolesPorCUIL($cuil)
    {
        $roles = array();
        
        $q = "SELECT rol_id_rol FROM persona_roles WHERE persona_cuil = ?";
        
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $cuil);
        
        if ($query->execute()) {
            $query->bind_result($rol_id);
            
            while ($query->fetch()) {
                $roles[] = $rol_id;
            }
        }
        else{
            return false;
        }
        
        return $roles;
    }


    public function actualizar(Usuario $u, $clave)
    {
        $q = 'call actualizar_datos(?,?,?,?,?,?)';
        $queryP = self::$conexion->prepare($q);

        $cuil = $u->getCuil();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $mail = $u->getMail();
        $estado = $u->getEstado();

        if (strlen($clave)>0){
            $clave = password_hash($clave, PASSWORD_DEFAULT);
        }
        $queryP->bind_param("isssis", $cuil, $nombre, $apellido, $mail, $estado, $clave);
        $ms='Anda hasta acá';

        if ($queryP->execute()){
            $queryP->close();
            $qd= 'call delete_roles(?)';
            $queryd = self::$conexion->prepare($qd);
            $queryd->bind_param("i", $cuil);

            if ($queryd->execute()){
                $queryd->close();
                $roles = $u->getRol();

                $qi = 'call actualizar_roles(?,?)';
                $queryi = self::$conexion->prepare($qi);
                foreach ($roles as $rol_id){
                    $queryi->bind_param("ii", $cuil , $rol_id);
                    if($queryi->execute()){
                        continue;
                    }else{
                        return [false, "Error de Roles"];
                    }
                }
                return true;
            }else{
                return [false, "Error de Roles"];
            }
        }else{
            return [false, "No se pudo Modificar el usuario debido a incompatibilidades con BBDD."];
        }
    }
}
?>