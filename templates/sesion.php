<?php

    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");  
    }

    $nombre = $_SESSION['nombre']; 
   // $tipo_usuario = $_SESSION['tipo_usuario']; 

?>