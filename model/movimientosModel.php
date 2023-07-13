<?php
class Movimiento extends Conectar
{

    public function listarTecnicos()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_personal, CONCAT(nombre_personal, ' ', apellidos_personal) NombrePersonal,cargo_personal,
        CASE
            WHEN cargo_personal = 0 THEN 'Vacio'
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2 THEN 'Secretaria'
            WHEN cargo_personal = 3 THEN 'Practicante'
            WHEN cargo_personal = 4 THEN 'Técnico'
        END as nombreCargoPersonal
        FROM personal WHERE `esActivo_personal` = 1 AND cargo_personal = 4;";
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
                    'id' => $row['id_personal'],
                    'nombreTecnico' => $row['NombrePersonal']


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

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
}
