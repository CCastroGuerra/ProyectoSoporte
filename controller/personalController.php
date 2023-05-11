<?php
require_once("../config/conexion.php");
require_once("../model/personalModel.php");
$personal = new Personal();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $personal-> listarPersonal();
        break;
    case "guardar":
        $personal-> agregarPersonal($_POST['inputCodigo'],$_POST['apellidos'],$_POST['nombre'],$_POST['selCargo'],$_POST['usuario'],$_POST['password']);
   

}

?>