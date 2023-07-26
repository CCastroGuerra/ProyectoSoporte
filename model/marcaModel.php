<?php
class Marca extends Conectar
{

    public function listarSelectMarca()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `categoria_marca`ORDER BY nombre_categoria_marca  ";
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
                    'id' => $row['id_categoria_marca'],
                    'nombre' => $row['nombre_categoria_marca']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function agregarMarca($nombreMarca, $valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `marca`(`nombre_marca`,`categoria_marca_id`,`esActivo`) VALUES ('$nombreMarca','$valorSeleccionado',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function actulizarMarca($idMarca, $nombreMarca, $categoriaMarcaId)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE marca
            SET
               nombre_marca=? ,
               categoria_marca_id =?
            WHERE
                id_marca = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombreMarca);
        $sql->bindValue(2, $categoriaMarcaId);
        $sql->bindValue(3, $idMarca);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarMarca($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE marca SET esActivo = 0 WHERE id_marca = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function traeMarcaXId($idMarca)
    {
        $conectar = parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql = "SELECT @con := @con + 1 as NRO, m.id_marca, m.nombre_marca, c.nombre_categoria AS nombre_categoria, m.categoria_marca_id
        FROM marca AS m
        cross join(select @con := 0) r
        INNER JOIN categoria AS c ON m.categoria_marca_id = c.id_categoria where m.id_marca = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idMarca);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function buscarMarca($pagina = 1)
    {
        $conectar = parent::conexion();
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {

            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;
            $sql = "SELECT @con:=@con + 1 as nro, m.id_marca, m.nombre_marca, c.nombre_categoria_marca AS nombre_categoria FROM marca AS m
            cross join(select @con := 0) r
            INNER JOIN categoria_marca AS c ON m.categoria_marca_id = c.id_categoria_marca WHERE m.esActivo = 1 AND (nombre_marca LIKE '$textoBusqueda%' OR nombre_categoria_marca LIKE '$textoBusqueda%'  ) ORDER BY nombre_categoria_marca LIMIT $inicio,$limit ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($marcas)) {
                $listado = array();
                foreach ($marcas as $marca) {
                    $listado[] = array(
                        'nro' => $marca['nro'],
                        "id" => $marca["id_marca"],
                        "nombre" => $marca["nombre_marca"],
                        'nombreCategoria' => $marca["nombre_categoria"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_marca) as cantidad FROM marca WHERE esActivo = 1";
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
