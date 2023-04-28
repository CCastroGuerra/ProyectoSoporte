<?php
include ('../controller/trabajosController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarArea();
        break;
    
    default:
        # code...S
        break;
}
function listarArea(){
    global $conect;
    $sql="select * from trabajos ";
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
                'id' => $row['id_trabajos'],
                'nombre' => $row['nombre_trabajo'],
                'descripcion' => $row['descripcion']
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>