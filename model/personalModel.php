<?php 
class Personal extends Conectar{

    public function listarPersonal()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
        $limit = $_POST['registros'];
        $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT id_personal, apellidos_personal, nombres_personal,
        CASE
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2 THEN 'Secretaria'
            WHEN cargo_personal = 3 THEN 'Practicante'
        END AS CargoPersonal, nombre_usuario, password_usuario
        FROM `personal` WHERE es_activo = 1 $sLimit ";
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
                    'apellidos' => $row['apellidos_personal'],
                    'nombre' => $row['nombres_personal'],
                    'cargoPersonal'=>$row['CargoPersonal'],
                    'nombreUsuario' => $row['nombre_usuario'],
                    'contraseña' => $row['password_usuario']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    

}


?>