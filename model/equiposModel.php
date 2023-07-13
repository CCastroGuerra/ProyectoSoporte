<?php

class Equipos extends Conectar
{

    public function obtenerDatosComponentes($serie)
    {
        $conectar = parent::conexion();

        $sql = "SELECT id_componentes, serie,tp.nombre_tipo_componente,cc.nombre_clase,ma.nombre_marca, m.nombre_modelo,componentes_capacidad, e.nombre_estado FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id WHERE serie = ? ";

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

    public function guardarEquipo($idEquipo, $serie, $margesi, $marcaId, $modeloId, $idTipo, $areaId, $responsable, $estadoId, $ip, $mac)
    {
        if ($idEquipo == '') {
            $idEquipo = '0';
        }
        $conectar = parent::conexion();
        /* $sql = "INSERT INTO equipos (id_equipos,serie, margesi, marca_id, modelo_id, tipo_equipo_id, area_id, clientes_id, estado_id, ip, mac)
            VALUES ('$idEquipo','$serie', '$margesi', '$marcaId', '$modeloId', '$idTipo', '$areaId', '$responsable', '$estadoId', '$ip', '$mac')
            ON DUPLICATE KEY UPDATE id_equipos='$idEquipo',serie = '$serie', margesi = '$margesi', marca_id = '$marcaId', modelo_id = '$modeloId', tipo_equipo_id = '$idTipo', area_id = '$areaId', clientes_id = '$responsable', estado_id = '$estadoId', ip = '$ip', mac = '$mac';"; */

        /***PROCEDIMIENTO ALMACENADO***/
        $sql = "call sp_insertar_equipo(?,?,?,?,?,?,?,?,?,?,?);";
        $fila = $conectar->prepare($sql);
        $fila->bindParam(1, $idEquipo, PDO::PARAM_INT);
        $fila->bindParam(2, $serie, PDO::PARAM_STR);
        $fila->bindParam(3, $margesi, PDO::PARAM_STR);
        $fila->bindParam(4, $marcaId, PDO::PARAM_INT);
        $fila->bindParam(5, $modeloId, PDO::PARAM_INT);
        $fila->bindParam(6, $idTipo, PDO::PARAM_INT);
        $fila->bindParam(7, $areaId, PDO::PARAM_INT);
        $fila->bindParam(8, $responsable, PDO::PARAM_INT);
        $fila->bindParam(9, $estadoId, PDO::PARAM_INT);
        $fila->bindParam(10, $ip, PDO::PARAM_STR);
        $fila->bindParam(11, $mac, PDO::PARAM_STR);
        /*******************************/
        /* $fila = $conectar->prepare($sql); */

        if ($fila->execute()) {
            $consulta = "Select id_equipos  from equipos where serie = '$serie';";
            $fila2 = $conectar->prepare($consulta); // Obtener el ID del registro insertado
            $fila2->execute();
            $resultado = $fila2->fetch(PDO::FETCH_LAZY);
            $listado = array("listado" => $resultado['id_equipos']);
            $jsonString = json_encode($listado);
            echo $jsonString;
        } else {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
            echo 'Error al ejecutar la consulta';
        }
    }

    public function guardarComponetesTemp($serie, $margesi, $equipoId)
    {
        $conectar = parent::conexion();

        $sql = "INSERT INTO temp_componentes(serie_comp,margesi,equipo_id)VALUES (?,?,?);";
        $fila = $conectar->prepare($sql);
        //$fila->bindValue(1, $componenteId);
        $fila->bindValue(1, $serie);
        $fila->bindValue(2, $margesi);
        $fila->bindValue(3, $equipoId);
        if ($fila->execute()) {
            //echo 'Registo corrctamente en tabla temporal';
            echo '1';
        } else {
            echo '0';
        }
    }

    public function guardarEquipoComponente($equipoSerie)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO
        `equipo_componentes` (
            `id_equipo_componentes`,
            `equipo_id`,
            `serie_id`,
            `esActivo` )
     select
        temp_componentes.id_equipo_componentes,
        temp_componentes.equipo_id,
        temp_componentes.serie_comp,
        temp_componentes.esActivo
     from temp_componentes
        where
        temp_componentes.equipo_id = '$equipoSerie' 
        
        on DUPLICATE KEY
        UPDATE
        equipo_componentes.esActivo = temp_componentes.esActivo;
         ";
        //$conectar -> query("TRUNCATE TABLE temp_componentes; ");
        $fila = $conectar->prepare($sql);
        //echo 'Consulta equipo_componente: '.$sql;
        if ($fila->execute()) {
            $fila->closeCursor();
            $slq2 = "DELETE FROM temp_componentes WHERE equipo_id = '$equipoSerie';
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

    public function listarTipoEquipo()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tipo_equipo ORDER BY nombre_tipo_equipo";
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

    public function buscarResponsable($pagina = 1)
    {
        $conectar = parent::conexion();
        $textoBusqueda = $_POST['buscaRes'];
        $cantidadXPagina = 5;
        try {

            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
            }
            // if($pagina = 0){
            //     $pagina = 1;
            // }
            $inicio = ($pagina - 1) * $cantidadXPagina;
            $sql = "SELECT id_personal, CONCAT(nombre_personal, ' ' ,apellidos_personal) as  NombrePersonal, dni_personal FROM personal
            WHERE `esActivo_personal` = 1 AND CONCAT(nombre_personal, ' ' ,apellidos_personal) LIKE '%$textoBusqueda%' 
            OR dni_personal LIKE '%$textoBusqueda%' 
            ORDER BY NombrePersonal ASC
            LIMIT $inicio, $cantidadXPagina ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);




            if (!empty($marcas)) {
                $listado = array();
                foreach ($marcas as $marca) {
                    $listado[] = array(
                        "id" => $marca["id_personal"],
                        "nombre" => $marca["NombrePersonal"],
                        'dni' => $marca["dni_personal"]



                    );
                }


                $sqlNroFilas = "SELECT count(id_personal) as cantidad FROM personal WHERE esActivo_personal = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();

                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad'] / $cantidadXPagina);
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

    public function listarTablaTemp()
    {
        $conectar = parent::conexion();
        $sql = "SELECT tc.id_temp_componentes,
        tc.id_equipo_componentes,
        tc.equipo_id,
        tc.serie_comp,
        tp.nombre_tipo_componente,
        cl.nombre_clase,
        ma.nombre_marca,
        m.nombre_modelo,
        c.componentes_capacidad,
        e.nombre_estado
        from temp_componentes as tc
        inner JOIN componentes c ON tc.serie_comp = c.serie
        inner JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes
        inner join clase_componentes cl ON cl.id_clase_componentes = c.clase_componentes_id
        INNER JOIN marca ma ON ma.id_marca = c.marca_id
        INNER JOIN modelo m ON m.id_modelo = c.modelo_id
        INNER JOIN estado e ON e.id_estado = c.estado_id
        WHERE tc.esActivo = 1;";
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
                    "idtemp" => $row["id_temp_componentes"],
                    "id" => $row["id_equipo_componentes"],
                    "nombreTipo" => $row["nombre_tipo_componente"],
                    'nombreClase' => $row["nombre_clase"],
                    'nombreMarca' => $row["nombre_marca"],
                    'nombreModelo' => $row["nombre_modelo"],
                    'capacidad' => $row["componentes_capacidad"],
                    'serie' => $row["serie_comp"],
                    'estado' => $row["nombre_estado"]



                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function eliminarComponentesTemp($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE  temp_componentes  SET esActivo = 0 WHERE  id_equipo_componentes  = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarEquipo($pagina = 1)
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
            $sql = "SELECT id_equipos,cod_equipo,e.area_id,a.nombre_area,e.marca_id, mar.nombre_marca,e.modelo_id,mo.nombre_modelo,serie,margesi, ip,mac,e.estado_id, est.nombre_estado,DATE_FORMAT(fecha_alta,'%d/%m/%y') as Fecha from equipos e
            INNER JOIN tipo_equipo tp ON e.tipo_equipo_id = tp.id_tipo_equipo
            INNER JOIN marca mar ON mar.id_marca = e.marca_id
            INNER JOIN modelo mo ON mo.id_modelo = e.modelo_id
            INNER JOIN area a ON a.id_area = e.area_id
            INNER JOIN estado est ON est.id_estado = e.estado_id
            WHERE e.es_activo = 1  AND nombre_area LIKE '%$textoBusqueda%' 
            ORDER BY a.nombre_area, YEAR(fecha_alta) ASC, MONTH(fecha_alta) ASC 
            LIMIT $inicio, $limit ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);




            if (!empty($marcas)) {
                $listado = array();
                foreach ($marcas as $marca) {
                    $listado[] = array(
                        "id" => $marca["id_equipos"],
                        "codigo" => $marca["cod_equipo"],
                        "nombreArea" => $marca["nombre_area"],
                        'nombreMarca' => $marca["nombre_marca"],
                        'nombreModelo' => $marca["nombre_modelo"],
                        'serie' => $marca["serie"],
                        'margesi' => $marca["margesi"],
                        'ip' => $marca["ip"],
                        'mac' => $marca["mac"],
                        'estado' => $marca["nombre_estado"],
                        'Fecha' => $marca["Fecha"]

                    );
                }


                $sqlNroFilas = "SELECT count(id_equipos) as cantidad FROM equipos WHERE es_activo = 1";
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
    public function llenarCompActualizar($idEquipo)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO temp_componentes(id_equipo_componentes,equipo_id,serie_comp,margesi,esActivo) 
        SELECT 
               id_equipo_componentes,equipo_id,serie_id,e.margesi,esActivo
            FROM equipo_componentes ec
            INNER JOIN equipos e ON ec.equipo_id = e.id_equipos
            WHERE ec.equipo_id = ?;
         ";
        //$conectar -> query("TRUNCATE TABLE temp_componentes; ");
        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $idEquipo);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    /*Insertar y actualizar componentes de tabla temporal */
    /* public function actualizarTempComponentes($idEquipo)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO
        `equipo_componentes` (
            `id_equipo_componentes`,
            `equipo_id`,
            `serie_id`,
            `esActivo` )
        select
        temp_componentes.id_equipo_componentes,
        temp_componentes.equipo_id,
        temp_componentes.serie_comp,
        temp_componentes.esActivo
        from temp_componentes
      where
        temp_componentes.equipo_id = '$idEquipo' 
        on DUPLICATE KEY
        UPDATE
        equipo_componentes.esActivo = temp_componentes.esActivo;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }*/
    /*
    public function mostrarComponentes($idSerie){
        $conectar= parent::conexion();
        $sql ="SELECT ec.equipo_id,ec.serie_id,c.serie,tp.id_tipo_componentes, tp.nombre_tipo_componente,cl.id_clase_componentes,cl.nombre_clase, ma.id_marca, ma.nombre_marca, mo.id_modelo, mo.nombre_modelo,c.componentes_capacidad,est.id_estado, est.nombre_estado  
        FROM equipo_componentes ec 
        INNER JOIN componentes c ON c.serie = ec.serie_id
        INNER JOIN tipo_componentes tp ON tp.id_tipo_componentes = c.tipo_componentes_id
        INNER JOIN clase_componentes cl ON cl.id_clase_componentes = c.clase_componentes_id
        INNER JOIN marca ma on ma.id_marca = c.marca_id
        INNER JOIN modelo mo on mo.id_modelo = c.modelo_id
        INNER JOIN estado est on est.id_estado  = c.estado_id
        WHERE ec.serie_id= '?';";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idSerie);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
     */

    /*componenetes relacionados con los equipos 
    public function componentesEquipoXId($idEquipo)
    {
        $conectar = parent::conexion();
        $sql = "SELECT 
        eq.margesi,
        ec.serie_id,
        tp.nombre_tipo_componente,
        cl.nombre_clase,
        ma.nombre_marca,
        m.nombre_modelo,
        c.componentes_capacidad,
        e.nombre_estado
        FROM equipo_componentes as ec
        INNER JOIN componentes c ON ec.serie_id = c.serie
        INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes
        INNER join clase_componentes cl ON cl.id_clase_componentes = c.clase_componentes_id
        INNER JOIN marca ma ON ma.id_marca = c.marca_id
        INNER JOIN modelo m ON m.id_modelo = c.modelo_id
        INNER JOIN estado e ON e.id_estado = c.estado_id
        INNER JOIN equipos eq ON eq.id_equipos = ec.equipo_id
        WHERE ec.equipo_id= ? AND ec.esActivo = 1;";
        //echo 'consulta sql'.$sql;
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idEquipo);
        $sql->execute();
        $json = [];
        $componentes =  $sql->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($componentes)) {
            $listado = array();
            foreach ($componentes as $componente) {
                $listado[] = array(
                    "nombreTipo" => $componente["nombre_tipo_componente"],
                    'nombreClase' => $componente["nombre_clase"],
                    'nombreMarca' => $componente["nombre_marca"],
                    'nombreModelo' => $componente["nombre_modelo"],
                    'serie' => $componente["serie_id"],
                    'capacidad' => $componente["componentes_capacidad"],
                    'estado' => $componente["nombre_estado"]
                );
            }
            $variable = array("listado" => $listado);
            $jsonString = json_encode($variable);
            echo $jsonString;
        } else {
            $resultado = array("listado" => "vacio");
            $jsonString = json_encode($resultado);
            echo $jsonString;
        }
    }
*/
    public function traerEquipoXId($idEquipo)
    {
        $conectar = parent::conexion();
        $sql = "SELECT e.id_equipos,
        tc.id_tipo_componentes,
        tc.nombre_tipo_componente,
        e.serie,
        e.margesi,
        ma.id_marca,
        ma.nombre_marca,
        mo.id_modelo,
        mo.nombre_modelo,
        per.id_personal,
        CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombrePersonal,
        e.area_id,
        a.nombre_area,
        e.estado_id,
        est.nombre_estado,
        e.mac,
        e.ip
         FROM equipos e
        INNER JOIN tipo_componentes tc ON tc.id_tipo_componentes = e.tipo_equipo_id
        INNER JOIN marca ma ON e.marca_id = ma.id_marca
        INNER JOIN modelo mo ON e.modelo_id = mo.id_modelo
        INNER JOIN personal per on per.id_personal = e.clientes_id
        INNER JOIN area a ON a.id_area = e.area_id
        INNER JOIN estado est ON est.id_estado = e.estado_id
         WHERE e.id_equipos = ?
        ;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idEquipo);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    /*
    public function actulizarComponentes($idComponentes, $componenteSelect, $claseSelect, $marcaSelect, $modeloSelect, $serie, $capacidad, $estadoSelect)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE componentes
            SET
               tipo_componentes_id = ?,
               clase_componentes_id = ?,
               marca_id=?,
               modelo_id=?,
               serie = ?,
               componentes_capacidad = ?,
               estado_id = ?
            WHERE
            id_componentes = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $componenteSelect);
        $sql->bindValue(2, $claseSelect);
        $sql->bindValue(3, $marcaSelect);
        $sql->bindValue(4, $modeloSelect);
        $sql->bindValue(5, $serie);
        $sql->bindValue(6, $capacidad);
        $sql->bindValue(7, $estadoSelect);
        $sql->bindValue(8, $idComponentes);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }*/

    public function cerrarBoton($idEquipo)
    {
        $conectar = parent::conexion();
        $consulta = "DELETE FROM temp_componentes WHERE equipo_id = ?;";
        $consulta = $conectar->prepare($consulta);
        $consulta->bindValue(1, $idEquipo);
        //echo $consulta;
        if ($consulta->execute()) {
            echo "1";
        } else {
            echo "0";
        }
    }
}
