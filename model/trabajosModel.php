<?php

class Trabajos extends Conectar
{

    public function listarServicios()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM servicios WHERE `esActivo` = 1
        ORDER BY nombre_servicios ASC;";
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
                    'id' => $row['id_servicios'],
                    'nombre' => $row['nombre_servicios']


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
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
    public function detallesEquipoXSerie($serie)
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_equipos,margesi,clientes_id,CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombrePersonal,eq.area_id, a.nombre_area, eq.tipo_equipo_id,te.nombre_tipo_equipo,eq.marca_id,mar.nombre_marca,eq.modelo_id,mo.nombre_modelo from equipos eq
        INNER JOIN personal per ON per.id_personal = eq.clientes_id
        INNER JOIN area a ON a.id_area = eq.area_id
        INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id 
        INNER JOIN marca mar ON eq.marca_id = mar.id_marca
        INNER JOIN modelo mo ON mo.id_modelo = eq.modelo_id
        WHERE eq.serie = ?  AND eq.es_activo = 1;";
        //echo 'consulta sql'.$sql;
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $serie);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function guardarServicioTemp($trabajoId, $equipoId, $servicioId)
    {
        $conectar = parent::conexion();

        $sql = "INSERT INTO  temp_servicios(trabajo_id,equipo_id,servicio_id)VALUES (?,?,?);";
        $fila = $conectar->prepare($sql);
        //$fila->bindValue(1, $componenteId);
        $fila->bindValue(1, $trabajoId);
        $fila->bindValue(2, $equipoId);
        $fila->bindValue(3, $servicioId);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function guardarTrabajoServicios($trabajoId)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `trabajo_servicio` (
            `id_trabajo_servicio`,
            `trabajo_id`,
            `servicio_id`,
            `equipo_id`,
            `esActivo`
        )
        select temp_servicios.id_trabajo_servicio,
        temp_servicios.trabajo_id,
        temp_servicios.servicio_id,
        temp_servicios.equipo_id,
        temp_servicios.esActivo
        from temp_servicios
        where temp_servicios.trabajo_id = '$trabajoId' on DUPLICATE KEY
        UPDATE trabajo_servicio.esActivo = temp_servicios.esActivo;";

        $fila = $conectar->prepare($sql);
        //echo 'Consulta equipo_componente: '.$sql;
        if ($fila->execute()) {
            $fila->closeCursor();
            $slq2 = "DELETE FROM  temp_servicios  WHERE trabajo_id = '$trabajoId';
            ";
            $fila2 = $conectar->prepare($slq2);
            if ($fila2->execute()) {
                //echo 'Se elimino correctamente tabla temporal';
            } else {

                //echo 'Error al ejecutar la consulta 2';
            }
            echo '1';
        } else {
            echo '0';
        }
    }

    public function listarTablaTempServicios()
    {
        $conectar = parent::conexion();
        $sql = "SELECT ts.id_temp_servicios,ts.servicio_id,ser.nombre_servicios
        from  temp_servicios  ts
        inner join servicios ser on ts.servicio_id = ser.id_servicios
        WHERE
        ts.esActivo = 1
        ;";
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
                    "idtemp" => $row["id_temp_servicios"],
                    "id" => $row["servicio_id"],
                    "nombreServicio" => $row["nombre_servicios"]

                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function guardarTrabajos($idTrabajos, $tecnicoID, $equipoId, $usuarioId, $areaId, $falla, $solucion, $recomendaciones)
    {
        if ($idTrabajos == '') {
            $idTrabajos = null;
        }
        $conectar = parent::conexion();
        $sql = "INSERT INTO trabajos  (id_trabajos,tecnico_id, equipo_id, responsable_id, area_id, falla, solucion, recomendacion)
            VALUES ('$idTrabajos','$tecnicoID', '$equipoId', '$usuarioId', '$areaId', '$falla', '$solucion', '$recomendaciones')
            ON DUPLICATE KEY UPDATE id_trabajos='$idTrabajos',tecnico_id = '$tecnicoID', equipo_id = '$equipoId', responsable_id = '$usuarioId', area_id = '$areaId', falla = '$falla', solucion = '$solucion', recomendacion = '$recomendaciones';";
        $fila = $conectar->prepare($sql);

        if ($fila->execute()) {
            $consulta = "Select id_trabajos  from trabajos  where equipo_id = '$equipoId';";
            $fila2 = $conectar->prepare($consulta); // Obtener el ID del registro insertado
            $fila2->execute();
            $resultado = $fila2->fetch(PDO::FETCH_LAZY);
            $listado = array("listado" => $resultado['id_trabajos']);
            $jsonString = json_encode($listado);
            echo $jsonString;
        } else {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
            echo 'Error al ejecutar la consulta';
        }
    }

    public function buscarTrabajos($pagina = 1)
    {
        $conectar = parent::conexion();
        $textoBusqueda = $_POST['textoBusqueda'];
        try {

            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
            }
            // if($pagina = 0){
            //     $pagina = 1;
            // }
            $inicio = ($pagina - 1) * $limit;
            $sql = "SELECT t.id_trabajos, t.equipo_id,
            eq.serie,
            eq.margesi,
            t.responsable_id,
            CONCAT(p.nombre_personal, ' ', p.apellidos_personal) NombreResponsable,
            t.area_id,
            a.nombre_area,
            t.tecnico_id,
            CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombreTecnico,
            DATE_FORMAT(t.fecha_alta, '%d/%m/%y') as Fecha
        FROM trabajos t
            INNER JOIN personal per ON t.tecnico_id = per.id_personal
            INNER JOIN personal p ON p.id_personal = t.responsable_id
            INNER JOIN equipos eq ON eq.id_equipos = t.equipo_id
            INNER JOIN area a ON a.id_area = t.area_id
        WHERE t.es_activo = 1  AND p.nombre_personal LIKE '%$textoBusqueda%' 
            ORDER BY NombreResponsable, YEAR(t.fecha_alta) ASC, MONTH(t.fecha_alta) ASC 
            LIMIT $inicio, $limit ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $trabajos =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($trabajos)) {
                $listado = array();
                foreach ($trabajos as $trabajo) {
                    $listado[] = array(
                        "idTrabajo" => $trabajo["id_trabajos"],
                        "idEquipo" => $trabajo["equipo_id"],
                        "serie" => $trabajo["serie"],
                        "margesi" => $trabajo["margesi"],
                        'nombreResponsable' => $trabajo["NombreResponsable"],
                        'nombreArea' => $trabajo["nombre_area"],
                        'nombreTecnico' => $trabajo["NombreTecnico"],
                        'fecha' => $trabajo["Fecha"]

                    );
                }

                $sqlNroFilas = "SELECT count(id_trabajos) as cantidad FROM trabajos WHERE es_activo = 1";
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

    /*Llenar datos de tabla temporal para actualizar*/
    public function llenarCompActualizar($idTrabajos)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO temp_servicios(id_trabajo_servicio,trabajo_id,servicio_id,esActivo) 
        SELECT 
        id_trabajo_servicio,trabajo_id,servicio_id,esActivo
            FROM trabajo_servicio
            WHERE trabajo_id = ?;
         ";
        //$conectar -> query("TRUNCATE TABLE temp_componentes; ");
        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $idTrabajos);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function traerTrabajosXId($idTrabajos)
    {
        $conectar = parent::conexion();
        $sql = "SELECT e.id_equipos,t.id_trabajos,e.serie,
        e.margesi,
        CONCAT(p.nombre_personal, ' ', p.apellidos_personal) NombreResponsable,
        t.responsable_id,
        tp.nombre_tipo_equipo,
        t.area_id,
        a.nombre_area,
        m.nombre_marca,
        mo.nombre_modelo,
        t.falla,
        t.tecnico_id,
        CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombreTecnico,
        t.solucion,
        t.recomendacion
        FROM trabajos t
        INNER JOIN equipos e ON t.equipo_id = e.id_equipos
        INNER JOIN area a ON a.id_area = e.area_id
        INNER JOIN marca m ON m.id_marca = e.marca_id
        INNER JOIN modelo mo ON mo.id_modelo = e.modelo_id
        INNER JOIN personal per ON t.tecnico_id = per.id_personal
        INNER JOIN personal p ON p.id_personal = t.responsable_id
        INNER JOIN tipo_equipo tp ON TP.id_tipo_equipo = e.tipo_equipo_id
        WHERE t.id_trabajos = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idTrabajos);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarServiciosTemp($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE  temp_servicios  SET esActivo = 0 WHERE  id_temp_servicios  = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function cerrarBoton($idTrabajos)
    {
        $conectar = parent::conexion();
        $consulta = "DELETE FROM temp_servicios WHERE trabajo_id = ?;";
        $consulta = $conectar->prepare($consulta);
        $consulta->bindValue(1, $idTrabajos);
        //echo $consulta;
        if ($consulta->execute()) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function imprimirTrabajo($idTrabajos)
    {
        $conectar = parent::conexion();
        $consulta = "SELECT t.id_trabajos,
        CONCAT('N°', LPAD(id_trabajos, 6, '0')) AS codigo_correlativo,
        t.equipo_id,
        te.id_tipo_equipo,
        te.nombre_tipo_equipo,
        eq.serie,
        mar.nombre_marca,
        mo.nombre_modelo,
        eq.margesi,
        t.responsable_id,
        CONCAT(p.nombre_personal, ' ', p.apellidos_personal) NombreResponsable,
        t.area_id,
        a.nombre_area,
        t.tecnico_id,
        ts.servicio_id,
        s.nombre_servicios,
        t.falla,
        t.solucion,
        t.recomendacion,
        CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombreTecnico,
        DATE_FORMAT(t.fecha_alta, '%d/%m/%y') as Fecha
        FROM trabajos t
        INNER JOIN personal per ON t.tecnico_id = per.id_personal
        INNER JOIN personal p ON p.id_personal = t.responsable_id
        INNER JOIN equipos eq ON eq.id_equipos = t.equipo_id
        INNER JOIN area a ON a.id_area = t.area_id
        INNER JOIN trabajo_servicio ts ON ts.trabajo_id = t.id_trabajos
        INNER JOIN servicios s ON s.id_servicios = ts.servicio_id
        INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
        INNER JOIN marca mar ON eq.marca_id = mar.id_marca
        INNER JOIN modelo mo ON mo.id_modelo = eq.modelo_id
        WHERE t.es_activo = 1
        AND ts.`esActivo` = 1
        AND id_trabajos = ?";

        $consulta = $conectar->prepare($consulta);
        $consulta->bindValue(1, $idTrabajos);
        $consulta->execute();

        return $resultado = $consulta->fetchAll();
    }
}
