<?php
class Movimiento extends Conectar
{

    public function listarTecnicos()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_personal, CONCAT(nombre_personal, ' ', apellidos_personal) NombrePersonal,cargo_personal,
        CASE
            WHEN cargo_personal = 0 THEN 'Vacio'
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2 THEN 'Secretaria'
            WHEN cargo_personal = 3 THEN 'Practicante'
            WHEN cargo_personal = 4 THEN 'Técnico'
        END as nombreCargoPersonal
        FROM personal WHERE `esActivo_personal` = 1 AND cargo_personal = 4;";
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
                    'id' => $row['id_personal'],
                    'nombreTecnico' => $row['NombrePersonal']


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarArea()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `area` WHERE esActivo = 1";
        $fila = $conectar->prepare($sql);
        $fila->execute();

        $resultado = $fila->fetchAll();
        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
        } else {
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

    public function traerMovimientoXId($idTranslado)
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_translado,tipo_movimiento,
        CASE
            tipo_movimiento
            WHEN 1 THEN 'Translado'
            WHEN 2 THEN 'Intercambio'
            ELSE 'Otro'
        END AS tipo,
        tecnico_id,
        CONCAT(nombre_personal, ' ', apellidos_personal) AS NombreTecnico,
        observacion
    FROM translado t 
        INNER JOIN personal p ON p.id_personal = t.tecnico_id
        WHERE id_translado = ?;";
        //echo 'consulta sql' . $sql;
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idTranslado);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function traerAreaXId($idEquipo)
    {
        $conectar = parent::conexion();
        $sql = "SELECT e.id_equipos,
        area_id,
        nombre_area
    FROM equipos e
        INNER JOIN area a ON a.id_area = e.area_id
    WHERE cod_equipo = ?;";
        //echo 'consulta sql' . $sql;
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idEquipo);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function guardarMovimiento($tipoMovimiento, $tecnicoId, $observacion)
    {

        $conectar = parent::conexion();
        $sql = "INSERT INTO `translado`(`observacion`,`tecnico_id`,`tipo_movimiento`) VALUES ('$observacion','$tecnicoId','$tipoMovimiento')";
        $fila = $conectar->prepare($sql);
        $fila->execute();

        $idMovimiento = $conectar->lastInsertId();
        //echo $idMovimiento;
        if ($idMovimiento > 0) {
            echo $idMovimiento;
        } else {
            echo '0';
        }
    }

    public function guardarEquipo($idEquipo, $areaOrigen, $areaDestino, $idTranslado)
    {
        $conectar = parent::conexion();

        // Obtener los datos de la tabla_origen
        $query = "SELECT id_translado, tipo_movimiento FROM  translado  WHERE id_translado = '$idTranslado'"; // Agrega las condiciones adecuadas
        $stmt = $conectar->prepare($query);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        // Insertar los datos en la tabla detalles_translado
        $idTranslado = $datos['id_translado'];
        $tipo = $datos['tipo_movimiento'];

        $sql = "INSERT INTO detalles_translado (id_translado, area_origen, area_destino, tipo, equipo_id)
                VALUES ('$idTranslado', '$areaOrigen', '$areaDestino', '$tipo', '$idEquipo')";
        $stmt = $conectar->prepare($sql);

        if ($stmt->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function listarTablaMovimientos($idTranslado)
    {
        $conectar = parent::conexion();
        $sql = "SELECT dt.id_translado, dt.equipo_id, dt.area_origen, a_origen.nombre_area AS nombre_area_origen, dt.area_destino, a_destino.nombre_area AS nombre_area_destino
        FROM detalles_translado dt
        INNER JOIN area a_origen ON a_origen.id_area = dt.area_origen
        INNER JOIN area a_destino ON a_destino.id_area = dt.area_destino WHERE dt.id_translado = '$idTranslado' ;";
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
                    'areaOrigen' => $row['nombre_area_origen'],
                    'idEquipo' => $row['equipo_id'],
                    'areaDestino' => $row['nombre_area_destino']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function buscarMovimiento($pagina = 1)
    {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            // $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            // //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;
            //echo $inicio;
            $sql = "SELECT distinct dt.id_translado,
                        CASE
                            dt.tipo
                            WHEN 1 THEN 'Translado'
                            WHEN 2 THEN 'Intercambio'
                            ELSE 'Otro'
                        END AS tipo,
                        t.tecnico_id,
                        CONCAT(nombre_personal, ' ', apellidos_personal) AS NombreTecnico,
                        t.observacion,
                        DATE_FORMAT(t.fecha, '%d/%m/%y') AS Fecha
                        FROM detalles_translado dt
                        INNER JOIN translado t ON t.id_translado = dt.id_translado
                        INNER JOIN personal p ON p.id_personal = t.tecnico_id AND CONCAT(nombre_personal, ' ', apellidos_personal) LIKE '%$textoBusqueda%' LIMIT $inicio,$limit ";
            //echo $sql;
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $movimientos =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($movimientos)) {
                $listado = array();
                foreach ($movimientos as $movimiento) {
                    $listado[] = array(
                        'id' => $movimiento['id_translado'],
                        "tipo" => $movimiento["tipo"],
                        "nombreTecnico" => $movimiento["NombreTecnico"],
                        'observacion' => $movimiento["observacion"],
                        'fecha' => $movimiento["Fecha"]

                    );
                }

                $sqlNroFilas = "SELECT count(id_translado) as cantidad FROM detalles_translado";
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

    public function eliminarEquipoMov($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "DELETE FROM detalles_translado WHERE equipo_id = ?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function actulizarDatosMovimietnos($idTranslado, $tipoMovimiento, $tecnicoId, $observacion)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE  translado 
            SET
            observacion=? ,
            tecnico_id=? ,
            tipo_movimiento=? 
            WHERE
            id_translado = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $observacion);
        $sql->bindValue(2, $tecnicoId);
        $sql->bindValue(3, $tipoMovimiento);
        $sql->bindValue(4, $idTranslado);
        if ($sql->execute()) {
            $sql2 = "UPDATE   detalles_translado  
            SET
            tipo=? 
            WHERE
            id_translado = ?";
            $sql2 = $conectar->prepare($sql2);
            $sql2->bindValue(1, $tipoMovimiento);
            $sql2->bindValue(2, $idTranslado);
            if ($sql2->execute()) {
                //var_dump($_POST);
                $consultaEquipos = "SELECT equipo_id,area_destino
                from detalles_translado
                WHERE id_translado = $idTranslado;";
                $consultaEquipos = $conectar->prepare($consultaEquipos);
                $consultaEquipos->execute();
                $resultado = $consultaEquipos->fetchAll();

                $cantidad = count($resultado);
                for ($i = 0; $i < $cantidad; $i++) {
                    $idEquipo = $resultado[$i]['equipo_id'];
                    $areaDestino = $resultado[$i]['area_destino'];
                    // print_r($idEquipo);
                    // print_r($areaDestino);
                    $sql3 = "UPDATE equipos set area_id = '$areaDestino' WHERE cod_equipo = '$idEquipo'";
                    // echo $sql3;
                    $sql3 = $conectar->prepare($sql3);
                    $sql3->execute();
                }
            }
        }
        return $resultado = $sql->fetchAll();
    }

    public function eliminar($idTranslado)
    {
        $conectar = parent::conexion();
        if (isset($_POST["id"])) {
            $idTranslado = $_POST["id"];
            $consultaEquipos = "SELECT equipo_id,area_origen
            from detalles_translado
            WHERE id_translado = $idTranslado;";
            $consultaEquipos = $conectar->prepare($consultaEquipos);
            $consultaEquipos->execute();
            $resultado = $consultaEquipos->fetchAll();
            $cantidad = count($resultado);
            for ($i = 0; $i < $cantidad; $i++) {
                $idEquipo = $resultado[$i]['equipo_id'];
                $areaOrigen = $resultado[$i]['area_origen'];
                // print_r($idEquipo);
                // print_r($areaDestino);
                $sql3 = "UPDATE equipos set area_id = '$areaOrigen' WHERE cod_equipo = '$idEquipo'";
                // echo $sql3;
                $sql3 = $conectar->prepare($sql3);
                $sql3->execute();
            }
            $sql3->closeCursor();
            // Resto del código para eliminar la tarea

            $sql = "UPDATE  translado set anulado= 1 WHERE id_translado = $idTranslado;
                    ";
            $sql = $conectar->prepare($sql);

            if ($sql->execute()) {
                $sql->closeCursor();
                $sql2 = "DELETE from detalles_translado where id_translado = ?;";
                $sql2 = $conectar->prepare($sql2);
                $sql2->bindValue(1, $idTranslado);
                $sql2->execute();
            }
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }
}
