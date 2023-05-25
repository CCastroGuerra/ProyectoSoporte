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
               apellidos_personal=? ,
               nombres_personal =?,
               nombre_usuario =?,
               password_usuario =?,
               cargo_personal = ?,
               usuario_modifica = now()
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
        return $sql->fetchAll();
    }

    public function eliminarPersonal($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE personal SET es_activo = 0,usuario_elimina=now() WHERE id_personal = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarPersonal($pagina = 1) {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            // $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            // //Para comprobar si se a mandado el parametro de registros
            // if (isset($_POST['registros'])) {
            // $limit = $_POST['registros'];
            // $sLimit = "LIMIT $limit";
            // }
            $inicio = ($pagina-1)*$cantidadXHoja;
            //echo $inicio;
            // $sql = "SELECT * FROM `marca` WHERE esActivo = 1 AND nombre_marca LIKE '$textoBusqueda%'  ORDER BY id_marca LIMIT $inicio,$cantidadXHoja";
            $sql = "SELECT id_personal, apellidos_personal, nombres_personal,cargo_personal cargoId, 
            CASE
                WHEN cargo_personal = 1 THEN 'Administrador'
                WHEN cargo_personal = 2 THEN 'Secretaria'
                WHEN cargo_personal = 3 THEN 'Practicante'
            END as cargoPersonal, nombre_usuario, password_usuario
            FROM `personal` WHERE es_activo = 1 AND nombres_personal LIKE '%$textoBusqueda%'  ORDER BY id_personal LIMIT $inicio,$cantidadXHoja ";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $pesonals =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($pesonals)){
                $listado = array();
                foreach($pesonals as $personal){
                    $listado[] = array(
                    'id' => $personal['id_personal'],
                    'apellidos' => $personal['apellidos_personal'],
                    'nombre' => $personal['nombres_personal'],
                    'cargoPersonal'=>$personal['cargoPersonal'],
                    'nombreUsuario' => $personal['nombre_usuario'],
                    'contraseña' => $personal['password_usuario']
                    );
                }

                $sqlNroFilas = "SELECT count(id_personal) as cantidad FROM personal WHERE es_activo = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();
    
                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad']/$cantidadXHoja);
                $json = array('listado' => $listado, 'paginas' => $paginas, 'pagina' =>$pagina, 'total' => $array['cantidad']);
                $jsonString  = json_encode($json);
                echo $jsonString;

            }else{
                $resultado = array("listado" => "vacio");
                $jsonString = json_encode($resultado);
                echo $jsonString;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } 

}


?>