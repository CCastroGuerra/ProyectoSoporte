<?php
require_once("../config/conexion.php");
require_once("../model/trabajosModel.php");

$trabajo = new Trabajos();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "mostrarDetallesEquipo":
        $datos = $trabajo->detallesEquipoXSerie($_POST['serie']);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row["id_equipos"];
                $output['margesi'] = $row["margesi"];
                $output['nombrePersonalId'] = $row["clientes_id"];
                $output['nombrePersonal'] = $row["NombrePersonal"];
                $output['nombreArea'] = $row["nombre_area"];
                $output['nombreTipo'] = $row["nombre_tipo_equipo"];
                $output['nombreMarca'] = $row["nombre_marca"];
                $output['nombreModelo'] = $row["nombre_modelo"];
            }
            echo json_encode($output);
        }
        break;
    case "listarServicios":
        $trabajo->listarServicios();
        break;
    case "listarTecnicos":
        $trabajo->listarTecnicos();
        break;
    case "guardarServiciosTemp":
        $trabajo->guardarServicioTemp($_POST['idtrabajo'], $_POST['idEquipo'], $_POST['idServicios']);
        break;
    case "listarTablaTempServicios":
        $trabajo->listarTablaTempServicios();
        break;
    case "guardarTrabajos":
        $trabajo->guardarTrabajos($_POST["idTrabajo"], $_POST["idTecnico"], $_POST['idEquipo'], $_POST['idResponables'], $_POST['idArea'], $_POST['falla'], $_POST['solucion'], $_POST['recomendacion']);
        break;
    case "guardarTrabajosServicios":
        //var_dump($_POST);
        $trabajo->guardarTrabajoServicios($_POST['inputCodigo']);
        break;
    case "buscarTrabajos":
        $trabajo->buscarTrabajos(intval($_POST['pag']));
        break;
    case "mostrar":
        //var_dump($_POST);
        $datos = $trabajo->traerTrabajosXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['idEquipos'] = $row["id_equipos"];
                $output['id'] = $row["id_trabajos"];
                $output['serie'] = $row["serie"];
                $output['margesi'] = $row["margesi"];
                $output['nombreResponsable'] = $row["NombreResponsable"];
                $output['tipoEquipo'] = $row["nombre_tipo_equipo"];
                $output['nombreArea'] = $row["nombre_area"];
                $output['nombreMarca'] = $row["nombre_marca"];
                $output['nombreModelo'] = $row["nombre_modelo"];
                $output['falla'] = $row["falla"];
                $output['nombreTecnico'] = $row["tecnico_id"];
                $output['solucion'] = $row["solucion"];
                $output['recomendacion'] = $row["recomendacion"];
            }
            echo json_encode($output);
        }
        break;
    case "inserTablaTempActualizar":
        //var_dump($_POST);
        $trabajo->llenarCompActualizar($_POST['id']);
        break;
    case "eliminarServiciosTemp":
        $trabajo->eliminarServiciosTemp($_POST['id']);
        break;
    case "botonCerrar":
        $trabajo->cerrarBoton($_POST['id']);
        break;
}
