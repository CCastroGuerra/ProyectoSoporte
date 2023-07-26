<?php
require_once("../config/conexion.php");
require_once("../model/areaModel.php");
$area = new Area();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
        // case "listar":
        //     // $area-> listarArea();
        //     // break;
    case "guardar":
        $area->agregarArea($_POST["nombre_area"]);
        break;
    case "mostrar":
        $datos = $area->traerAreaXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row['id_area'];
                $output['nombre'] = $row['nombre_area'];
            }
            echo json_encode($output);
        }
        break;
    case "actualizar":
        $area->actulizarArea($_POST["id"], $_POST["nombre"]);
        echo "actualizado correctamente";
        break;
    case "eliminar":
        $area->eliminarArea($_POST["id"]);
        break;
    case "buscar":
        //var_dump($_POST);
        $area->buscarArea(intval($_POST['pag']));
}
