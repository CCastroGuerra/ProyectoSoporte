<?php

    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        die();
    }
    session_regenerate_id();

    //$nombre = $_SESSION['nombre']; 
   // $tipo_usuario = $_SESSION['tipo_usuario'];
   
   // Establecer tiempo de vida de la sesión en segundos
   $inactividad = 6000;
   // Comprobar si $_SESSION["timeout"] está establecida
   if(isset($_SESSION["timeout"])){
       // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
       $sessionTTL = time() - $_SESSION["timeout"];
       if($sessionTTL > $inactividad){
           session_destroy();
           header("Location: ../logout.php");
           die();
       }
   }
   // El siguiente key se crea cuando se inicia sesión
   $_SESSION["timeout"] = time();

   function soloadmin(){
    $rolespermitidos = ['1'];
    if(!in_array($_SESSION['rol_ID'],$rolespermitidos)){
        header("Location: ../index.php");
        die();
    }
   }

?>