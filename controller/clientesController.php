<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class clientes{
    private $idClientes;
    private $nombreCliente;
    private $esActivo;

    public function __construct( $idClientes, $nombreCliente, $esActivo){
        $this->idClientes = $idClientes;
        $this->nombreCliente = $nombreCliente;
        $this->esActivo = $esActivo;
    }
}
?>