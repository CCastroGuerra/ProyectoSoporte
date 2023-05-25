<?php

require_once("../config/conexion.php");
require_once("../model/loginModel.php");

$login = new Login();
session_start();
//$test = ($_POST["usuario"]);

$datos = $login->buscarUsuario(trim($_POST["usuario"]));

if (is_array($datos) == true && count($datos) > 0) {
    foreach ($datos as $row) {
        $output["id"] = $row["id_personal"];
        $output['passwd'] = $row['password_usuario'];
        $output['nombre'] = $row['nombres_personal'];

        if ($row['password_usuario'] == trim($_POST['passwd'])) {
            $_SESSION['id'] = $row['id_personal'];
            $_SESSION['nombre'] = $row['nombre_usuario'];

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
