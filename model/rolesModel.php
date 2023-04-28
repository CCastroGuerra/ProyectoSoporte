<?php
include ('../controller/rolesController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarRoles();
        break;
    case 'guardar':
        agregarRoles($_POST['nombreRol']);
        break;
    
    default:
        # code...S
        break;
}
function listarRoles(){
    global $conect;
    $sql="select * from roles ";
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
                'id' => $row['id_roles'],
                'nombre' => $row['nombre_roles']
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
   
    
    
} 
function agregarRoles($nombreRoles){
    global $conect;
    $sql = "INSERT INTO `roles`(`nombre_roles`) VALUES ('$nombreRoles')";
    $fila=$conect->prepare($sql);
    if($fila->execute()){
        echo 1;
    }else{
        echo 0;
    }
}

?>