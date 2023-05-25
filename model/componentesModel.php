<?php
include ('../controller/componentesController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarComponentes();
        break;
    
    default:
        # code...S
        break;
}
function listarComponentes(){
    global $conect;
    $sql="select * from componentes ";
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
                'id' => $row['id_componentes'],
                'serie' => $row['serie'],
                'fecha_alta' => $row['fecha_alta']
               
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
}
?>