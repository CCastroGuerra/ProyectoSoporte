<?php
require_once("../config/conexion.php");
require_once("../model/inventarioModel.php");

$inventario = new Inventario();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "salidaProducto":
        //var_dump($_POST);
        $inventario->salidaProductos($_POST['codProducto'], $_POST['cantidad']);
        break;
    case "entradaProducto":
        $inventario->entradaProductos($_POST['codProducto'], $_POST['cantidad']);
        break;
    case "traerNombreProducto":
        $inventario->nombreProducto($_POST['codProducto']);
        break;
    case "guardarEntrada":
        var_dump($_POST);
        $inventario->guardarEntrada($_POST['cantidad'], $_POST['selAccion'], $_POST['codProducto']);
        break;
    case "guardarSalida":
        $inventario->guardarSalida($_POST['cantidad'], $_POST['selAccion'], $_POST['codProducto']);
        break;
    case "buscarEntradas":
        $inventario->buscarEntradas(intval($_POST['pag']));
        break;
    case "buscarSalidas":
        $inventario->buscarSalidas(intval($_POST['pag']));
        break;
    case "buscarResumen":
        $inventario->buscarResumen(intval($_POST['pag']));
        break;
}
