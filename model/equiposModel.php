<?php

class Equipos extends Conectar {

    public function obtenerDatosComponentes($serie)
    {
        $conectar = parent::conexion();

        $sql = "SELECT id_componentes, tp.nombre_tipo_componente,cc.nombre_clase,ma.nombre_marca, m.nombre_modelo, serie,componentes_capacidad, e.nombre_estado FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id WHERE serie = ? ";

        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $serie);
        $fila->execute();

        $resultado = $fila->fetchAll();

        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
        } else {
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                        "id" => $row["id_componentes"],
                        "nombreTipo" => $row["nombre_tipo_componente"],
                        'nombreClase' => $row["nombre_clase"],
                        'nombreMarca' => $row["nombre_marca"],
                        'nombreModelo' => $row["nombre_modelo"],
                        'serie' => $row["serie"],
                        'capacidad' => $row["componentes_capacidad"],
                        'estado' => $row["nombre_estado"]
                );
            }


            // $jsonString = json_encode($resultado);
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function guardarEquipo($idTipo, $serie,$margesi,$marcaId,$modeloId,$responsable,$areaId,$estadoId,$mac,$ip)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO equipos ( tipo_equipo_id, serie, margesi, marca_id,modelo_id, responsable,area_id, estado_id, mac, ip,fecha_crea,fecha_modifica,fecha_elimina,es_activo)
        VALUES ( $idTipo,$serie,$margesi,$marcaId,$modeloId,$responsable,$areaId,$estadoId,$mac,$ip,now(),'','',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function guardarComponetesTemp($componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie,$capacidad, $estadoSelect, $fecha)
    {
        $conectar = parent::conexion();
        // Truncar la tabla temporal para limpiar registros anteriores 
        $conectar->query("TRUNCATE TABLE componentes_temp");

        $sql = "INSERT INTO `temp_componentes`( `tipo_componentes_id`, `clase_componentes_id`, `marca_id`, `modelo_id`, `serie`,`componentes_capacidad`, `estado_id`, `fecha_alta`, `es_activo`) VALUES ('$componenteSelect','$claseSelect','$marcaSelect','$modeloSelect','$serie','$capacidad','$estadoSelect','$fecha',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }


    public function guardarEquipoComponente($equipoSerie)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO equipo_componentes (equipo_id, componentes_id) SELECT equipos.id_equipos, temp_componetes.id_componente
        FROM equipos, temp_componetes
        WHERE equipos.serie = $equipoSerie";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
        // Cerrar la declaración y la conexión
        $fila->closeCursor();
        
    }

    public function listarTipoEquipo()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tipo_equipo WHERE es_activo = 1";
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
                    'id' => $row['id_tipo_equipo'],
                    'nombre' => $row['nombre_tipo_equipo']


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

    public function listarArea()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM area WHERE esActivo = 1";
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

    public function listarEstado()
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
}


?>