<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();
//listarAlmacen();

class almacen{
    private $idAlmacen;
    private $productoId;
    private $fechaEntrada;
    private $fechaSalida;
    private $observaciones;
    private $cantidad;
    public function __construct($idAlmacen, $productoId, $fechaEntrada, $fechaSalida, $observaciones, $cantidad) {
        $this->idAlmacen = $idAlmacen;
        $this->productoId = $productoId;
        $this->fechaEntrada = $fechaEntrada;
        $this->fechaSalida = $fechaSalida;
        $this->observaciones = $observaciones;
        $this->cantidad = $cantidad;
    }
}



?>