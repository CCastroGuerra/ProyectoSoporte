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
/* 
$pass="mypassword";
$passmd5 = md5($pass);
echo "passmd5= ", $passmd5,"<br>";
$hashed_password = crypt($passmd5,$cryptoword);
echo "hashed_password= ",$hashed_password,"<br>";

$str = "mypasword";
$user_input = md5($str);
echo "user_input= ",$user_input,"<br>";
echo "user_input= ",crypt($user_input,$cryptoword),"<br>";*/

/* Se deben pasar todos los resultados de crypt() como el salt para la comparación de una
   contraseña, para evitar problemas cuando diferentes algoritmos hash son utilizados. (Como
   se dice arriba, el hash estándar basado en DES utiliza un salt de 2
   caracteres, pero el hash basado en MD5 utiliza 12.) */
/*
   if (hash_equals($hashed_password, crypt($user_input, $hashed_password))) {
   echo "¡Contraseña verificada!";
}
else{
	echo "Contraseña erronea";
} */

?>