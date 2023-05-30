<?php
require_once("../config/conexion.php");
require_once("../model/equiposModel.php");

$equipo = new Equipos();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case "traerComponentes":
        $equipo -> obtenerDatosComponentes($_POST['codigo']); // Enviar los datos obtenidos como respuesta JSON
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
    case "guardarTempo":
        $equipo->guardarComponetesTemp($_POST['codigo']);
        break;
    case "listarTablaTempo":
            //var_dump($_POST);
        $equipo -> listarTablaTemp();
        break;
    case "guardarEquipoComponente":
        //  var_dump($_POST);
        $equipo -> guardarEquipoComponente($_POST['serie']);
        break;
    case "guardarEquipo":
        $equipo -> guardarEquipo($_POST['selTipoEquipo'],$_POST['serie'],$_POST['margesi'],$_POST['selMarcaEquipo'],$_POST['selModeloEquipo'],$_POST['responsable'],$_POST['selArea'],$_POST['selEstado'],$_POST['mac'],$_POST['ip']);
        break;
    case "eliminarComponenteTemp":
        $equipo -> eliminarComponentesTemp($_POST['id']);
        break;
    case "buscarEquipos":    
        $equipo -> buscarEquipo(intval($_POST['pag']));
        break;
}

?>