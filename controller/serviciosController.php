<?php
require_once("../config/conexion.php");
require_once("../model/serviciosModel.php");
$servicio = new Servicio();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "listar":
        $servicio->listarServicio();
        break;
    case "guardar":
        var_dump($_POST);
        $servicio->agregarServicio($_POST["nombreServicio"], $_POST['selecTipo'], $_POST['checkConsumible']);
        break;
    case "mostrar":
        $datos = $servicio->traerServicioXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row['id_servicios'];
                $output['nombre'] = $row['nombre_servicios'];
                $output['tipo'] = $row['tipoTrabajo'];
                $output['consumible'] = $row['requiere_consumible'];
            }
            echo json_encode($output);
        }
        break;
    case "actualizar":
        $servicio->actualizarServicio($_POST["id"], $_POST["nombre"], $_POST['selecTipo'], $_POST['checkConsumible']);
        echo "actualizado correctamente";
        break;
    case "eliminar":
        $servicio->eliminarServicio($_POST["id"]);
        break;
    case "buscar":
        //var_dump($_POST);
        $servicio->buscarServicio(intval($_POST['pag']));
}
