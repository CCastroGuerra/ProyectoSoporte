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


    public function agregarComponetes($componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie, $margesi, $capacidad, $estadoSelect, $tipoAlimentaco, $tipoConector)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `componentes`( `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`,`margesi`,`componentes_capacidad`, `estado_id`,`tipo_alimentacion`,`tipo_conector`) VALUES ('$componenteSelect','$claseSelect','$marcaSelect','$modeloSelect','$serie','$margesi','$capacidad','$estadoSelect','$tipoAlimentaco',UPPER('$tipoConector'))";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actulizarComponentes($idComponentes, $componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie, $margesi, $capacidad, $estadoSelect, $tipoAlimentaco, $tipoConector)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE componentes
            SET
               tipo_componentes_id = ?,
               clase_componentes_id = ?,
               marca_id=?,
               modelo_id=?,
               serie = ?,
               margesi = ?,
               componentes_capacidad = ?,
               estado_id = ?,
               tipo_alimentacion =?,
               tipo_conector = ?
            WHERE
            id_componentes = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $componenteSelect);
        $sql->bindValue(2, $claseSelect);
        $sql->bindValue(3, $marcaSelect);
        $sql->bindValue(4, $modeloSelect);
        $sql->bindValue(5, $serie);
        $sql->bindValue(6, $margesi);
        $sql->bindValue(7, $capacidad);
        $sql->bindValue(8, $estadoSelect);
        $sql->bindValue(9, $tipoAlimentaco);
        $sql->bindValue(10, $tipoConector);
        $sql->bindValue(11, $idComponentes);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarComponentes($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE componentes SET es_activo = 0 WHERE id_componentes = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function traeComponenteXId($idComponentes)
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_componentes,
        tipo_componentes_id,
        tp.nombre_tipo_componente,
        clase_componentes_id,
        cc.nombre_clase,
        c.marca_id,
        ma.nombre_marca,
        modelo_id,
        m.nombre_modelo,
        serie,
        margesi,
        componentes_capacidad,
        estado_id,
        e.nombre_estado,
        c.tipo_alimentacion,
        CASE
            c.tipo_alimentacion
            WHEN 1 THEN 'TRANSFORMADOR'
            WHEN 2 THEN 'CABLE DE PODER'
            ELSE 'Otro'
        END AS tipoAlimentacion,
        c.tipo_conector,
        DATE_FORMAT(fecha_alta, '%d/%m/%y') as Fecha
    FROM componentes c
        INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes
        INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id
        INNER JOIN marca ma ON ma.id_marca = c.marca_id
        INNER JOIN modelo m ON m.id_modelo = c.modelo_id
        INNER JOIN estado e ON e.id_estado = c.estado_id
    WHERE id_componentes = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idComponentes);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function buscarComponente($pagina = 1)
    {
        $conectar = parent::conexion();
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {

            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
            }
            // if($pagina = 0){
            //     $pagina = 1;
            // }
            $inicio = ($pagina - 1) * $limit;
            $sql = "SELECT id_componentes, tipo_componentes_id, tp.nombre_tipo_componente,clase_componentes_id,cc.nombre_clase,c.marca_id, ma.nombre_marca,modelo_id, m.nombre_modelo, serie,componentes_capacidad,estado_id,c.tipo_conector, e.nombre_estado,DATE_FORMAT(fecha_alta,'%d/%m/%y') as Fecha, c.es_activo as Disponible FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id 
            WHERE tp.nombre_tipo_componente LIKE '$textoBusqueda%'  
            OR nombre_clase LIKE '$textoBusqueda%'  
            OR nombre_marca LIKE '$textoBusqueda%'  
            OR nombre_modelo LIKE '$textoBusqueda%'
            OR serie LIKE '$textoBusqueda%' 
            OR componentes_capacidad LIKE '$textoBusqueda%'
            OR nombre_estado LIKE '$textoBusqueda%'  
            ORDER BY tp.nombre_tipo_componente ASC , YEAR(fecha_alta) ASC, MONTH(fecha_alta) ASC LIMIT $inicio,$limit ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($marcas)) {
                $listado = array();
                foreach ($marcas as $marca) {
                    if ($marca["tipo_conector"] == null) {
                        $variableConector = '';
                    } else {
                        $variableConector =   $marca["tipo_conector"];
                    }
                    $listado[] = array(
                        "id" => $marca["id_componentes"],
                        "nombreTipo" => $marca["nombre_tipo_componente"],
                        'nombreClase' => $marca["nombre_clase"],
                        'nombreMarca' => $marca["nombre_marca"],
                        'nombreModelo' => $marca["nombre_modelo"],
                        'serie' => $marca["serie"],
                        'capacidad' => $marca["componentes_capacidad"],
                        'tipoConector' => $variableConector,
                        'estado' => $marca["nombre_estado"],
                        'Fecha' => $marca["Fecha"],
                        'Disponible' => $marca["Disponible"]

                    );
                }


                $sqlNroFilas = "SELECT count(id_componentes) as cantidad FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id 
                WHERE tp.nombre_tipo_componente LIKE '$textoBusqueda%'  
                OR nombre_clase LIKE '$textoBusqueda%'  
                OR nombre_marca LIKE '$textoBusqueda%'  
                OR nombre_modelo LIKE '$textoBusqueda%'
                OR serie LIKE '$textoBusqueda%' 
                OR componentes_capacidad LIKE '$textoBusqueda%'
                OR nombre_estado LIKE '$textoBusqueda%'     
                ORDER BY tp.nombre_tipo_componente ASC , YEAR(fecha_alta) ASC, MONTH(fecha_alta) ASC";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();

                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad'] / $limit);
                //echo 'Imprimiendo paginas: '.$paginas;

                $json = array('listado' => $listado, 'paginas' => $paginas, 'pagina' => $pagina, 'total' => $array['cantidad']);
                $jsonString  = json_encode($json);
                echo $jsonString;
            } else {
                $resultado = array("listado" => "vacio");
                $jsonString = json_encode($resultado);
                echo $jsonString;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
