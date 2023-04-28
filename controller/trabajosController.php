<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class trabajos{
    private $idTrabajos;
    private $nombreTrabajo;
    private $clientesId;
    private $productosId;
    private $servicioId;
    private $equipoId;
    private $usuarioId;
    private $areaId;
    private $descripcion;

    public function trabajos($idTrabajos, $nombreTrabajo, $clientesId, $productosId, $servicioId, $equipoId, $usuarioId, $areaId, $descripcion){
        $this->idTrabajos = $idTrabajos;
        $this->nombreTrabajo = $nombreTrabajo;
        $this->clientesId = $clientesId;
        $this->productosId = $productosId;
        $this->servicioId = $servicioId;
        $this->equipoId = $equipoId;
        $this->usuarioId = $usuarioId;
        $this->areaId = $areaId;
        $this->descripcion = $descripcion;
    }
}

?>