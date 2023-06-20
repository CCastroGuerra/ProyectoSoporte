<?php
require_once("../config/conexion.php");
require_once("../model/bajasModel.php");

$bajas = new Bajas();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "guardarBajas":
        //var_dump($_POST);
        $bajas->guardarBaja($_POST['codigoEquipo'], $_POST['selArea'], $_POST['motivo']);
        break;

    case "editarEstadoEquipo":
        $bajas->editarEstadoEquipo($_POST['codigoEquipo']);
        break;
    case "eliminarBaja":
        var_dump($_POST);
        $bajas->eliminarBaja($_POST["id"]);
        break;
    case "actualizarBaja":
        var_dump($_POST);
        $bajas->actualizarrBaja($_POST["id"], $_POST['selArea'], $_POST['motivo']);
        break;
    case "mostrarBajas":
        $datos = $bajas->traerBajaXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row['id_bajas'];
                $output['serie'] = $row['serie'];
                $output['nombreTipoId'] = $row['tipo_baja'];
                $output['nombreTipo'] = $row['tipoBajas'];
                $output['motivo'] = $row['motivo'];
            }
            echo json_encode($output);
        }
        break;
    case "buscarBajas":
        //var_dump($_POST);
        $bajas->buscarBajas(intval($_POST['pag']));
        break;
    case "editarEstadoEquipo":
        $bajas->editarEstadoEquipo($_POST['codigoEquipo']);
        break;
}
