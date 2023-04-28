<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class permisos{
    private $idPermisos;
    private $nombrePermisos;

    public function __construct($idPermisos,$nombrePermisos){
        $this->idPermisos = $idPermisos;
        $this->nombrePermisos = $nombrePermisos;
    }
}
?>