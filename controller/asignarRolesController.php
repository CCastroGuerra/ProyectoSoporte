<?php
require_once("../config/conexion.php");
require_once("../model/asignarRolesModel.php");

$asignar = new asignarRoles();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $asignar -> obtenerDatosPersonal($_POST['inputDni']);
        break;
    case "guardar":
        $asignar -> guardarRoles($_POST['apellido'],$_POST['nombre'],$_POST['combo']);
        break;
    case "listarCombo":
        $asignar -> listarRol();
        break;
}

?>