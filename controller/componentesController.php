<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarModel":
        $componente -> listarSelectModelo($_POST['id']);
        break;
    case "listarMarca":
        $componente -> listarSelectMarca();
        break;
}

    public function __construct($idComponentes, $tipoComponentesId, $claseComponentesId, $marcaId, $modeloId, $serie, $estadoId, $esActivo){
        $this->idComponentes = $idComponentes;
        $this->tipoComponentesId = $tipoComponentesId;
        $this->claseComponentesId = $claseComponentesId;
        $this->marcaId = $marcaId;
        $this->modeloId = $modeloId;
        $this->serie = $serie;
        $this->estadoId = $estadoId;
        $this->esActivo = $esActivo;
    }
}
?>