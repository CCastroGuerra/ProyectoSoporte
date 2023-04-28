<?php
require_once('config.php');
class conexion{
    protected $conexion;
    public function conexion(){
        try {
            $this->conexion = new PDO(HOSTNAME,USERNAME,PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $error ) {
            echo 'La conexion a fallado'.$error->getLine();
            die('error:'.$error->getMessage());
        }
    }
}


?>