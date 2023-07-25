<?php

class Bajas extends Conectar
{
    // public function guardarBaja($serie, $tipoBaja, $motivo)
    // {
    //     $conectar = parent::conexion();

    //     // Verificar si el código de producto existe en la base de datos
    //     $consultaSerie = "SELECT id_equipos FROM equipos WHERE serie = ?";
    //     //echo $consultaSerie;
    //     $query = $conectar->prepare($consultaSerie);
    //     $query->bindValue(1, $serie);
    //     $query->execute();
    //     $producto = $query->fetch();
    //     //echo 'serie: ' . $producto;

    //     if (!$producto) {
    //         // El código de producto ingresado no existe
    //         echo 'El código de producto no es válido';
    //     } else {

    //         $serieId = $producto['id_equipos'];

    //         $query = "INSERT INTO bajas (equipo_id, tipo_baja, motivo)
    //                 VALUES (?, ?, ?)";

    //         $fila = $conectar->prepare($query);
    //         $fila->bindValue(1, $serieId);
    //         $fila->bindValue(2, $tipoBaja);
    //         $fila->bindValue(3, $motivo);

    //         if ($fila->execute()) {
    //             echo '1';
    //         } else {
    //             echo '0';
    //         }
    //     }
    // }

    public function guardarBaja($serie, $tipoBaja, $motivo)
    {
        $conectar = parent::conexion();

        // Verificar si el código de producto existe en la base de datos
        $consultaSerie = "SELECT id_equipos FROM equipos WHERE cod_equipo = ?";
        $query = $conectar->prepare($consultaSerie);
        $query->bindValue(1, $serie);
        $query->execute();
        $producto = $query->fetch();

        if (!$producto) {
            // El código de producto ingresado no existe
            echo 'El código de producto no es válido';
        } else {
            $serieId = $producto['id_equipos'];

            $conectar->beginTransaction();

            try {
                $sql = "UPDATE equipos
                    SET
                    es_activo = 0 
                    WHERE
                    cod_equipo = ?";
                $query = $conectar->prepare($sql);
                $query->bindValue(1, $serie);
                if ($query->execute()) {
                    $insertQuery = "INSERT INTO bajas (equipo_id, tipo_baja, motivo)
                                VALUES (?, ?, ?)";

                    $insertStatement = $conectar->prepare($insertQuery);
                    $insertStatement->bindValue(1, $serieId);
                    $insertStatement->bindValue(2, $tipoBaja);
                    $insertStatement->bindValue(3, $motivo);
                    $insertStatement->execute();

                    $conectar->commit();
                    echo '1';
                } else {
                    echo '0';
                }
            } catch (PDOException $e) {
                $conectar->rollback();
                echo '0';
            }
        }
    }

    public function editarEstadoEquipo($serie)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE equipos
        SET
        es_activo=0 
        WHERE
        serie = ?";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $serie);
        if ($query->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function eliminarBaja($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE bajas SET esActivo = 0 WHERE id_bajas = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            //$sql->execute();
            echo 'fin de la primera consular';
            if ($sql->execute()) {
                //obtener serie del equipo
                $sql2 = "SELECT eq.serie serie
                FROM bajas b
                    INNER JOIN equipos eq ON b.equipo_id = eq.id_equipos
                WHERE id_bajas = ?;";
                $fila =  $conectar->prepare($sql2);
                $fila->bindValue(1, $id);
                $fila->execute();
                $resultado = $fila->fetch(PDO::FETCH_LAZY);
                $serieEncontrada = $resultado['serie'];
                echo 'La serie del id de la baja es: ' . $serieEncontrada;

                //Consulta para cambiar estado del equipo
                $consulta = "UPDATE equipos
                SET
                es_activo=1 
                WHERE
                serie = ?";
                $fila2 = $conectar->prepare($consulta);
                $fila2->bindValue(1, $serieEncontrada);
                if ($fila2->execute()) {
                    echo 'volvio el equipo de bja';
                } else {
                    echo '0';
                }
            }
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function actualizarrBaja($idBajas, $tipoBaja, $motivo)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE bajas
            SET
               tipo_baja=?,
               motivo = ? 
            WHERE
                id_bajas = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipoBaja);
        $sql->bindValue(2, $motivo);
        $sql->bindValue(3, $idBajas);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function traerBajaXId($idBajas)
    {
        $conectar = parent::conexion();
        $sql = "SELECT b.id_bajas, eq.cod_equipo, b.equipo_id, eq.serie,b.tipo_baja, CASE WHEN tipo_baja = 1 THEN 'TEMPORAL' WHEN tipo_baja = 2 THEN 'PERMANENTE' END tipoBajas, b.motivo FROM bajas b INNER JOIN equipos eq ON b.equipo_id = eq.id_equipos WHERE id_bajas = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idBajas);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function buscarBajas($pagina = 1)
    {
        $conectar = parent::conexion();
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;

            $sql = "SELECT id_bajas,
            b.equipo_id,
            eq.tipo_equipo_id,
            te.nombre_tipo_equipo,
            eq.area_id,
            a.nombre_area,b.tipo_baja,
            CASE
                WHEN tipo_baja = 1 THEN 'TEMPORAL'
                WHEN tipo_baja = 2 THEN 'PERMANENTE'
            END as tipoBajas,
            b.motivo,
            DATE_FORMAT(fecha_baja, '%d/%m/%y') as Fecha
        FROM bajas b
            INNER JOIN equipos eq ON b.equipo_id = eq.id_equipos
            INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
            INNER JOIN area a ON a.id_area = eq.area_id
        WHERE b.esActivo = 1
        AND (nombre_tipo_equipo LIKE '%$textoBusqueda%' 
                OR  nombre_area LIKE '%$textoBusqueda%' 
                OR (CASE
                        WHEN tipo_baja = 1 THEN 'TEMPORAL'
                        WHEN tipo_baja = 2 THEN 'PERMANENTE'
                    END) LIKE '%$textoBusqueda%') 
         LIMIT $inicio,$limit";

            $fila = $conectar->prepare($sql);
            //$fila -> bindParam('filtro', $filtro,PDO::PARAM_STR);
            $fila->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $bajas =  $fila->fetchAll(PDO::FETCH_ASSOC);
            $fila->closeCursor();
            if (!empty($bajas)) {
                $listado = array();
                foreach ($bajas as $baja) {
                    $listado[] = array(
                        'id' => $baja['id_bajas'],
                        'nombreTipoEquipo' => $baja['nombre_tipo_equipo'],
                        'nombreArea' => $baja['nombre_area'],
                        'motivo' => $baja['motivo'],
                        'tipoBajas' => $baja['tipoBajas'],
                        'fecha' => $baja['Fecha']



                    );
                }

                $sqlNroFilas = "SELECT count(id_bajas) as cantidad FROM bajas WHERE esActivo = 1 ";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();

                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad'] / $limit);
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
