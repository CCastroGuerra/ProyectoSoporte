<?php
require_once("../config/conexion.php");
require_once("../model/areaModel.php");

$area = new Area();

switch($_GET["opcion"]){
    case "listar":
    $area-> traerAreas();
    break;

    case "guardaryeditar":
        $datos=$area->traerAreaXId($_POST["id_area"]);
            if(empty($_POST["id_area"])){
                if(is_array($datos)==true and count($datos)==0){
                    $area->registrarArea($_POST["nombre_area"]);
                }
            }else{
                $area ->actualizarArea($_POST["id_area"],$_POST["nombre_area"]);

            }
        //$area ->registrarArea($_POST["nombre"]);
        break;
    case "mostrar":
        $datos = $area->traerAreaXId($_POST["id"]);
        if(is_array($datos)==true && count($datos)>0){
            foreach($datos as $row){
                $output['id_area'] = $row['id_area'];
                $output['nombre_area'] = $row['nombre_area'];
               
            }
            echo json_encode($output);
        }
        break;
    case "eliminar":
            $area-> eliminarArea($_POST["id"]);
            break;
    // case "actualizar":
    //     $area ->actualizarArea($_POST["id"],$_POST["nombre"]);
    //     echo "actualizado correctamente";
    //     break;
}

?>