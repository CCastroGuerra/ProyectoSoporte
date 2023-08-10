<?php
//Declarar constantes de conexion
$port="80";
$hst="http://localhost".(set_port($port))."/ProyectoSoporte/img/banner.png";
define("logoreportes",$hst);

function set_port($port){
    if ($port!="") {
        $p=":".$port;
    }else{
        $p="";
    }
    return $p;
}

?>