<?php
require_once("../config/conexion.php");
require_once("../model/personalModel.php");
$personal = new Personal();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $area-> listarArea();
        break;
   

}

?>