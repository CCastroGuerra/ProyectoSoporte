<?php

class Area extends Conectar{

    public function listarArea()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
        $limit = $_POST['registros'];
        $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT * FROM `area` WHERE esActivo = 1 $sLimit ";
        $fila = $conectar->prepare($sql);
        $fila->execute();

        $resultado = $fila->fetchAll();
        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
        } else {
            $json = array();
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                    'id' => $row['id_area'],
                    'nombre' => $row['nombre_area']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function agregarArea($nombreArea)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `area`(`nombre_area`,`esActivo`) VALUES ('$nombreArea',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actulizarArea($idArea,$nombreArea){
        $conectar= parent::conexion();
        $sql="UPDATE area
            SET
               nombre_area=? 
            WHERE
                id_area = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombreArea);
        $sql->bindValue(2,$idArea);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function traerAreaXId($idArea){
        $conectar= parent::conexion();
        $sql="SELECT * FROM area WHERE id_area = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idArea);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function eliminarArea($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE area SET esActivo = 0 WHERE id_area = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarArea($pagina = 1) {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina-1)*$limit;
            //echo $inicio;
            $sql = "SELECT * FROM `area` WHERE esActivo = 1 AND nombre_area LIKE '$textoBusqueda%'  ORDER BY nombre_area LIMIT $inicio,$limit";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $areas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($areas)){
                $listado = array();
                foreach($areas as $area){
                    $listado[] = array(
                        "id" => $area["id_area"],
                        "nombre" => $area["nombre_area"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_area) as cantidad FROM area WHERE esActivo = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();
    
                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad']/$limit);
                $json = array('listado' => $listado, 'paginas' => $paginas, 'pagina' =>$pagina, 'total' => $array['cantidad']);
                $jsonString  = json_encode($json);
                echo $jsonString;

            }else{
                $resultado = array("listado" => "vacio");
                $jsonString = json_encode($resultado);
                echo $jsonString;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }  
}
