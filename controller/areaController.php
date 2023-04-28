<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class area{
    private $idArea;
    private $nombreArea;

    public function __construct($idArea,$nombreArea){
        $this->idArea = $idArea;
        $this->nombreArea = $nombreArea;
    }
}
?>