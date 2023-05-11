<?php
require_once("../config/conexion.php");
require_once("../model/modeloModel.php");

$modelo = new Modelo();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarCombo":
        $modelo -> listarSelectMarca();
        break;
    case "listar":
        $modelo -> listarModelo();
        break;
    case "guardar":
        $modelo->agregarModelo($_POST['nombreMarca'],$_POST["selMarca"]);
        break;
    case "actualizar":
        //var_dump($_POST);
        $marca ->actulizarMarca($_POST['id'],$_POST['nombre'],$_POST["combo"]);
        echo "actualizado correctamente";
        break;
    case "mostrar": 
        $datos = $marca->traeMarcaXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row['id_marca'];
                    $output['nombre'] = $row['nombre_marca'];
                    $output['nombreCategoria'] = $row['categoria_marca_id'];
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
            $marca -> eliminarMarca($_POST["id"]);
            break;
    case "buscar":
            //var_dump($_POST);
            $marca ->buscarMarca(intval($_POST['pag']));
}


?>