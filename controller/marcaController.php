<?php
require_once("../config/conexion.php");
require_once("../model/marcaModel.php");

$marca = new Marca();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "listarCombo":
        $marca->listarSelectMarca();
        break;
        // case "listar":
        //     $marca -> listarMarcas();
        //     break;
    case "guardar":
        $marca->agregarMarca($_POST['nombreMarca'], $_POST["selMarca"]);
        break;
    case "actualizar":
        // var_dump($_POST);
        $marca->actulizarMarca($_POST['id'], $_POST['nombre'], $_POST["combo"]);
        echo "actualizado correctamente";
        break;
    case "mostrar":

        $datos = $marca->traeMarcaXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                // $output['nro'] = $row['NRO'];
                // $output['id'] = $row['id_marca'];
                $output['nombre'] = $row['nombre_marca'];
                $output['nombreCategoria'] = $row['categoria_marca_id'];
            }
            echo json_encode($output);
        }
        break;
    case "eliminar":
        $marca->eliminarMarca($_POST["id"]);
        break;
    case "buscar":
        //var_dump($_POST);
        $marca->buscarMarca(intval($_POST['pag']));
        break;
}
