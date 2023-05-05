<?php
class Area extends Conectar{
    public function listarArea(){
        global $conect;
        $sql="SELECT * FROM `area`";
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
                    'id' => $row['id_area'],
                    'nombre' => $row['nombre_area']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    function agregarArea($nombreArea){
        global $conect;
        $sql = "INSERT INTO `area`(`nombre_area`) VALUES ('$nombreArea')";
        $fila=$conect->prepare($sql);
        if($fila->execute()){
            echo '1';
        }else{
            echo '0';
        }
    }

    function buscarArea($filtro, $pagina = 1, $cantidadPagina =5){
        global $conect;
        $inicio = ($pagina -1) * $cantidadPagina;
        $sql="SELECT * FROM `area`   $filtro  order by id_area limit $inicio,$cantidadPagina";
        //echo $sql;
        $fila=$conect->prepare($sql);
        $fila->execute();
    
        $resultado = $fila->fetchAll();
        
        $fila->closeCursor();
        if(empty($resultado)){
           $resultado = array('listado'=>'vacio');
           $jsonString = json_encode($resultado);
           echo $jsonString;
        }else{
            $json =array();
            $listado = array();
            foreach($resultado as $row) {
                $listado[]=array(
                    'id' => $row['id_area'],
                    'nombre' => $row['nombre_area']
                );
            }
            $sqlNroFilas  = "SELECT count(id_area) as cantidad FROM `area`   $filtro";
        
            $fila2 = $conect-> prepare($sqlNroFilas);
            $fila2->execute();
    
            $array = $fila2->fetch(PDO::FETCH_LAZY);
            $paginas = ceil($array['cantidad'] / $cantidadPagina);
            $json = array('listado' => $listado,'paginas' => $paginas, 'pagina' => $pagina,'total' => $array['cantidad']);
            $jsonString = json_encode($json);
            echo $jsonString;
        
        }
    }
}


?>