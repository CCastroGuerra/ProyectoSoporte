<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class roles{
    private $idRoles;
    private $nombreRoles;

    public function __construct($idRoles,$nombreRoles){
      $this->idRoles = $idRoles;
      $this->nombreRoles = $nombreRoles;
    }
}
?>