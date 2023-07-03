<?php

class Login extends Conectar{

    public function buscarUsuario($user){
        try {
            $conectar = $this->Conexion();
            $sql = "SELECT * FROM usuario WHERE esActivo = 1 AND nombre_usuario = '$user'";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            return $resultado =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function buscarPersonal($idper){
        try {
            $conectar = $this->Conexion();
            $sql = "SELECT * FROM personal WHERE esActivo_personal= 1 AND id_personal = '$idper'";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $json = [];
            return $resultado =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function buscarRol($idper){
        try {
            $conectar = $this->Conexion();
            $sql = "SELECT ro.id_rol_usuario, ro.usuario_id, ro.rol_id, roles.nombre_roles,ro.esActivo FROM rol_usuario ro INNER JOIN roles on ro.rol_id=roles.id_roles WHERE ro.esActivo= 1 AND ro.usuario_id ='$idper'";
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