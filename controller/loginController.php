<?php

require_once("../config/conexion.php");
require_once("../model/loginModel.php");

$login = new Login();
//$test = ($_POST["usuario"]);

$datos = $login->buscarUsuario(trim($_POST["usuario"]));

if (is_array($datos) == true && count($datos) > 0) {
    foreach ($datos as $row) {
        $output["id"] = $row["id_usuario"];
        $output['passwd'] = $row['usuario_password'];
        $output['idper'] = $row['personal_id'];

        if ($row['usuario_password'] == trim($_POST['passwd'])) {
            //busca el nombre del usuario
            $usuario = $login->buscarPersonal($row['personal_id']);
            $apellidos = $usuario[0]['apellidos_personal'];
            $apm=explode(" ",$apellidos);
            if (count($apm)==1) {
                $aps=substr($apm[0],0,1).".";                
            } else {
                $aps=substr($apm[0],0,1).".". substr($apm[1],0,1).".";
                //echo session_regenerate_id();
            }                
            $ar = $usuario[0]['nombre_personal'] . " " .$aps;
            
            //$output['nombre_usuario'] = session_id()."-".$ar;
            //echo $ar;
            //busca el rol del usuario
            $brol = $login->buscarRol($row['id_usuario']);
            $rol =$brol[0]['nombre_roles'];
            

            session_start(); 
            
            $_SESSION['id']=session_id();
            $output['nombre_usuario'] = $_SESSION['id']."-".$ar;
            $_SESSION['personal_id'] = $row['personal_id'];
            $_SESSION['nombre'] = $ar;
            $_SESSION['rol'] = $rol;

            //header("Location: ../index.php");
        } else {
            //echo "la contraseña no coincide";
            $output['negativo'] = "0";
        }
    }

    echo json_encode($output);
} else {
    //echo "NO existe usuario";
    $output['negativo'] = "0";
    echo json_encode($output);
}
?>
