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
    case "productosporterminarse":
        $datos = $dashboard->revisarProductosxTerm();
        if (is_array($datos) && count($datos) > 0) {
            $output = array(); // Crear un array para almacenar los datos
            foreach ($datos as $row) {
                $output[] = array(
                    'codigo' => $row['codigo_productos'],
                    'nombre' => $row['nombre_productos'],
                    'cantidad' => $row['cantidad_productos'],
                    'fecha_reg' => date("d-m-Y", strtotime($row['fecha_crea'])),     
                    'fecha_mod' => date("d-m-Y", $row['fecha_modi'])
                );
            }
            echo json_encode($output);
        }
        break;
}
