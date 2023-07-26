<?php

class Rol extends Conectar{

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

    public function agregarRol($nombreRol)
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

    public function actulizarRol($idRol,$nombreRol){
        $conectar= parent::conexion();
        $sql="UPDATE roles
            SET
               nombre_roles=? 
            WHERE
                id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombreRol);
        $sql->bindValue(2,$idRol);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function traerRolXId($idRol){
        $conectar= parent::conexion();
        $sql="SELECT * FROM roles WHERE id_roles = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idRol);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function eliminarRol($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE roles SET esActivo = 0 WHERE id_roles = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }




    public function buscarRol($pagina = 1) {
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
            $inicio = ($pagina-1)*$limit;
            //echo $inicio;
            $sql = "SELECT * FROM `roles` WHERE esActivo = 1 AND nombre_roles LIKE '$textoBusqueda%'  ORDER BY nombre_roles LIMIT $inicio,$limit";
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

                $sqlNroFilas = "SELECT count(id_roles) as cantidad FROM roles WHERE esActivo = 1";
                $fila2 = $conectar->prepare($sqlNroFilas);
                $fila2->execute();
    
                $array = $fila2->fetch(PDO::FETCH_LAZY);
                $paginas = ceil($array['cantidad']/$limit);
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
