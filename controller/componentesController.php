<?php
require_once("../config/conexion.php");
require_once("../model/componentesModel.php");

$componente = new Componente();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarModel":
        $componente -> listarSelectModelo($_POST['id']);
        break;
    case "listarMarca":
        $componente -> listarSelectMarca();
        break;
}

?>