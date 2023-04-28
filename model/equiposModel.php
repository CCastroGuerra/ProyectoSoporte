<?php
include ('../controller/equiposController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarAlmacen();
        break;
    
    default:
        # code...S
        break;
}
function listarAlmacen(){
    global $conect;
    $sql="select * from equipos ";
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
                'id' => $row['id_equipos'],
                'codigo' => $row['codigo'],
                'ip' => $row['ip'],
                'mac' => $row['mac'],
                'fecha' => $row['fecha_alta']
               
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
}  