<?php
require_once("../config/conexion.php");
require_once("../model/dashboardModel.php");
$dashboard = new Dashboard();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "mostrarDatos":
        $datos = $dashboard->traerTrabajosXMes();
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['mes'] = $row['mes'];
                $output['cantidad'] = $row['cantidad_trabajos'];
            }
            echo json_encode($output);
        }
        break;
}
