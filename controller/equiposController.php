<?php
require_once("../config/conexion.php");
require_once("../model/equiposModel.php");

$equipo = new Equipos();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case "traerComponentes":
        $equipo -> obtenerDatosComponentes($_POST['codigo']); // Enviar los datos obtenidos como respuesta JSON
        break;
    case "listarModel":
        $equipo -> listarSelectModelo($_POST['id']);
        break;
    case "listarMarca":
        $equipo -> listarSelectMarca();
        break;
    case "listarTipo":
        $equipo -> listarTipoEquipo();
        break;
    case "listarArea":
        $equipo -> listarArea();
        break;
    case "listarEstado":
        $equipo -> listarEstado();
        break;
    case "buscarResponsable":
        $equipo -> buscarResponsable(intval($_POST['pag'])); 
        break;
    case "guardarTempo":
        //var_dump($_POST);
        $equipo->guardarComponetesTemp($_POST['codigo'],$_POST['margesi'],$_POST['inputCodigo']);
        break;
    case "listarTablaTempo":
            //var_dump($_POST);
        $equipo -> listarTablaTemp();
        break;
    case "guardarEquipoComponente":
        //var_dump($_POST);
        $equipo -> guardarEquipoComponente($_POST['inputCodigo']);
        break;
    case "guardarEquipo":
        //var_dump($_POST);
        $equipo -> guardarEquipo($_POST['inputCodigo'],$_POST['serie'],$_POST['margesi'],$_POST['selMarcaEquipo'],$_POST['selModeloEquipo'],$_POST['selTipoEquipo'],$_POST['selArea'],$_POST['respValue'],$_POST['selEstado'],$_POST['ip'],$_POST['mac']);
        break;
    case "eliminarComponenteTemp":
        $equipo -> eliminarComponentesTemp($_POST['id']);
        break;
    case "inserTablaTempActualizar":
        //var_dump($_POST);
        $equipo->llenarCompActualizar($_POST['id']);
        //$equipo->llenarCompActua($_POST['inputCodigo']);
        break;
    case "buscarEquipos":    
        $equipo -> buscarEquipo(intval($_POST['pag']));
        break;
    // case "mostrarComponentesEquipos":
    // $equipo-> componentesEquipoXId($_POST['id']);
    //  break;
     case "mostrar": 
        //var_dump($_POST);
        $datos = $equipo->traerEquipoXId($_POST["id"]);
         if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row["id_equipos"];
                    $output['nombreTipo'] = $row["id_tipo_componente"];
                    $output['serie'] = $row["serie"];
                    $output['margesi'] = $row["margesi"];
                    $output['nombreMarca'] = $row["id_marca"];
                    $output['nombreModelo'] = $row["id_modelo"];
                    $output['nombrePersonalId']= $row["id_personal"];
                    $output['nombrePersonal'] = $row["NombrePersonal"];
                    $output['area'] = $row["area_id"];
                    $output['estado'] = $row["estado_id"];
                    $output['mac'] = $row["mac"];
                    $output['ip'] = $row["ip"];

                   
                }
                echo json_encode($output);
            }
    break;
    /*case "actualizarTempComponentes":
        $equipo -> actualizarTempComponentes($_POST['id']);
        break;
        */
    case "botonCerrar":
        $equipo -> cerrarBoton($_POST['id']);
        break;


}

?>