<?php
class Usuario
{
    protected $cuil;
    protected $mail;
    protected $roles;
    protected $nombre;
    protected $apellido;
    protected $estado;

    public function __construct($cuil, $mail, $roles, $nombre, $apellido, $estado)
    {
        $this->cuil = $cuil;
        $this->mail = $mail;
        $this->roles = $roles;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->estado = $estado;
    }


    public function getCuil() {return $this->cuil;}
    public function setCuil($cuil) {$this->cuil = $cuil;}
    public function getMail() {return $this->mail;}
    public function setMail($mail) {$this->mail = $mail;}
    public function setRol($roles) {$this->roles = $roles;}
    public function getRol() {return $this->roles;}    
    public function getNombre() {return $this->nombre;}
    public function setNombre($nombre) {$this->nombre = $nombre;}
    public function getApellido() {return $this->apellido;}
    public function setApellido($apellido) {$this->apellido = $apellido;}
    public function getEstado(){return $this->estado;}
    public function setEstado($estado) {$this->estado = $estado;}

    // public function setDatos($nombre_usuario, $nombre, $apellido, $email)
    // {
    //     $this->usuario = $nombre_usuario;
    //     $this->nombre = $nombre;
    //     $this->apellido = $apellido;
    //     $this->email = $email;
    // }
}
?>