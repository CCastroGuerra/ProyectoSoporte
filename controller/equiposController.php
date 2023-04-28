<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class equipos{
    private $idEquipos;
    private $codigo;
    private $tipoDeCodigoId;
    private $areaId;
    private $clientesId;
    private $estadoid;
    private $fechaAlta;
    private $ip;
    private $mac;
    private $esActivo;

    public function __construct($idEquipos, $codigo, $tipoDeCodigoId, $areaId, $clientesId, $estadoid, $fechaAlta, $ip, $mac, $esActivo){
        $this->idEquipos = $idEquipos;
        $this->codigo = $codigo;
        $this->tipoDeCodigoId = $tipoDeCodigoId;
        $this->areaId = $areaId;
        $this->clientesId = $clientesId;
        $this->estadoid = $estadoid;
        $this->fechaAlta = $fechaAlta;
        $this->ip = $ip;
        $this->mac = $mac;
        $this->esActivo = $esActivo;
    }

}
?>