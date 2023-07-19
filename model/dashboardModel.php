<?php
class Dashboard extends Conectar
{
    public function revisarProductosxTerm()
    {
        $conectar = parent::conexion();
        $sql = "SELECT p.id_productos,p.codigo_productos,p.nombre_productos,p.tipo_productos,
        CASE
                    WHEN p.tipo_productos = 0 THEN 'Vacio'
                    WHEN p.tipo_productos = 1 THEN 'Equipo'
                    WHEN p.tipo_productos = 2 THEN 'Componente'
                    WHEN p.tipo_productos = 3 THEN 'Herramienta'
                    WHEN p.tipo_productos = 4 THEN 'Insumo'
                END as Tipo,
        p.presentacion_productos,pre.nombre_presentacion as NPres,
        p.cantidad_productos,
        (select CASE
            WHEN m_.tipo_movimientos = 1 THEN 'ENTRADA'
            WHEN m_.tipo_movimientos = 2 THEN 'SALIDA'
            ELSE 'Última modificación'
        END AS movi from movimientos m_ where (m_.producto_id = p.id_productos) ORDER BY m_.fecha DESC LIMIT 1) as movi,
        p.fecha_crea,
        p.fecha_modi
        FROM productos p
        INNER JOIN presentacion pre ON p.presentacion_productos = pre.id_presentacion
        WHERE p.cantidad_productos<3 and p.esActivo = '1'";
        $fila = $conectar->prepare($sql);
        $fila->execute();
        $datos = $fila->fetchAll();
        $resultado = array();
        //var_dump($datos);
        return $datos;
    }

    public function traerTrabajosXMes()
    {
        $conectar = parent::conexion();
        $sql = "SELECT mes_nombre, COUNT(*) AS cantidad_trabajos
        FROM (
            SELECT DATE_FORMAT(fecha_alta, '%m') AS mes_numero
            FROM Trabajos where es_activo=1
        ) t1
        JOIN (
            SELECT 'enero' AS mes_nombre, '01' AS mes_numero
            UNION SELECT 'Febrero', '02'
            UNION SELECT 'Marzo', '03'
            UNION SELECT 'Abril', '04'
            UNION SELECT 'Mayo', '05'
            UNION SELECT 'Junio', '06'
            UNION SELECT 'Julio', '07'
            UNION SELECT 'Agosto', '08'
            UNION SELECT 'Septiembre', '09'
            UNION SELECT 'Octubre', '10'
            UNION SELECT 'Noviembre', '11'
            UNION SELECT 'Diciembre', '12'
        ) t2 ON t1.mes_numero = t2.mes_numero
        GROUP BY mes_nombre
        ORDER BY FIELD(t2.mes_numero, '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        ";
        $fila = $conectar->prepare($sql);
        $fila->execute();
        return $resultado = $fila->fetchAll();
    }

    public function traerTrabajosxArea()
    {
        $conectar = parent::conexion();
        $sql = "SELECT a.nombre_area,
        COUNT(t.area_id) AS cantidad_trabajos
    FROM area a
        INNER JOIN trabajos t ON t.area_id = a.id_area
    GROUP BY a.nombre_area;";
        $fila = $conectar->prepare($sql);
        $fila->execute();
        return $resultado = $fila->fetchAll();
        
    }
}
