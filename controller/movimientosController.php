<?php
require_once("../config/conexion.php");
require_once("../model/movimientosModel.php");

$movimientos = new Movimiento();

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case 'listarTecnicos':
        $movimientos->listarTecnicos();
        break;
    case 'listarArea':
        $movimientos->listarArea();
        break;
    case "mostrarMovimientoXid":
        // var_dump($_POST);
        $datos = $movimientos->traerMovimientoXId($_POST['idMov']);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row["id_translado"];
                $output['tipoMovimientoId'] = $row["tipo_movimiento"];
                $output['tecnicoId'] = $row["tecnico_id"];
                $output['nombreTecnico'] = $row["NombreTecnico"];
                $output['observacion'] = $row["observacion"];
            }
            echo json_encode($output);
        }
        break;
    case "mostrarAreaXEquipo":
        // var_dump($_POST);
        $datos = $movimientos->traerAreaXId($_POST['codEquipo']);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row["id_equipos"];
                $output['areaId'] = $row["area_id"];
                $output['nombreArea'] = $row["nombre_area"];
            }
            echo json_encode($output);
        }
        break;
    case "guardarMovimiento":
        //var_dump($_POST);
        $movimientos->guardarMovimiento($_POST["selTipo"], $_POST["selTecnico"], $_POST["fallaObservada"]);
        break;
    case "guardarEquipo":
        var_dump($_POST);
        $movimientos->guardarEquipo($_POST["codEquipo"], $_POST["areaOR"], $_POST["selServicio"], $_POST["idMov"]);
        break;
    case "listarTablaMovimiento":
        //var_dump($_POST);
        $movimientos->listarTablaMovimientos($_POST['idMov']);
        break;
    case "buscarMovimiento":
        //var_dump($_POST);
        //echo $_POST['pag'];
        $movimientos->buscarMovimiento(intval($_POST['pag']));
        break;
    case "eliminarEquipoMov":
        $movimientos->eliminarEquipoMov($_POST["id"]);
        break;
    case "actualizarMovimientos":
        //var_dump($_POST);
        $movimientos->actulizarDatosMovimietnos($_POST["id"], $_POST["selTipo"], $_POST["selTecnico"], $_POST["fallaObservada"]);
        echo "actualizado correctamente";
        break;
    case "eliminar":
        var_dump($_POST);
        $movimientos->eliminar($_POST["id"]);
        break;
}
