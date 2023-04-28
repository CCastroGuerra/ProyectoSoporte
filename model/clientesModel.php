<?php
include ('../controller/clientesController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarClientes();
        break;
    
    default:
        # code...S
        break;
}
function listarClientes(){
    global $conect;
    $sql="select * from clientes ";
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
                'id' => $row['id_clientes'],
                'nombre' => $row['nombre_cliente'],
                'apellidos' => $row['apellidos_cliente'],
                'correo' => $row['correo_cliente'],
                'telefono' => $row['telefono_cliente'],
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 

?>