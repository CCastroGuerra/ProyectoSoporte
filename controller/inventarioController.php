<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class inventario{
    private $idInventario;
    private $productoId;
    private $cantidad;

    public function __construct($idInventario, $productoId, $cantidad)
    {
        $this->idInventario = $idInventario;
        $this->productoId = $productoId;
        $this->cantidad = $cantidad;
    }
}
?>