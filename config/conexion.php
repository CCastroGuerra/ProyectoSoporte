<?php
// require_once('config.php');
// class conexion{
//     protected $conexion;
//     public function conexion(){
//         try {
//             $this->conexion = new PDO(HOSTNAME,USERNAME,PASSWORD);
//             $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//             return $this->conexion;
//         } catch (PDOException $error ) {
//             echo 'La conexion a fallado'.$error->getLine();
//             die('error:'.$error->getMessage());
//         }
//     }
// }

class Conectar {
    protected $host;

    protected function Conexion(){
        try {
         $conectar = $this->host = new PDO("mysql:local=localhost;dbname=bd_soporte","root","");
         return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}


?>