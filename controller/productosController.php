<?php
require_once("../config/conexion.php");
require_once("../model/productosModel.php");
$producto = new Producto();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $producto-> listarProductos();
        break;

    case "guardar":
        //var_dump($_POST);
        $producto-> agregarProductos($_POST['nombre'],$_POST['cantidad'],$_POST['selAlmacen']);
        break;

    case "actualizar":
        //var_dump($_POST);
            $personal ->actulizarPersonal($_POST['id'],$_POST['apellido'],$_POST["nombre"],$_POST['usuario'],$_POST['password'],$_POST['selCargo']);
            echo "actualizado correctamente";
            break;
    case "mostrar": 
        //var_dump($_POST);

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
    case "eliminar":
        $personal -> eliminarPersonal($_POST["id"]);
        break;
    case "buscar":
            //var_dump($_POST);
            $personal ->buscarPersonal(intval($_POST['pag']));
            break;
    
}

?>