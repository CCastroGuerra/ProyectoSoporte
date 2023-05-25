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
        $modelo->agregarModelo($_POST['nombreModelo'],$_POST["selMarca"]);
        break;
    case "actualizar":
        //var_dump($_POST);
        $modelo ->actulizarModelo($_POST['id'],$_POST['nombre'],$_POST["combo"]);
        echo "actualizado correctamente";
        break;
    case "mostrar": 
        //var_dump($_POST);
        $datos = $modelo->traeModeloXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['nro'] = $row['NRO'];
                    $output['id'] = $row['id_modelo'];
                    $output['nombre'] = $row['nombre_modelo'];
                    $output['nombreMarca'] = $row['marca_id'];
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
            $modelo -> eliminarModelo($_POST["id"]);
            break;
    case "buscar":
            //var_dump($_POST);
            $modelo ->buscarModelo(intval($_POST['pag']));
}


?>