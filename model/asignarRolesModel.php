<?php
class asignarRoles extends Conectar
{

    public function guardarRoles($idPersonal, $idRolSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO rol_personal ( personal_id, rol_id,esActivo)
        VALUES ( $idPersonal, $idRolSeleccionado,1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function obtenerDatosPersonal($dni)
    {
        $conectar = parent::conexion();

        $sql = "SELECT id_personal, apellidos_personal, nombres_personal
                FROM personal
                WHERE nombre_usuario = ?";

        $fila = $conectar->prepare($sql);
        $fila->bindValue(1, $dni);
        $fila->execute();

        $resultado = $fila->fetchAll();

        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
        } else {
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                    'id' => $row['id_personal'],
                    'apellidos' => $row['apellidos_personal'],
                    'nombre' => $row['nombres_personal'],
                );
            }


            // $jsonString = json_encode($resultado);
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarComboRol()
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

    public function listarRoles()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
            $limit = $_POST['registros'];
            $sLimit = "LIMIT $limit";
        }

        $sql = "SELECT rp.id_rol_personal, p.nombres_personal, p.apellidos_personal, r.nombre_roles
        FROM personal p
        INNER JOIN rol_personal rp ON rp.personal_id = p.id_personal
        INNER JOIN roles AS r ON rp.rol_id = r.id_roles WHERE rp.esActivo = 1 $sLimit ";
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
                    'id' => $row['id_rol_personal'],
                    'nombre' => $row['nombres_personal'],
                    'apellidos' => $row['apellidos_personal'],
                    'nombreRol' => $row['nombre_roles']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function actulizarAsigRol($idAsigRol, $rolId,)
    {
        $conectar = parent::conexion();
        $sql = "UPDATE rol_personal
            SET
               rol_id=?
            WHERE
                id_rol_personal = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $rolId);
        $sql->bindValue(2, $idAsigRol);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function traerAsigRolXId($idAsigRol)
    {
        $conectar = parent::conexion();
        $sql = "SELECT rp.id_rol_personal, p.nombre_usuario, r.nombre_roles, rp.rol_id 
        FROM personal p
        INNER JOIN rol_personal rp ON rp.personal_id = p.id_personal
        INNER JOIN roles AS r ON rp.rol_id = r.id_roles WHERE rp.id_rol_personal = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $idAsigRol);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarAsigRol($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE rol_personal SET esActivo = 0 WHERE id_rol_personal = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function buscarAsigRol($pagina = 1)
    {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            $inicio = ($pagina - 1) * $cantidadXHoja;
            //echo $inicio;
            $sql = "SELECT rp.id_rol_personal, p.nombres_personal, p.apellidos_personal, r.nombre_roles
            FROM personal p
            INNER JOIN rol_personal rp ON rp.personal_id = p.id_personal
            INNER JOIN roles AS r ON rp.rol_id = r.id_roles
            WHERE rp.esActivo = 1 AND nombres_personal LIKE '%$textoBusqueda%' 
            ORDER BY id_rol_personal 
            LIMIT $inicio, $cantidadXHoja"; 
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $asigRols =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($asigRols)) {
                $listado = array();
                foreach ($asigRols as $asigRol) {
                    $listado[] = array(
                        'id' => $asigRol['id_rol_personal'],
                        'nombre' => $asigRol['nombres_personal'],
                        'apellidos' => $asigRol['apellidos_personal'],
                        'nombreRol' => $asigRol['nombre_roles']
                    );
                }

                $sqlNroFilas = "SELECT count(id_rol_personal) as cantidad FROM rol_personal WHERE esActivo = 1";
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
}
