<?php

class Equipos extends Conectar {

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

    public function guardarEquipo($serie,$margesi,$marcaId,$modeloId,$idTipo,$areaId,$responsable,$estadoId,$ip,$mac)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO equipos (serie,margesi,marca_id,modelo_id,tipo_equipo_id,area_id,clientes_id,estado_id,ip,mac)
        VALUES ( '$serie','$margesi','$marcaId','$modeloId','$idTipo','$areaId','$responsable','$estadoId','$ip','$mac');";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function guardarComponetesTemp($serie)
    {
        $conectar = parent::conexion();
    
        $sql = "INSERT INTO temp_componentes(serie,tipo_componentes_id,clase_componentes_id,marca_id,modelo_id,componentes_capacidad,estado_id)SELECT serie,tp.id_tipo_componentes,cc.id_clase_componentes,ma.id_marca, m.id_modelo,componentes_capacidad, e.id_estado FROM componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id WHERE serie =?";
        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $serie);

        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }

        
    }


    public function guardarEquipoComponente($equipoSerie)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO equipo_componentes (equipo_id, serie_id) SELECT equipos.id_equipos, temp_componentes.serie FROM equipos, temp_componentes WHERE equipos.serie = '$equipoSerie';
        TRUNCATE TABLE temp_componentes;
         ";
        //$conectar -> query("TRUNCATE TABLE temp_componentes; ");
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
       
        
    }

    public function listarTipoEquipo()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tipo_equipo";
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
            $inicio = ($pagina-1)*$cantidadXPagina;
            $sql = "SELECT id_personal, CONCAT(nombre_personal, ' ' ,apellidos_personal) as  NombrePersonal, dni_personal FROM personal
            WHERE `esActivo_personal` = 1 AND CONCAT(nombre_personal, ' ' ,apellidos_personal) LIKE '%$textoBusqueda%' 
            OR dni_personal LIKE '%$textoBusqueda%' 
            ORDER BY NombrePersonal ASC
            LIMIT $inicio, $cantidadXPagina ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);




            if(!empty($marcas)){
                $listado = array();
                foreach($marcas as $marca){
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
                $paginas = ceil($array['cantidad']/$cantidadXPagina);
                //echo 'Imprimiendo paginas: '.$paginas;

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

    public function listarTablaTemp()
    {
       $conectar = parent::conexion();
        
        $sql = "SELECT id_componentes,serie,tp.nombre_tipo_componente,cc.nombre_clase,ma.nombre_marca, m.nombre_modelo,c.componentes_capacidad, e.nombre_estado FROM temp_componentes c INNER JOIN tipo_componentes tp ON c.tipo_componentes_id = tp.id_tipo_componentes INNER JOIN clase_componentes cc ON cc.id_clase_componentes = c.clase_componentes_id INNER JOIN marca ma ON ma.id_marca = c.marca_id INNER JOIN modelo m ON m.id_modelo = c.modelo_id INNER JOIN estado e ON e.id_estado = c.estado_id; 
        ";
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
                    "id" => $row["id_componentes"],
                    "nombreTipo" => $row["nombre_tipo_componente"],
                    'nombreClase' => $row["nombre_clase"],
                    'nombreMarca' => $row["nombre_marca"],
                    'nombreModelo' => $row["nombre_modelo"],
                    'capacidad' => $row["componentes_capacidad"],
                    'serie' => $row["serie"],
                    'estado' => $row["nombre_estado"]
                    


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function eliminarComponentesTemp($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "DELETE FROM `temp_componentes` WHERE id_componentes = ?; ";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarEquipo($pagina = 1) {
        $conectar = parent::conexion();
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
           
            if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            }
            // if($pagina = 0){
            //     $pagina = 1;
            // }
            $inicio = ($pagina-1)*$limit;
            $sql = "SELECT id_equipos,e.area_id,a.nombre_area,e.marca_id, mar.nombre_marca,e.modelo_id,mo.nombre_modelo,serie,margesi, ip,mac,e.estado_id, est.nombre_estado,DATE_FORMAT(fecha_alta,'%d/%m/%y') as Fecha from equipos e
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




            if(!empty($marcas)){
                $listado = array();
                foreach($marcas as $marca){
                    $listado[] = array(
                        "id" => $marca["id_equipos"],
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
                $paginas = ceil($array['cantidad']/$limit);
                //echo 'Imprimiendo paginas: '.$paginas;

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
}


?>