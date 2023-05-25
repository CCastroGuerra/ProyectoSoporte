<?php
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarModel":
        $componente -> listarSelectModelo();
        break;
    case "listarMarca":
        $componente -> listarSelectMarca($_POST['id']);
        break;
}

?>