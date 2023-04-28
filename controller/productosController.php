<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class productos{
    private $idProductos;
    private $nombreProductos;
    private $cantidad;
    private $almacenId;
    private $esActivo;

    public function __construct($idProductos, $nombreProductos, $cantidad, $almacenId, $esActivo)
    {
        $this->idProductos = $idProductos;
        $this->nombreProductos = $nombreProductos;
        $this->cantidad = $cantidad;
        $this->almacenId = $almacenId;
        $this->esActivo = $esActivo;
    }
}
?>