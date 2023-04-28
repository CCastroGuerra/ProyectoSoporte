<?php
include ('../controller/marcaController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarMarca();
        break;
    case 'guardar':
            agregarMarca($_POST['nombreMarca']);
            break;
    
    default:
        # code...S
        break;
}
function listarMarca(){
    global $conect;
    $sql="select * from marca ";
    $fila=$conect->prepare($sql);
    $fila->execute();

    $resultado = $fila->fetchAll();
    //Si esta vacia
    if(empty($resultado)){
       $resultado = array('listado'=>'vacio');
       $jsonString = json_encode($resultado);
       echo $jsonString;
    }else{
        $json =array();
        $listado = array();
        foreach($resultado as $row) {
            $listado[]=array(
                'id' => $row['id_marca'],
                'nombre' => $row['nombre_marca']
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }
    
    
} 
function agregarMarca($nombreMarca){
    global $conect;
    $sql = "INSERT INTO `marca`(`nombre_marca`) VALUES ('$nombreMarca')";
    $fila=$conect->prepare($sql);
    if($fila->execute()){
        echo '1';
    }else{
        echo '0';
    }
}

function buscarMarca($fitro = null, $pagina = 1,$cantidadPagina = 5){
    global $conect;
    $inicio = ($pagina - 1) * $cantidadPagina;
    $consulta = "SELECT * FROM `marca` $filtro ORDER BY `id_marca` limit $inicio, $cantidadPagina";
}


?>