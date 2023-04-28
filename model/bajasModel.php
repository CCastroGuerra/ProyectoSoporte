<?php
include ('../controller/bajasController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarBajas();
        break;
    
    default:
        # code...S
        break;
}
function listarBajas(){
    global $conect;
    $sql="select * from bajas ";
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
                'id' => $row['id_bajas'],
                'motivo' => $row['motivo'],
                'descripcion' => $row['descripcion'],
                'fecha' => $row['fecha_baja']
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>