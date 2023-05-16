<?php
require_once("../config/conexion.php");
require_once("../model/asignarRolesModel.php");

$asignar = new asignarRoles();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $asignar -> obtenerDatosPersonal($_POST['dni']); // Enviar los datos obtenidos como respuesta JSON
        break;
    case "listarTabla":
        $asignar -> listarRoles();
        break;  
    case "guardar":
        $asignar -> guardarRoles($_POST['id'],$_POST['combo']);
        break;
    case "listarCombo":
        $asignar -> listarComboRol();
        break;
    case "mostrar":
        $datos = $asignar->traerAsigRolXId($_POST["id"]);
            if(is_array($datos)==true && count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row['id_rol_personal'];
                    $output['dni'] = $row['nombre_usuario'];
                    $output['nombreRol'] = $row['rol_id'];


                }
                echo json_encode($output);
            }
        break;
    case "eliminar":
            $asignar -> eliminarAsigRol($_POST["id"]);
            break;
    case "buscar":
            //var_dump($_POST);
            $asignar ->buscarAsigRol(intval($_POST['pag']));
            break;
    case "actualizar":
            var_dump($_POST);
             $asignar ->actulizarAsigRol($_POST['id'],$_POST["combo"]);
                echo "actualizado correctamente";
                break;
}

?>