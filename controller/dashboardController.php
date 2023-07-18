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
                if ($row['fecha_modi']==="0000-00-00 00:00:00"){
                    $fecha_mod="Sin cambios";
                }
                else{
                    $fecha_mod=date('d',strtotime($row["fecha_modi"]))." de ".date('M',strtotime($row["fecha_modi"])).",".date('y',strtotime($row["fecha_modi"]));
                }
                $fecha=date("d", strtotime($row['fecha_crea']))." de ".date("M", strtotime($row['fecha_crea'])).",".date("Y", strtotime($row['fecha_crea']));
                $output[] = array(
                    'codigo' => $row['codigo_productos'],
                    'nombre' => $row['nombre_productos'],
                    'cantidad' => $row['cantidad_productos'],
                    'fecha_reg' => $fecha,     
                    'fecha_mod' => $fecha_mod
                );
            }
            echo json_encode($output);
        }
        break;
}
