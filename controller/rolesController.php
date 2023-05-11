<?php
require_once("../config/conexion.php");
require_once("../model/rolesModel.php");
$rol = new Rol();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    case "listar":
        $rol->listarRol();
        break;
    case "guardar":
        $rol->agregarRol($_POST["inputRol"]);
        break;
    case "mostrar":
        $datos = $rol->traerRolXId($_POST["id"]);
        if(is_array($datos)==true && count($datos)>0){
            foreach($datos as $row){
                $output['id'] = $row['id_roles'];
                $output['nombre'] = $row['nombre_roles'];
            }
            echo json_encode($output);
        }
        break;
    case "actualizar":
            $rol ->actulizarRol($_POST["id"],$_POST["nombre"]);
            echo "actualizado correctamente";
            break;
    case "eliminar":
            $rol -> eliminarRol($_POST["id"]);
            break;
    case "buscar":
        //var_dump($_POST);
        $rol ->buscarRol(intval($_POST['pag']));

}

?>