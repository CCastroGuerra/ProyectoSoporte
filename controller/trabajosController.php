<?php
require_once("../config/conexion.php");
require_once("../model/trabajosModel.php");

$trabajo = new Trabajos();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "mostrarDetallesEquipo":
        $datos = $trabajo->detallesEquipoXSerie($_POST['codEquipo']);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row["id_equipos"];
                $output['margesi'] = $row["margesi"];
                $output['nombrePersonalId'] = $row["clientes_id"];
                $output['nombrePersonal'] = $row["NombrePersonal"];
                $output['areaID'] = $row["area_id"];
                $output['nombreArea'] = $row["nombre_area"];
                $output['tipoId'] = $row["tipo_equipo_id"];
                $output['nombreTipo'] = $row["nombre_tipo_equipo"];
                $output['nombreMarca'] = $row["nombre_marca"];
                $output['nombreModelo'] = $row["nombre_modelo"];
            }
            echo json_encode($output);
        }
        break;
    case "listarServicios":
        $trabajo->listarServicios($_POST['valor']);
        break;
    case "listarTecnicos":
        $trabajo->listarTecnicos();
        break;
    case "guardarServiciosTemp":
        //var_dump($_POST);
        $trabajo->guardarServicioTemp($_POST['idtrabajo'], $_POST['idEquipo'], $_POST['selServicio']);
        break;
    case "listarTablaTempServicios":
        $trabajo->listarTablaTempServicios();
        break;
    case "guardarTrabajos":
        $trabajo->guardarTrabajos($_POST["inputCodigo"], $_POST["selTecnico"], $_POST['idEquipo'], $_POST['nombreUsuarioID'], $_POST['selAreaID'], $_POST['fallaObservada'], $_POST['textSolucion'], $_POST['textrecom'], $_POST['consumible']);
        break;
    case "guardarTrabajosServicios":
        //var_dump($_POST);
        $trabajo->guardarTrabajoServicios($_POST['inputCodigo'], $_POST['codigoProducto']);
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
                $output['codigoProducto'] = $row["codigo_productos"];
                $output['nombrePersonalId'] = $row["responsable_id"];
                $output['nombreResponsable'] = $row["NombreResponsable"];
                $output['tipoEquipo'] = $row["nombre_tipo_equipo"];
                $output['nombreArea'] = $row["nombre_area"];
                $output['areaID'] = $row["area_id"];
                $output['tipoEquipoId'] = $row["tipo_equipo_id"];
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
    case "mostrarProductoXCod":
        // var_dump($_POST);
        $datos = $trabajo->traerProductoXCodigo($_POST['consumible']);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['nombreProducto'] = $row["nombre_productos"];
                $output['cantidad'] = $row["cantidad_productos"];
            }
            echo json_encode($output);
        }
        break;
    case "mostrarEnTabla":
        $datos2 = $trabajo->imprimirTrabajo($_POST['id']);
        if (is_array($datos2) == true && count($datos2) > 0) {
            foreach ($datos2 as $row) {
                $output['correlativo'] = $row["codigo_correlativo"];
                $output['idEquipos'] = $row["equipo_id"];
                $output['tipoEquipoId'] = $row["id_tipo_equipo"];
                $output['nombreTipoEquipo'] = $row["nombre_tipo_equipo"];
                $output['id'] = $row["id_trabajos"];
                $output['idTipoTrabajo'] = $row["tipoTrabajo"];
                $output['serie'] = $row["serie"];
                $output['margesi'] = $row["margesi"];
                $output['nombrePersonalId'] = $row["responsable_id"];
                $output['nombreResponsable'] = $row["NombreResponsable"];
                $output['tipoEquipo'] = $row["nombre_tipo_equipo"];
                $output['nombreArea'] = $row["nombre_area"];
                $output['areaID'] = $row["area_id"];
                $output['nombreMarca'] = $row["nombre_marca"];
                $output['nombreModelo'] = $row["nombre_modelo"];
                $output['falla'] = $row["falla"];
                $output['nombreTecnico'] = $row["tecnico_id"];
                $output['solucion'] = $row["solucion"];
                $output['recomendacion'] = $row["recomendacion"];
                $output['fecha'] = $row["Fecha"];
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
    case "salidaConsumibles":
        //var_dump($_POST);
        $trabajo->salidaConsumibles($_POST['consumible']);
        break;
    case "guardarConsumibles":
        //var_dump($_POST);
        $trabajo->guardarSalidaConsumibles($_POST['consumible']);
        break;
}
