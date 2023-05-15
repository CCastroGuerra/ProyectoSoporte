<?php
class asignarRoles extends Conectar{

    public function guardarRoles($apellidoPersonal, $nombrePersonal,$idRolSeleccionado){
        
        $conectar = parent::conexion();
        $sql = "INSERT INTO rol_personal ( apellido_personal, nombre_personal, id_rol)
        VALUES ( '$apellidoPersonal', '$nombrePersonal', $idRolSeleccionado)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function obtenerDatosPersonal($dni){
        $conectar = parent::conexion();
        $sql = "SELECT apellidos_personal, nombres_personal
        FROM personal
        WHERE nombre_usuario = $dni ";
        $fila = $conectar->prepare($sql);
        $fila->execute();
    }

    public function listarRol()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
        $limit = $_POST['registros'];
        $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT * FROM `roles` WHERE esActivo = 1 $sLimit ";
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
                    'id' => $row['id_roles'],
                    'nombre' => $row['nombre_roles']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
}
?>