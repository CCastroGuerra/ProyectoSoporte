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
        $producto-> agregarProductos($_POST['nombreProducto'],$_POST['ctdProducto'],$_POST['selAlmacen']);
        break;

    case "actualizar":
        //var_dump($_POST);
            $producto ->actualizarProductos($_POST['id'],$_POST['nombre'],$_POST["cantidad"],$_POST['selAlmacen']);
            echo "actualizado correctamente";
            break;
    case "mostrar": 
        //var_dump($_POST);

        $datos = $producto->traeProductosXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row['id_productos'];
                    $output['nombre'] = $row['nombre_productos'];
                    $output['cantidad'] = $row['cantidad'];
                    $output['almacen'] = $row['almacen_id'];
                    
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
        $producto -> eliminarProductos($_POST["id"]);
        break;
    case "buscar":
            //var_dump($_POST);
            $producto ->buscarProductos(intval($_POST['pag']));
            break;
    
}

?>