<?php

class Producto extends Conectar
{

    public function listarProductos()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT id_productos,nombre_productos,cantidad,
        CASE
            WHEN almacen_id = 1 THEN 'Almacen 1'
            WHEN almacen_id = 2 THEN 'Almacen 2'
            WHEN almacen_id = 3 THEN 'Almacen 3'
        END as Almacen
        FROM productos WHERE es_activo = 1 $sLimit ";
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
                    'id' => $row['id_productos'],
                    'nombre' => $row['nombre_productos'],
                    'cantidad' => $row['cantidad'],
                    'almacen' => $row['Almacen']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function agregarProductos($nombreProducto, $cantidadProducto, $valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `productos` (`id_productos`, `nombre_productos`, `cantidad`, `almacen_id`, `es_activo`) VALUES (NULL,'$nombreProducto','$cantidadProducto', '$valorSeleccionado',1);";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actualizarPersonal($idProductos, $nombreProducto, $cantidadProducto, $valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE personal
            SET
               nombre_productos=? ,
               cantidad =?,
               almacen_id =?
            WHERE
                id_productos = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombreProducto);
        $sql->bindValue(2, $cantidadProducto);
        $sql->bindValue(3, $valorSeleccionado);
        $sql->bindValue(4, $idProductos);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function traeProductosXId($idProductos)
    {
        $conectar = parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql = "SELECT id_productos,nombre_productos,cantidad,
        CASE
            WHEN almacen_id = 1 THEN 'Almacen 1'
            WHEN almacen_id = 2 THEN 'Almacen 2'
            WHEN almacen_id = 3 THEN 'Almacen 3'
        END as Almacen
        FROM productos WHERE id_productos = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idProductos);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function eliminarProductos($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE productos SET es_activo = 0 WHERE id_productos = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarPersonal($pagina = 1)
    {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            // $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            // //Para comprobar si se a mandado el parametro de registros
            // if (isset($_POST['registros'])) {
            // $limit = $_POST['registros'];
            // $sLimit = "LIMIT $limit";
            // }
            $inicio = ($pagina - 1) * $cantidadXHoja;
            //echo $inicio;
            // $sql = "SELECT * FROM `marca` WHERE esActivo = 1 AND nombre_marca LIKE '$textoBusqueda%'  ORDER BY id_marca LIMIT $inicio,$cantidadXHoja";
            $sql = "SELECT id_productos,nombre_productos,cantidad,
            CASE
                WHEN almacen_id = 1 THEN 'Almacen 1'
                WHEN almacen_id = 2 THEN 'Almacen 2'
                WHEN almacen_id = 3 THEN 'Almacen 3'
            END as Almacen
            FROM productos WHERE es_activo = 1 AND nombre_productos LIKE '%$textoBusqueda%'  ORDER BY id_productos LIMIT $inicio,$cantidadXHoja ";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $productos =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($productos)) {
                $listado = array();
                foreach ($productos as $producto) {
                    $listado[] = array(
                        'id' => $producto['id_productos'],
                        'nombre' => $producto['nombre_productos'],
                        'cantidad' => $producto['cantidad'],
                        'almacen' => $producto['Almacen']
                    );
                }

                $sqlNroFilas = "SELECT count(id_productos) as cantidad FROM productos WHERE es_activo = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();

                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad'] / $cantidadXHoja);
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
