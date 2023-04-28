<?php
include ('../controller/usuariosController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarUsuarios();
        break;
    
    default:
        # code...S
        break;
}
function listarUsuarios(){
    global $conect;
    $sql="select * from usuarios ";
    $fila=$conect->prepare($sql);
    $fila->execute();

    $resultado = $fila->fetchAll();
    if(empty($resultado)){
       $resultado = array('listado'=>'vacio');
       $jsonString = json_encode($resultado);
       echo $jsonString;
    }else{
        $json =array();
        $listado = array();
        foreach($resultado as $row) {
            $listado[]=array(
                'id' => $row['id_usuarios'],
                'nombre' => $row['nombre_usuario']

            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>