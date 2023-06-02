<?php
require_once("../config/conexion.php");
require_once("../model/personalModel.php");
$personal = new Personal();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $personal-> listarPersonal();
        break;

    case "guardar":
        //var_dump($_POST);
        $personal-> agregarPersonal($_POST['apellidos'],$_POST['nombre'],$_POST['dniusuario'],$_POST['correo'],$_POST['telefono'],$_POST['selCargo']);
        break;
   

    case "actualizar":
        //var_dump($_POST);
            $personal ->actulizarPersonal($_POST['id'],$_POST['apellido'],$_POST["nombre"],$_POST['dniusuario'],$_POST['correo'],$_POST['telefono'],$_POST['selCargo']);
            echo "actualizado correctamente";
            break;
    case "mostrar": 
        //var_dump($_POST);

        $datos = $personal->traePersonalXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row['id_personal'];
                    $output['apellidos'] = $row['apellidos_personal'];
                    $output['nombre'] = $row['nombre_personal'];
                    $output['dniusuario'] = $row['dni_personal'];
                    $output['telefono'] = $row['telefono_personal'];
                    $output['correo'] = $row['correo_personal'];
                    $output['cargoId'] = $row['cargoId'];
                    $output['cargoPersonal'] = $row['cargoPersonal'];
                   
                    
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
        $personal -> eliminarPersonal($_POST["id"]);
        break;
    case "buscar":
            //var_dump($_POST);
            $personal ->buscarPersonal(intval($_POST['pag']));
            break;
    
}

?>