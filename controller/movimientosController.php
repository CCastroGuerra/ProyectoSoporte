<?php
require_once("../config/conexion.php");
require_once("../model/movimientosModel.php");

$movimientos = new Movimiento();

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case 'listarTecnicos':
        $movimientos->listarTecnicos();
        break;
    case 'listarArea':
        $movimientos->listarArea();
        break;

    default:
        # code...
        break;
}
