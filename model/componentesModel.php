<?php

class Componente extends Conectar
{

    public function listarTipoComponentes()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tipo_componentes WHERE esActivo = 1";
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
                    'id' => $row['id_tipo_componentes'],
                    'nombre' => $row['nombre_tipo_componente']


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectClaseComponente()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_clase_componentes, nombre_clase from  clase_componentes WHERE esActivo = 1 ORDER BY nombre_clase";
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
                    'id' => $row['id_clase_componentes'],
                    'nombre' => $row['nombre_clase']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectEstado()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM estado ";
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
                    'id' => $row['id_estado'],
                    'nombre' => $row['nombre_estado']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectMarca()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * from marca WHERE esActivo = 1";
        $fila = $conectar->prepare($sql);
        // $fila->bindValue(1,$idMarca);

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
                    'id' => $row['id_marca'],
                    'nombre' => $row['nombre_marca']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectModelo($idMarca)
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `modelo`  WHERE marca_id = ?";
        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $idMarca);
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
                    'id' => $row['id_modelo'],
                    'nombre' => $row['nombre_modelo']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }


    public function agregarComponetes($componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie,$capacidad, $estadoSelect, $fecha)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `componentes`( `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`,`componentes_capacidad`, `estado_id`, `fecha_alta`, `es_activo`) VALUES ('$componenteSelect','$claseSelect','$marcaSelect','$modeloSelect','$serie','$capacidad','$estadoSelect','$fecha',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actulizarComponentes($idComponentes,$componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie,$capacidad, $estadoSelect, $fecha){
        $conectar= parent::conexion();
        $sql="UPDATE componentes
            SET
               tipo_componentes_id = ?,
               clase_componentes_id = ?,
               marca_id=?,
               modelo_id=?,
               serie = ?,
               componentes_capacidad = ?,
               estado_id = ?,
               fecha_alta = ?
            WHERE
            id_componentes = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$componenteSelect);
        $sql->bindValue(2,$claseSelect);
        $sql->bindValue(3,$marcaSelect);
        $sql->bindValue(4,$modeloSelect);
        $sql->bindValue(5,$serie);
        $sql->bindValue(6,$capacidad);
        $sql->bindValue(7,$estadoSelect);
        $sql->bindValue(8,$fecha);
        $sql->bindValue(9,$idComponentes);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function eliminarComponentes($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE componentes SET es_activo = 0 WHERE id_componentes = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function traeComponenteXId($idComponentes){
        $conectar= parent::conexion();
        $sql ="SELECT id_componentes, tipo_componentes_id, tp.nombre_tipo_componente,clase_componentes_id,cc.nombre_clase,c.marca_id, ma.nombre_marca,modelo_id, m.nombre_modelo, serie,componentes_capacidad,estado_id, e.nombre_estado,DATE_FORMAT(fecha_alta,'%d/%m/%y') as Fecha FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id WHERE id_componentes = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idComponentes);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function buscarComponente($pagina = 1) {
        $conectar = parent::conexion();
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
          
            if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina-1)*$limit;
            $sql = "SELECT id_componentes, tipo_componentes_id, tp.nombre_tipo_componente,clase_componentes_id,cc.nombre_clase,c.marca_id, ma.nombre_marca,modelo_id, m.nombre_modelo, serie,componentes_capacidad,estado_id, e.nombre_estado,DATE_FORMAT(fecha_alta,'%d/%m/%y') as Fecha FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id WHERE es_activo = 1 AND tp.nombre_tipo_componente LIKE '$textoBusqueda%'  
            ORDER BY tp.nombre_tipo_componente ASC , YEAR(fecha_alta) ASC, MONTH(fecha_alta) ASC LIMIT $inicio,$limit ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($marcas)){
                $listado = array();
                foreach($marcas as $marca){
                    $listado[] = array(
                        "id" => $marca["id_componentes"],
                        "nombreTipo" => $marca["nombre_tipo_componente"],
                        'nombreClase' => $marca["nombre_clase"],
                        'nombreMarca' => $marca["nombre_marca"],
                        'nombreModelo' => $marca["nombre_modelo"],
                        'serie' => $marca["serie"],
                        'capacidad' => $marca["componentes_capacidad"],
                        'estado' => $marca["nombre_estado"],
                        'Fecha' => $marca["Fecha"]

                    );
                }

                $sqlNroFilas = "SELECT count(id_componentes) as cantidad FROM componentes WHERE es_activo = 1";
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
