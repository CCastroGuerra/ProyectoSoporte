<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class modelo{
    private $idModelo;
    private $nombreModelo;

    public function __construct($idModelo, $nombreModelo){
        $this->idModelo = $idModelo;
        $this->nombreModelo = $nombreModelo;
    }
}

?>