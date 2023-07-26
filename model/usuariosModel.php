<?php

require_once("../model/loginModel.php");
class Usuario extends Conectar
{

    public function obtenerDatosPersonal($dni)
    {
        $conectar = parent::conexion();

        $sql = "SELECT id_personal, apellidos_personal, nombre_personal, cargo_personal,
        CASE
            WHEN cargo_personal = 0 THEN 'Vacio'
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2
            THEN 'Practicante'
            WHEN cargo_personal = 3
            THEN 'Secretaria'
            WHEN cargo_personal = 4 THEN 'Técnico'
                END as cargoPersonal
                        FROM personal
                        WHERE dni_personal = ?;";

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
                    'nombre' => $row['nombre_personal'],
                    'cargo_personal' => $row['cargo_personal'],
                    'cargoPersonal' => $row['cargoPersonal']
                );
            }


            // $jsonString = json_encode($resultado);
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function guardarUsuario($idPersonal, $usuario, $password)
    {
        $conectar = parent::conexion();
        $login = new Login();
        $cryptpass = $login -> encriptar($password);
        $sql = "INSERT INTO usuario (nombre_usuario,usuario_password,personal_id)
            VALUES ('$usuario', '$cryptpass','$idPersonal')";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function buscarUsuario($pagina = 1)
    {
        $cantidadXHoja = 5;
        $textoBusqueda = $_POST['textoBusqueda'];
        try {
            $conectar = $this->Conexion();
            $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
            //Para comprobar si se a mandado el parametro de registros
            if (isset($_POST['registros'])) {
                $limit = $_POST['registros'];
                $sLimit = "LIMIT $limit";
            }
            $inicio = ($pagina - 1) * $limit;
            //echo $inicio;
            $sql = "SELECT id_usuario,p.dni_personal, p.apellidos_personal, p.nombre_personal, cargo_personal,
            CASE
            WHEN cargo_personal = 0 THEN 'Vacio'
            WHEN cargo_personal = 1 THEN 'Administrador'
            WHEN cargo_personal = 2
            THEN 'Practicante'
            WHEN cargo_personal = 3
            THEN 'Secretaria'
            WHEN cargo_personal = 4 THEN 'Técnico'
                    END as cargoPersonal,u.nombre_usuario
                            FROM personal p
            INNER JOIN usuario u ON p.id_personal = u.personal_id
                            WHERE u.esActivo = 1 AND nombre_personal LIKE '%$textoBusqueda%' 
            ORDER BY apellidos_personal,nombre_personal 
            LIMIT $inicio, $limit";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            $asigRols =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($asigRols)) {
                $listado = array();
                foreach ($asigRols as $asigRol) {
                    $listado[] = array(
                        'id' => $asigRol['id_usuario'],
                        'dni' => $asigRol['dni_personal'],
                        'nombre' => $asigRol['nombre_personal'],
                        'apellidos' => $asigRol['apellidos_personal'],
                        'cargo_personal' => $asigRol['cargo_personal'],
                        'nombreCargo' => $asigRol['cargoPersonal'],
                        'usuario' => $asigRol['nombre_usuario']



                    );
                }

                $sqlNroFilas = "SELECT count(id_usuario) as cantidad FROM usuario WHERE esActivo = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();

                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad'] / $limit);
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

    public function eliminarUsuario($id)
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE usuario SET esActivo = 0 WHERE id_usuario = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }
}
