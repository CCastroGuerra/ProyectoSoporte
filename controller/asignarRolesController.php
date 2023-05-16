<?php
require_once("../config/conexion.php");
require_once("../model/asignarRolesModel.php");

$asignar = new asignarRoles();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        // var_dump($_POST);

        $asignar -> obtenerDatosPersonal($_POST['dni']); // Enviar los datos obtenidos como respuesta JSON
        break;
      
    
    case "guardar":
        $asignar -> guardarRoles($_POST['apellidos'],$_POST['nombre'],$_POST['combo']);
        break;
    case "listarCombo":
        $asignar -> listarRol();
        break;
}

?>