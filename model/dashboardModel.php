<?php
class Dashboard extends Conectar
{
    public function revisarProductosxTerm()
    {
        $conectar = parent::conexion();
        $sql = "select 
        p.id_productos,
        p.codigo_productos,
        p.nombre_productos,
        (CASE
            WHEN p.tipo_productos = 0 THEN 'Vacio'
            WHEN p.tipo_productos = 1 THEN 'Equipo'
            WHEN p.tipo_productos = 2 THEN 'Componente'
            WHEN p.tipo_productos = 3 THEN 'Herramienta'
            WHEN p.tipo_productos = 4 THEN 'Insumo'
            WHEN p.tipo_productos = 5 THEN 'Insumo Impresora'
        END) as Tipo,
        p.cantidad_productos,
        p.presentacion_productos,
        pres.nombre_presentacion NPres,
        (CASE 
            WHEN m.tipo_movimientos = 1 THEN 'ENTRADA'
            WHEN m.tipo_movimientos = 2 THEN 'SALIDA' 
            ELSE  'REGISTRO'
        END) movi,
        p.fecha_crea,
        p.fecha_modi
    FROM productos p
    INNER JOIN presentacion pres ON p.presentacion_productos = pres.id_presentacion
    LEFT JOIN (select t1.* from movimientos t1
                where (t1.id_movimientos,t1.producto_id) IN
                    (select max(t2.id_movimientos),max(t2.producto_id) from movimientos t2 GROUP BY t2.producto_id)) m 
        ON p.id_productos=m.producto_id
    WHERE p.cantidad_productos<4 and p.`esActivo`=1
    ORDER BY p.fecha_modi desc;";
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
