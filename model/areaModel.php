<?php
class Area extends Conectar{
    public function traerAreas(){
        $conectar = parent::conexion();
        $sql = "SELECT * FROM area WHERE esActivo =1";
        $sql = $conectar ->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll();
        if(empty($resultado)){
            $resultado = array('listado'=>'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
         }else{
             $json =array();
             $listado = array();
             foreach($resultado as $row) {
                 $listado[]=array(
                     'id_area' => $row['id_area'],
                     'nombre_area' => $row['nombre_area']
                 );
             }
             $jsonString = json_encode($listado);
             echo $jsonString;
         
         }
    }
    public function traerAreaXId($id){
        $conectar = parent::conexion();
        $sql = "SELECT * FROM area WHERE id_area = ?";
        $sql = $conectar ->prepare($sql);
        $sql -> bindValue(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function eliminarArea($id){
            if (isset($_POST["id"])) {
                $id = $_POST["id"];
                // Resto del código para eliminar la tarea
                $conectar = parent::conexion();
                $sql = "UPDATE area SET esActivo = 0 WHERE id_area = ?";
                $sql = $conectar ->prepare($sql);
                $sql -> bindValue(1, $id);
                $sql->execute();
                return $resultado = $sql->fetchAll();
            } else {
                echo "El parámetro 'id' no ha sido enviado";
            }
     }
        
        
       
    
    public function registrarArea($nombre){
        $conectar = parent::conexion();
        $sql = "INSERT INTO `area`(`id_area`, `nombre_area`,  `esActivo`) VALUES (NULL,?,1)";
        $sql = $conectar ->prepare($sql);
        $sql -> bindValue(1, $nombre);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function actualizarArea($id, $nombre) {
        try {
            $conectar = parent::conexion();
            $sql = "UPDATE area SET nombre_area = ? WHERE id_area = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar la tarea: " . $e->getMessage());
        }
    }
}


?>