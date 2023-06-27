<?php
class Dashboard extends Conectar
{
    public function traerTrabajosXMes()
    {
        $conectar = parent::conexion();
        $sql = "SELECT mes_nombre, COUNT(*) AS cantidad_trabajos
        FROM (
            SELECT DATE_FORMAT(fecha_alta, '%m') AS mes_numero
            FROM Trabajos
        ) t1
        JOIN (
            SELECT 'enero' AS mes_nombre, '01' AS mes_numero
            UNION SELECT 'febrero', '02'
            UNION SELECT 'marzo', '03'
            UNION SELECT 'abril', '04'
            UNION SELECT 'mayo', '05'
            UNION SELECT 'junio', '06'
            UNION SELECT 'julio', '07'
            UNION SELECT 'agosto', '08'
            UNION SELECT 'septiembre', '09'
            UNION SELECT 'octubre', '10'
            UNION SELECT 'noviembre', '11'
            UNION SELECT 'diciembre', '12'
        ) t2 ON t1.mes_numero = t2.mes_numero
        GROUP BY mes_nombre
        ORDER BY FIELD(t2.mes_numero, '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        ";
        $fila = $conectar->prepare($sql);
        $fila->execute();
        return $resultado = $fila->fetchAll();
    }
}
