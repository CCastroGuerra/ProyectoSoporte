<?php
require_once("../config/conexion.php");
require_once("../model/usuariosModel.php");

$usuarios = new Usuario();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case "guardar":
        $usuarios -> guardarUsuario($_POST['codPersonal'],$_POST['username'],$_POST['userpass']);
        break;
    case "buscar":
        $usuarios -> buscarUsuario(intval($_POST['pag']));
        break;
    case "listar":
        $usuarios ->obtenerDatosPersonal(($_POST['dni'])); // Enviar los datos obtenidos como respuesta JSON
        break;
}

?>
