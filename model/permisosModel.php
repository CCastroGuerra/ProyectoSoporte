<?php
include ('../controller/permisosController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarPermisos();
        break;
    
    default:
        # code...S
        break;
}
function listarPermisos(){
    global $conect;
    $sql="select * from permisos ";
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
                'id' => $row['id_permisos'],
                'nombre' => $row['nombre_permisos'],
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>