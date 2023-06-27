<?php
class Dashboard extends Conectar
{
    public function traerTrabajosXMes()
    {
        $conectar = parent::conexion();
        $sql = "SELECT DATE_FORMAT(fecha_alta, '%M') AS mes,
        COUNT(*) AS cantidad_trabajos
        FROM Trabajos
        GROUP BY mes
        ORDER BY fecha_alta;";
        $fila = $conectar->prepare($sql);
        $fila->execute();
        return $resultado = $fila->fetchAll();
    }
}
