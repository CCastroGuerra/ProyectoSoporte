<?php

class Login extends Conectar{

    public function buscarUsuario($user){
        try {
            $conectar = $this->Conexion();
            $sql = "SELECT * FROM personal WHERE es_activo = 1 AND nombre_usuario = '$user'";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            return $resultado =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>