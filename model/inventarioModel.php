<?php

class Inventario extends Conectar
{
    public function salidaProductos($codProducto, $cantidad)
    {
        $conectar = parent::conexion();
        $query = "SELECT CAST(cantidad_productos as int) cant FROM productos  WHERE codigo_productos = '$codProducto' ";
        $stmt = $conectar->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_LAZY);
        $cantidadActual = $resultado['cant'];
        // echo $cantidadActual;
        // //$stmt->closeCursor();
        // echo $cantidad;
        // echo "<br/>";
        // echo "Cantidad Formulario " . $cantidad;
        if ($cantidad <= $cantidadActual) {
            $nuevaCantidad = $cantidadActual - $cantidad;

            //Actualizar cantidad del producto

            $consulta = "UPDATE productos SET cantidad_productos = ?  WHERE codigo_productos = ?";
            $stmt = $conectar->prepare($consulta);
            $stmt->bindValue(1, $nuevaCantidad);
            $stmt->bindValue(2, $codProducto, PDO::PARAM_STR);
            $stmt->execute();
            echo '1';
        } else {
            echo '0';
        }
    }

    public function entradaProductos($codProducto, $cantidad)
    {
        $conectar = parent::conexion();
        $query = "SELECT CAST(cantidad_productos as int) cant FROM productos  WHERE codigo_productos = '$codProducto' ";
        $stmt = $conectar->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_LAZY);
        $cantidadActual = $resultado['cant'];
        if ($cantidad >= 0) {
            $nuevaCantidad = $cantidadActual + $cantidad;

            //Actualizar cantidad del producto

            $consulta = "UPDATE productos SET cantidad_productos = ?  WHERE codigo_productos = ?";
            $stmt = $conectar->prepare($consulta);
            $stmt->bindValue(1, $nuevaCantidad);
            $stmt->bindValue(2, $codProducto, PDO::PARAM_STR);
            $stmt->execute();
            echo '1';
        } else {
            echo '0';
        }
    }

    public function nombreProducto($codProducto)
    {
        $conectar = parent::conexion();
        $query = "SELECT id_productos,nombre_productos, cantidad_productos
        from productos
        WHERE codigo_productos = ?";
        $fila = $conectar->prepare($query);
        $fila->bindValue(1, $codProducto);
        $fila->execute();
        $nombreCantidad = $fila->fetch(PDO::FETCH_ASSOC);

        echo json_encode($nombreCantidad);
    }

    public function guardarEntrada($cantidad, $tipoMovimiento, $codProducto)
    {
        $conectar = parent::conexion();
        $query = "INSERT INTO movimientos (producto_id, cantidad, tipo_movimientos)
        SELECT id_productos, ?, ? FROM productos WHERE codigo_productos = ?;";
        $fila = $conectar->prepare($query);
        $fila->bindValue(1, $cantidad);
        $fila->bindValue(2, $tipoMovimiento);
        $fila->bindValue(3, $codProducto);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function guardarSalida($cantidad, $tipoMovimiento, $codProducto)
    {
        $conectar = parent::conexion();
        $query = "INSERT INTO movimientos (producto_id, cantidad, tipo_movimientos)
        SELECT id_productos, ?, ? FROM productos WHERE codigo_productos = ?;";
        $fila = $conectar->prepare($query);
        $fila->bindValue(1, $cantidad);
        $fila->bindValue(2, $tipoMovimiento);
        $fila->bindValue(3, $codProducto);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function buscarEntradas($pagina = 1)
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

            $sql = "SELECT m.id_movimientos,p.nombre_productos,
            m.cantidad
                 from movimientos m
            INNER JOIN productos p ON p.id_productos = m.producto_id
             WHERE tipo_movimientos = 1 AND p.nombre_productos LIKE '%$textoBusqueda%' LIMIT $inicio,$limit";

            $fila = $conectar->prepare($sql);
            //$fila -> bindParam('filtro', $filtro,PDO::PARAM_STR);
            $fila->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $productos =  $fila->fetchAll(PDO::FETCH_ASSOC);
            $fila->closeCursor();
            if (!empty($productos)) {
                $listado = array();
                foreach ($productos as $producto) {
                    $listado[] = array(
                        'id' => $producto['id_movimientos'],
                        'nombreProducto' => $producto['nombre_productos'],
                        'cantidad' => $producto['cantidad']

                    );
                }

                $sqlNroFilas = "SELECT count(id_movimientos) as cantidad FROM movimientos WHERE tipo_movimientos = 1 ";
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

    public function buscarSalidas($pagina = 1)
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

            $sql = "SELECT m.id_movimientos,p.nombre_productos,
            m.cantidad
                 from movimientos m
            INNER JOIN productos p ON p.id_productos = m.producto_id
             WHERE tipo_movimientos = 2 AND p.nombre_productos LIKE '%$textoBusqueda%' LIMIT $inicio,$limit";

            $fila = $conectar->prepare($sql);
            //$fila -> bindParam('filtro', $filtro,PDO::PARAM_STR);
            $fila->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $productos =  $fila->fetchAll(PDO::FETCH_ASSOC);
            $fila->closeCursor();
            if (!empty($productos)) {
                $listado = array();
                foreach ($productos as $producto) {
                    $listado[] = array(
                        'id' => $producto['id_movimientos'],
                        'nombreProducto' => $producto['nombre_productos'],
                        'cantidad' => $producto['cantidad']

                    );
                }

                $sqlNroFilas = "SELECT count(id_movimientos) as cantidad FROM movimientos WHERE tipo_movimientos = 2 ";
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

    public function buscarResumen($pagina = 1)
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

            $sql = "SELECT m.id_movimientos,
            p.nombre_productos,
            m.cantidad,
            CASE
                WHEN tipo_movimientos = 1 THEN 'ENTRADA'
                WHEN tipo_movimientos = 2 THEN 'SALIDA' 
            END AS estado
        from movimientos m
            INNER JOIN productos p ON p.id_productos = m.producto_id
             WHERE  p.nombre_productos LIKE '%$textoBusqueda%' LIMIT $inicio,$limit";

            $fila = $conectar->prepare($sql);
            //$fila -> bindParam('filtro', $filtro,PDO::PARAM_STR);
            $fila->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $productos =  $fila->fetchAll(PDO::FETCH_ASSOC);
            $fila->closeCursor();
            if (!empty($productos)) {
                $listado = array();
                foreach ($productos as $producto) {
                    $listado[] = array(
                        'id' => $producto['id_movimientos'],
                        'nombreProducto' => $producto['nombre_productos'],
                        'cantidad' => $producto['cantidad'],
                        'estado' => $producto['estado']

                    );
                }

                $sqlNroFilas = "SELECT count(id_movimientos) as cantidad FROM movimientos";
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
