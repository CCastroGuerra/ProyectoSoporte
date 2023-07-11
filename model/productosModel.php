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
        $sql = 'call sp_listar_productos(:sLimit)';
        $fila = $conectar->prepare($sql);
        $fila->bindParam('sLimit', $sLimit, PDO::PARAM_STR);
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
                    'id' => $row['id_productos'],
                    'codigo' => $row['codigo_productos'],
                    'nombre' => $row['nombre_productos'],
                    'unidad' => $row['unidad_productos'],
                    'cantidad' => $row['cantidad_productos'],
                    'almacen' => $row['Almacen']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function agregarProductos($nombreProducto, $tipoProducto, $presentacionProducto, $cantidadProducto, $valorSeleccionado, $descripcionProductos)
    {
        $conectar = parent::conexion();
        $sql = "call sp_insertar_productos(?,?,?,?,?,?)";
        $fila = $conectar->prepare($sql);
        $fila->bindParam(1, $nombreProducto, PDO::PARAM_STR);
        $fila->bindParam(2, $tipoProducto, PDO::PARAM_INT);
        $fila->bindParam(3, $presentacionProducto, PDO::PARAM_INT);
        $fila->bindParam(4, $cantidadProducto, PDO::PARAM_INT);
        $fila->bindParam(5, $valorSeleccionado, PDO::PARAM_INT);
        $fila->bindParam(6, $descripcionProductos, PDO::PARAM_STR);

        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function agregarPresentacion($nombrePresentacion)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `presentacion` (`id_presentacion`,`nombre_presentacion`, `es_activo`) VALUES (NULL,'$nombrePresentacion',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actualizarProductos($idProductos, $nombreProducto, $tipoProducto, $presentacionProducto, $cantidadProducto, $valorSeleccionado, $descripcionProductos)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE productos
            SET
               nombre_productos=? ,
               tipo_productos =?,
               presentacion_productos =?,
               cantidad_productos =?,
               almacen_id =?,
               descripcion_productos = ?
            WHERE
                id_productos = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombreProducto);
        $sql->bindValue(2, $tipoProducto);
        $sql->bindValue(3, $presentacionProducto);
        $sql->bindValue(4, $cantidadProducto);
        $sql->bindValue(5, $valorSeleccionado);
        $sql->bindValue(6, $descripcionProductos);
        $sql->bindValue(7, $idProductos);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function traeProductosXId($idProductos)
    {
        $conectar = parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql = "SELECT
        @con := @con + 1 as NRO,
        id_productos,
        codigo_productos,
        nombre_productos,tipo_productos tipoId,
        CASE
            WHEN tipo_productos = 0 THEN 'Vacio'
            WHEN tipo_productos = 1 THEN 'Equipo'
            WHEN tipo_productos = 2 THEN 'Componente'
            WHEN tipo_productos = 3 THEN 'Herramienta'
            WHEN tipo_productos = 4 THEN 'Insumo'
        END as Tipo,
        pre.id_presentacion presentacionId, pre.nombre_presentacion,
        cantidad_productos, almacen_id almacenId,
        CASE
            WHEN almacen_id = 0 THEN 'Vacio'
            WHEN almacen_id = 1 THEN 'Almacen 1'
            WHEN almacen_id = 2 THEN 'Almacen 2'
            WHEN almacen_id = 3 THEN 'Almacen 3'
        END as Almacen,
        descripcion_productos
        FROM
        productos p
        cross join(select @con := 0) r
         INNER JOIN
        presentacion pre ON p.presentacion_productos = pre.id_presentacion
   
         WHERE id_productos = ?";
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
            $sql = "UPDATE productos SET esActivo = 0 WHERE id_productos = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function eliminarPresentacion($idPresentacion)
    {
        if (isset($_POST["idPre"])) {
            $idPresentacion = $_POST["idPre"];
            // Resto del código para eliminar
            $conectar = parent::conexion();
            $sql = "UPDATE presentacion SET es_activo = 0 WHERE id_presentacion = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $idPresentacion);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarProductos($pagina = 1)
    {
        $conectar = parent::conexion();
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {

            $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;
            //  echo 'Trae de inicio:'.$inicio;
            //  echo 'Trae de limit:'.$limit;
            /* $filtro ="AND nombre_productos LIKE '%$textoBusqueda%' 
            OR cantidad_productos LIKE '%$textoBusqueda%'
            OR codigo_productos LIKE '%$textoBusqueda%'
             ORDER BY id_productos $sLimit"; */
            $sql = "SELECT @con :=@con + 1 as nro, id_productos ,codigo_productos, nombre_productos, CASE WHEN tipo_productos = 1 THEN 'Equipo' WHEN tipo_productos = 2 THEN 'Componente' WHEN tipo_productos = 3 THEN 'Herramienta' WHEN tipo_productos = 4 THEN 'Insumo' END as Tipo, pre.nombre_presentacion, cantidad_productos, CASE WHEN almacen_id = 1 THEN 'Almacen 1' WHEN almacen_id = 2 THEN 'Almacen 2' WHEN almacen_id = 3 THEN 'Almacen 3' END as Almacen, descripcion_productos FROM productos p
             cross join(select @con := 0) r
              INNER JOIN presentacion pre ON p.presentacion_productos = pre.id_presentacion WHERE esActivo = 1  AND nombre_productos LIKE '%$textoBusqueda%' LIMIT $inicio,$limit";

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
                        'nro' => $producto['nro'],
                        'id' => $producto['id_productos'],
                        'codigo' => $producto['codigo_productos'],
                        'nombre' => $producto['nombre_productos'],
                        'tipo' => $producto['Tipo'],
                        'presentacion' => $producto['nombre_presentacion'],
                        'cantidad' => $producto['cantidad_productos'],
                        'almacen' => $producto['Almacen']
                    );
                }

                $sqlNroFilas = "SELECT count(id_productos) as cantidad FROM productos WHERE esActivo = 1 ";
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

    public function bucarPresentacion($pagina = 1)
    {
        $conectar = parent::conexion();
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {

            $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;
            $sql = "SELECT * FROM `presentacion` WHERE es_activo = 1 AND nombre_presentacion LIKE '$textoBusqueda%'  ORDER BY nombre_presentacion  LIMIT $inicio,$limit  ";
            $fila = $conectar->prepare($sql);
            $fila->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $presentaciones =  $fila->fetchAll(PDO::FETCH_ASSOC);
            $fila->closeCursor();
            if (!empty($presentaciones)) {
                $listado = array();
                foreach ($presentaciones as $presentacione) {
                    $listado[] = array(
                        'id' => $presentacione['id_presentacion'],
                        'nombre' => $presentacione['nombre_presentacion']

                    );
                }

                $sqlNroFilas = "SELECT count(id_presentacion) as cantidad FROM presentacion WHERE es_activo = 1";
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

    public function listarCombo()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_presentacion, nombre_presentacion from presentacion where es_activo = 1";
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
                    'id' => $row['id_presentacion'],
                    'nombre' => $row['nombre_presentacion']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
}
