<?php
require_once("../config/conexion.php");
require_once("../model/usuariosModel.php");

$usuarios = new Usuario();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case "guardar":
        //var_dump($_POST);
        $usuarios -> guardarUsuario($_POST['id'],$_POST['username'],$_POST['userpass']);
        break;
    case "buscar":
        $usuarios -> buscarUsuario(intval($_POST['pag']));
        break;
    case "listar":
        $usuarios ->obtenerDatosPersonal(($_POST['codPersonal']));
        break;
    case "eliminar":
        $usuarios ->eliminarUsuario($_POST["id"]);
        break;
}

?>
