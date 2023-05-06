<?php
class Area extends Conectar
{
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

    public function buscarArea($filtro, $pagina = 1, $cantidadPagina = 5)
    {
        $conectar = parent::conexion();
        $inicio = ($pagina - 1) * $cantidadPagina;
        $sql = "SELECT * FROM `area`   $filtro  order by id_area limit $inicio,$cantidadPagina";
        //echo $sql;
        $fila = $conectar->prepare($sql);
        $fila->execute();

        $resultado = $fila->fetchAll();

        $fila->closeCursor();
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
            $sqlNroFilas  = "SELECT count(id_area) as cantidad FROM `area`   $filtro";

            $fila2 = $conectar->prepare($sqlNroFilas);
            $fila2->execute();

            $array = $fila2->fetch(PDO::FETCH_LAZY);
            $paginas = ceil($array['cantidad'] / $cantidadPagina);
            $json = array('listado' => $listado, 'paginas' => $paginas, 'pagina' => $pagina, 'total' => $array['cantidad']);
            $jsonString = json_encode($json);
            echo $jsonString;
        }
    }

    public function eliminarArea($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE area SET esActivo = 0 WHERE id_area = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }
}
