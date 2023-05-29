<?php
require_once("../config/conexion.php");
require_once("../model/equiposModel.php");

$equipo = new Equipos();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case "traerComponentes":
        $equipo -> obtenerDatosComponentes($_POST['serie']); // Enviar los datos obtenidos como respuesta JSON
        break;
    case "listarModel":
        $equipo -> listarSelectModelo($_POST['id']);
        break;
    case "listarMarca":
        $equipo -> listarSelectMarca();
        break;
    case "listarTipo":
        $equipo -> listarTipoEquipo();
        break;
    case "listarArea":
        $equipo -> listarArea();
        break;
    case "listarEstado":
        $equipo -> listarEstado();
        break;
}

?>