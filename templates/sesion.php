<?php

    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");  
    }

    //$nombre = $_SESSION['nombre']; 
   // $tipo_usuario = $_SESSION['tipo_usuario'];
   
   // Establecer tiempo de vida de la sesión en segundos
   $inactividad = 600;
   // Comprobar si $_SESSION["timeout"] está establecida
   if(isset($_SESSION["timeout"])){
       // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
       $sessionTTL = time() - $_SESSION["timeout"];
       if($sessionTTL > $inactividad){
           session_destroy();
           header("Location: ../logout.php");
       }
   }
   // El siguiente key se crea cuando se inicia sesión
   $_SESSION["timeout"] = time();

?>