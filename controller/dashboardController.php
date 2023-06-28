<?php
require_once("../config/conexion.php");
require_once("../model/dashboardModel.php");
$dashboard = new Dashboard();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "mostrarDatos":
        $datos = $dashboard->traerTrabajosXMes();
        if (is_array($datos) && count($datos) > 0) {
            $output = array(); // Crear un array para almacenar los datos
            foreach ($datos as $row) {
                $output[] = array(
                    'mes' => $row['mes_nombre'],
                    'cantidad' => $row['cantidad_trabajos']
                );
            }
            echo json_encode($output);
        }
        break;
    case "mostrarTrabajosArea":
        $datos = $dashboard->traerTrabajosxArea();
        if (is_array($datos) && count($datos) > 0) {
            $output = array(); // Crear un array para almacenar los datos
            foreach ($datos as $row) {
                $output[] = array(
                    'area' => $row['nombre_area'],
                    'cantidad' => $row['cantidad_trabajos']
                );
            }
            echo json_encode($output);
        }
        break;
}
