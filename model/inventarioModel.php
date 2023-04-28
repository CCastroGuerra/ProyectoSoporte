<?php
include ('../controller/inventarioController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarInventario();
        break;
    
    default:
        # code...S
        break;
}
function listarInventario(){
    global $conect;
    $sql="select * from inventario ";
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
                'id' => $row['id_inventario'],
                'cantidad' => $row['cantidad']
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>