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
        var_dump($_POST);
        $personal-> agregarPersonal($_POST['apellidos'],$_POST['nombre'],$_POST['usuario'],$_POST['password'],$_POST['selCargo']);

    case "actualizar":
            // var_dump($_POST);
            $personal ->actulizarPersonal($_POST['inputCodigo'],$_POST['apellidos'],$_POST["nombre"],$_POST['usuario'],$_POST['password'],$_POST['selCargo']);
            echo "actualizado correctamente";
            break;
    case "mostrar": 
        
        $datos = $personal->traePersonalXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row['id_personal'];
                    $output['apellidos'] = $row['apellidos_personal'];
                    $output['nombre'] = $row['nombres_personal'];
                    $output['cargoId'] = $row['cargoId'];
                    $output['cargoPersonal'] = $row['cargoPersonal'];
                    $output['nombreUsuario'] = $row['nombre_usuario'];
                    $output['contraseña'] = $row['password_usuario'];
                    
                }
                echo json_encode($output);
            }
            break;
    
}

?>