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
        setlocale(LC_ALL,"es_ES");
        if (is_array($datos) && count($datos) > 0) {
            $output = array(); // Crear un array para almacenar los datos
            foreach ($datos as $row) {
                if ($row['fecha_modi']==="0000-00-00 00:00:00" or $row['fecha_modi']===NULL){
                    $fecha_mod="Sin cambios";
                }
                else{
                    $fecha_mod=date('d',strtotime($row["fecha_modi"]))." de ".date('M',strtotime($row["fecha_modi"])).",".date('Y',strtotime($row["fecha_modi"]));
                }
                $fecha=date("d", strtotime($row['fecha_crea']))." de ".date("M", strtotime($row['fecha_crea'])).",".date("Y", strtotime($row['fecha_crea']));
                //$crea = new date();
                $crea = new DateTime($row['fecha_crea']);
                $hoy = new DateTime('now');
                $diff =  $crea -> diff($hoy);
                $dias = $diff->days;
                if ($dias < 2) {
                    $new = 'Nuevo | ';
                } else {
                    $new = '';
                }
                
                $output[] = array(
                    'codigo' => $row['codigo_productos'],
                    'nombre' => $row['nombre_productos'],
                    'tipo' => $row['Tipo'],                    
                    'presentacion' => $row['NPres'],
                    'cantidad' => $row['cantidad_productos'],
                    'movimiento' => $row['movi'],
                    'fecha_reg' => $fecha,     
                    'fecha_mod' => $fecha_mod,
                    'dias' => $dias,
                    'tiempo' => $new
                );
            }
            echo json_encode($output);
        }
        break;
}
