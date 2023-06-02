<?php
require_once("../config/conexion.php");
require_once("../model/productosModel.php");
$producto = new Producto();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listarCombo":
        $producto-> listarCombo();
        break;

    case "guardar":
        //var_dump($_POST);
        $producto-> agregarProductos($_POST['nombreProducto'],$_POST['selTipoProducto'],$_POST['selUnidad'],$_POST["ctdProducto"],$_POST['selAlmacen'],$_POST['detalleProducto']);
        break;
    case "guardarPresentacion":
        $producto -> agregarPresentacion($_POST['BuscarPre']);
        break;
    case "actualizar":
        //var_dump($_POST);
            $producto ->actualizarProductos($_POST['id'],$_POST['nombre'],$_POST['selTipoProducto'],$_POST['selUnidad'],$_POST["cantidad"],$_POST['selAlmacen'],$_POST['detalleProducto']);
            echo "actualizado correctamente";
            break;
    case "mostrar": 
        //var_dump($_POST);

        $datos = $producto->traeProductosXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    // $output['nro'] = $row['NRO'];
                    $output['id'] = $row['id_productos'];
                    $output['nombre'] = $row['nombre_productos'];
                    $output['tipoId'] = $row['tipoId'];
                    $output['tipo'] = $row['Tipo'];
                    $output['presentacionId'] = $row['presentacionId'];
                    $output['cantidad'] = $row['cantidad_productos'];
                    $output['almacenId'] = $row['almacenId'];
                    $output['almacen'] = $row['Almacen'];
                    $output['descripcion'] = $row['descripcion_productos'];

                    
                }
                echo json_encode($output);
            }
            break;
    case "eliminar":
        $producto -> eliminarProductos($_POST["id"]);
        break;
    case "eliminarPre":
        $producto -> eliminarPresentacion($_POST["idPre"]);
        break;
    case "buscar":
            //var_dump($_POST);
            $producto ->buscarProductos(intval($_POST['pag']));
            break;
    case "buscarPresentacion":
        $producto -> bucarPresentacion(intval($_POST['pag']));
        break;
}

?>