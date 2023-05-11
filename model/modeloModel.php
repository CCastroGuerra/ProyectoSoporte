<?php 
class Modelo extends Conectar{

    public function listarSelectMarca()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `marca` WHERE esActivo = 1 ORDER BY nombre_marca ASC";
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
                    'nombre' => $row['nombre_marca']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function listarModelo()
    {
        $conectar = parent::conexion();
        $sLimit = "LIMIT 5"; // Valor predeterminado de 5 registros por página
        //Para comprobar si se a mandado el parametro de registros
        if (isset($_POST['registros'])) {
        $limit = $_POST['registros'];
        $sLimit = "LIMIT $limit";
        }
        $sql = "SELECT mo.id_modelo, mo.nombre_modelo,mar.nombre_marca FROM modelo AS mo INNER JOIN marca AS mar ON mo.marca_id = mar.id_marca WHERE mo.esActivo = 1  $sLimit ";
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
                    'id' => $row['id_modelo'],
                    'nombre' => $row['nombre_modelo'],
                    'nombreMarca'=>$row['nombre_marca']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }
    public function agregarModelo($nombreModelo, $valorSeleccionado)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO `modelo`(`nombre_modelo`,`marca_id`,`esActivo`) VALUES ('$nombreModelo','$valorSeleccionado',1)";
        $fila = $conectar->prepare($sql);
        if ($fila->execute()) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function actulizarModelo($idModelo,$nombreModelo,$marcaId){
        $conectar= parent::conexion();
        $sql="UPDATE modelo
            SET
               nombre_modelo=? ,
               marca_id =?
            WHERE
                id_modelo = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombreModelo);
        $sql->bindValue(2,$marcaId);
        $sql->bindValue(3,$idModelo);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function eliminarModelo($id){
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            // Resto del código para eliminar la tarea
            $conectar = parent::conexion();
            $sql = "UPDATE modelo SET esActivo = 0 WHERE id_modelo = ?";
            $sql = $conectar ->prepare($sql);
            $sql -> bindValue(1, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            echo "El parámetro 'id' no ha sido enviado";
        }
    }

    public function traeModeloXId($idModelo){
        $conectar= parent::conexion();
        //$sql="SELECT * FROM area WHERE id_area = ?";
        $sql ="SELECT mo.id_modelo, mo.nombre_modelo,mar.nombre_marca as nombre_marca, mo.marca_id FROM modelo AS mo INNER JOIN marca AS mar ON mo.marca_id = mar.id_marca WHERE mo.id_modelo = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idModelo);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function buscarModelo($pagina = 1) {
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
            $sql = "SELECT mo.id_modelo, mo.nombre_modelo,mar.nombre_marca FROM modelo AS mo INNER JOIN marca AS mar ON mo.marca_id = mar.id_marca WHERE mo.esActivo  = 1 AND nombre_modelo LIKE '$textoBusqueda%'  ORDER BY id_modelo LIMIT $inicio,$cantidadXHoja ";
            $stmt = $conectar->prepare($sql);
            //echo $sql;
            //$stmt->bindValue(1, '%' . $textoBusqueda . '%');
            $stmt->execute();
            //echo $sql;
            //$resultados = array();
            $json = [];
            $modelos =  $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($modelos)){
                $listado = array();
                foreach($modelos as $modelo){
                    $listado[] = array(
                        "id" => $modelo["id_modelo"],
                        "nombre" => $modelo["nombre_modelo"],
                        'nombreMarca' => $modelo["nombre_marca"]
                    );
                }

                $sqlNroFilas = "SELECT count(id_modelo) as cantidad FROM modelo WHERE esActivo = 1";
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