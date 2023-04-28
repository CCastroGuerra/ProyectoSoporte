<?php
include ('../controller/productosController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarEquipos();
        break;
    
    default:
        # code...S
        break;
}
//Lista de productos en formato json
function listarEquipos(){
    global $conect;
    $sql="select * from productos ";
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
                'fecha' => $row['fecha_alta'],
                'ip' => $row['ip'],
                'mac' => $row['mac']
            );
        }
        //Se convierte el array a json y se muestra
        $jsonString = json_encode($listado);
        echo $jsonString;
    
  
    
}   

    
}

?>