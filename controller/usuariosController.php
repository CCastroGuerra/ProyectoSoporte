<?php
require_once("../config/conexion.php");
require_once("../model/usuariosModel.php");


$usuarios = new Usuario();
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case "guardar":
        //var_dump($_POST);
        $usuarios->guardarUsuario($_POST['id'], $_POST['username'], $_POST['userpass']);
        break;
    case "buscar":
        $usuarios->buscarUsuario(intval($_POST['pag']));
        break;
    case "listar":
        $usuarios->obtenerDatosPersonal(($_POST['codPersonal']));
        break;
    case "eliminar":
        $usuarios->eliminarUsuario($_POST["id"]);
        break;
    case "mostrar":
        $datos = $usuarios->traerUsuarioXId($_POST["id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output['id'] = $row['id_usuario'];
                $output['dni'] = $row['dni_personal'];
                $output['nombreUsuario'] = $row['nombre_usuario'];
            }
            echo json_encode($output);
        }
        break;
    case "actualizar":
        $usuarios->actulizarUsuario($_POST["id"], $_POST["username"], $_POST['userpass']);
        echo "actualizado correctamente";
        break;
}
