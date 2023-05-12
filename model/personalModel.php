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
        $sql = "SELECT id_personal, apellidos_personal, nombres_personal,cargo_personal cargoId, 
        CASE
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2 THEN 'Secretaria'
            WHEN cargo_personal = 3 THEN 'Practicante'
        END as cargoPersonal, nombre_usuario, password_usuario
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
                    'cargoPersonal'=>$row['cargoPersonal'],
                    'nombreUsuario' => $row['nombre_usuario'],
                    'contraseña' => $row['password_usuario']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function agregarPersonal($apellidoPersonal,$nombrePersonal,$nombreUsuario,$passwordUsuario,$valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `personal` (`id_personal`, `apellidos_personal`, `nombres_personal`, `nombre_usuario`, `password_usuario`, `usuario_alta`, `usuario_elimina`, `usuario_modifica`, `es_activo`, `cargo_personal`) VALUES (NULL, '$apellidoPersonal', '$nombrePersonal', '$nombreUsuario', '$passwordUsuario', now(), '', '', '1', '$valorSeleccionado');";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actulizarPersonal($idPersonal,$apellidoPersonal,$nombrePersonal,$nombreUsuario,$passwordUsuario,$valorSeleccionado){
        $conectar= parent::conexion();
        $sql="UPDATE personal
            SET
               apellido_personal=? ,
               nombres_personal =?,
               nombre_usuario =?,
               password_usuario =?,
               cargo_personal = ?,
               usurio_modifica = now()
            WHERE
                id_personal = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$apellidoPersonal);
        $sql->bindValue(2,$nombrePersonal);
        $sql->bindValue(3,$nombreUsuario);
        $sql->bindValue(4,$passwordUsuario);
        $sql->bindValue(5,$valorSeleccionado);
        $sql->bindValue(6,$idPersonal);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function traePersonalXId($idPersonal){
        $conectar= parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql ="SELECT id_personal, apellidos_personal, nombres_personal,cargo_personal cargoId, 
        CASE
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2 THEN 'Secretaria'
            WHEN cargo_personal = 3 THEN 'Practicante'
        END as cargoPersonal, nombre_usuario, password_usuario
        FROM `personal` WHERE id_personal = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idPersonal);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

}


?>