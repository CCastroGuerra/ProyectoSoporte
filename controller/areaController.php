<?php
require_once("../config/conexion.php");
require_once("../model/areaModel.php");

$area = new Area();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch($accion){
    case "listar":
    $area-> listarArea();
    break;

    case "guardar":
       $area->agregarArea($_POST['nombre_area']);

        //$area ->registrarArea($_POST["nombre"]);
        break;
    case "buscar":
        $area->buscarArea($_POST['valor'],$_POST['pagina'],$_POST['cantidad']);

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