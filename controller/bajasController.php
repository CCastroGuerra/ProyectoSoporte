<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class bajas{
    private $idBajas;
    private $fechaBaja;
    private $motivo;
    private $descripcion;
    private $equipoId;
    private $usuariosId;

    public function __construct($idBajas, $fechaBaja, $motivo, $descripcion, $equipoId, $usuariosId){
        $this->idBajas = $idBajas;
        $this->fechaBaja = $fechaBaja;
        $this->motivo = $motivo;
        $this->descripcion = $descripcion;
        $this->equipoId = $equipoId;
        $this->usuariosId = $usuariosId;
    }
}
?>