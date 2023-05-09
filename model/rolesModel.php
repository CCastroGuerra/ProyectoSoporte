<?php

class Rol extends Conectar{

    public function listarRoles()
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

    public function agregarRoles($nombreRol)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `roles`(`nombre_roles`,`esActivo`) VALUES ('$nombreRol',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actualizarRoles($idRoles,$nombreRol){
        $conectar= parent::conexion();
        $sql="UPDATE roles
            SET
               nombre_roles=? 
            WHERE
                id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombreRol);
        $sql->bindValue(2,$idRoles);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function traerRolesXId($idRoles){
        $conectar= parent::conexion();
        $sql="SELECT * FROM roles WHERE id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idRoles);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function eliminarRoles($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE roles SET esActivo = 0 WHERE id_area = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    // public function buscarArea() {
    //     $textoBusqueda = $_POST['textoBusqueda'];

    //     try {
    //         $conectar = $this->Conexion();
    //         $sql = "SELECT * FROM `area` WHERE esActivo = 1 AND nombre_area LIKE ?";
    //         $stmt = $conectar->prepare($sql);
    //         $stmt->bindValue(1, '%' . $textoBusqueda . '%');
    //         $stmt->execute();
        
    //         $resultados = array();
    //         while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //             $resultados[] = $fila["nombre_area"];
    //         }

    //         echo json_encode($resultados);
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
    public function buscarRoles($pagina = 1) {
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
            $sql = "SELECT * FROM `roles` WHERE esActivo = 1 AND nombre_roles LIKE '$textoBusqueda%'  ORDER BY id_roles LIMIT $inicio,$cantidadXHoja";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $roles =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($roles)){
                $listado = array();
                foreach($roles as $rol){
                    $listado[] = array(
                        "id" => $rol["id_roles"],
                        "nombre" => $rol["nombre_roles"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_roles) as cantidad FROM area WHERE esActivo = 1";
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
