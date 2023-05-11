<?php 
class Marca extends Conectar{

    public function listarSelectMarca()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `categoria` WHERE esActivo = 1 ORDER BY nombre_categoria ASC";
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
                    'id' => $row['id_categoria'],
                    'nombre' => $row['nombre_categoria']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function listarMarcas()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
        $limit = $_POST['registros'];
        $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT m.id_marca, m.nombre_marca, c.nombre_categoria AS nombre_categoria FROM marca AS m INNER JOIN categoria AS c ON m.categoria_marca_id = c.id_categoria WHERE m.esActivo = 1 $sLimit ";
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
                    'id' => $row['id_marca'],
                    'nombre' => $row['nombre_marca'],
                    'nombreCategoria'=>$row['nombre_categoria']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function agregarMarca($nombreMarca, $valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `marca`(`nombre_marca`,`categoria_marca_id`,`esActivo`) VALUES ('$nombreMarca','$valorSeleccionado',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function actulizarMarca($idMarca,$nombreMarca,$categoriaMarcaId){
        $conectar= parent::conexion();
        $sql="UPDATE marca
            SET
               nombre_marca=? ,
               categoria_marca_id =?
            WHERE
                id_marca = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombreMarca);
        $sql->bindValue(2,$categoriaMarcaId);
        $sql->bindValue(3,$idMarca);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function eliminarMarca($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE marca SET esActivo = 0 WHERE id_marca = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function traeMarcaXId($idMarca){
        $conectar= parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql ="SELECT m.id_marca, m.nombre_marca, c.nombre_categoria AS nombre_categoria, m.categoria_marca_id
        FROM marca AS m
        INNER JOIN categoria AS c ON m.categoria_marca_id = c.id_categoria where m.id_marca = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idMarca);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function buscarMarca($pagina = 1) {
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
            $sql = "SELECT m.id_marca, m.nombre_marca, c.nombre_categoria AS nombre_categoria FROM marca AS m INNER JOIN categoria AS c ON m.categoria_marca_id = c.id_categoria WHERE m.esActivo = 1 AND nombre_marca LIKE '$textoBusqueda%'  ORDER BY id_marca LIMIT $inicio,$cantidadXHoja ";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $marcas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($marcas)){
                $listado = array();
                foreach($marcas as $marca){
                    $listado[] = array(
                        "id" => $marca["id_marca"],
                        "nombre" => $marca["nombre_marca"],
                        'nombreCategoria' => $marca["nombre_categoria"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_marca) as cantidad FROM marca WHERE esActivo = 1";
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