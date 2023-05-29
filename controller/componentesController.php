<?php
require_once("../config/conexion.php");
require_once("../model/componentesModel.php");

$componente = new Componente();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarModel":
        $componente -> listarSelectModelo($_POST['id']);
        break;
    case "listarMarca":
        $componente -> listarSelectMarca();
        break;
    case "listarComponentes":
        $componente -> listarTipoComponentes();
        break;
    case "listarClases":
        $componente ->listarSelectClaseComponente();
        break;
    case "listarEstado":
            $componente ->listarSelectEstado();
            break;
    case "buscar":
        //var_dump($_POST);
        $componente -> buscarComponente(intval($_POST['pag']));
        break;
    case "eliminar":
        $componente -> eliminarComponentes($_POST["id"]);
        break;
    case "mostrar": 
            //var_dump($_POST);
        $datos = $componente->traeComponenteXId($_POST["id"]);
             if(is_array($datos)==true && count($datos)>0){
                    foreach($datos as $row){
                        $output['id'] = $row["id_componentes"];
                        $output['nombreTipo'] = $row["tipo_componentes_id"];
                        $output['nombreClase'] = $row["clase_componentes_id"];
                        $output['nombreMarca'] = $row["marca_id"];
                        $output['nombreModelo'] = $row["modelo_id"];
                        $output['serie'] = $row["serie"];
                        $output['capacidad'] = $row["componentes_capacidad"];
                        $output['estado'] = $row["estado_id"];
                        $output['fecha'] = $row["Fecha"];
                    }
                    echo json_encode($output);
                }
        break;
    case "actualizar":
            //var_dump($_POST);
            $componente ->actulizarComponentes($_POST['id'],$_POST['nombreTipo'],$_POST["nombreClase"],$_POST["nombreMarca"],$_POST["nombreModelo"],$_POST["serie"],$_POST["capacidad"],$_POST["estado"],$_POST["fecha"]);
            echo "actualizado correctamente";
            break;

    case "guardar":
                $componente->agregarComponetes($_POST['selTipo'],$_POST["selClase"],$_POST["selMarca"],$_POST["selModelo"],$_POST["serie"],$_POST["capacidad"],$_POST["selEstado"],$_POST["Fecha"]);
                break;
}
