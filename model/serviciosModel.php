<?php

class Servicio extends Conectar
{

    public function listarServicio()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT * FROM `servicios` WHERE esActivo = 1 $sLimit ";
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

    public function agregarServicio($nombreServicio, $tipoTrabajo)
    {
        $conectar = parent::conexion();
        // $tipoTrabajo = ($nombreServicio === "Cambio de tinta") ? 1 : 2; // Determina el valor de tipoTrabajo según el nombre del servicio
        $sql = "INSERT INTO `servicios`(`nombre_servicios`,`tipoTrabajo`,`esActivo`) VALUES ('$nombreServicio','$tipoTrabajo', 1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actualizarServicio($idServicio, $nombreServicio)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE servicios
            SET
               nombre_servicios=? 
            WHERE
                id_servicios = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombreServicio);
        $sql->bindValue(2, $idServicio);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function traerServicioXId($idServicio)
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM servicios WHERE id_servicios = ? AND `esActivo` = 1;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idServicio);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarServicio($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE servicios SET esActivo = 0 WHERE id_servicios = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }


    public function buscarServicio($pagina = 1)
    {
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
            $inicio = ($pagina - 1) * $limit;
            //echo $inicio;
            $sql = "SELECT * FROM `servicios` WHERE esActivo = 1 AND nombre_servicios LIKE '$textoBusqueda%'  ORDER BY nombre_servicios LIMIT $inicio,$limit";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $areas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($areas)) {
                $listado = array();
                foreach ($areas as $area) {
                    $listado[] = array(
                        "id" => $area["id_servicios"],
                        "nombre" => $area["nombre_servicios"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_servicios) as cantidad FROM `servicios` WHERE esActivo = 1 AND nombre_servicios LIKE '$textoBusqueda%'  ORDER BY nombre_servicios";
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
